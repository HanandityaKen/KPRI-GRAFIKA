<?php

namespace App\Livewire\Anggota;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\KasHarian;

class JasaManasuka extends Component
{
    public $data = [];

    private function updateJasaManasuka()
    {
        $anggota = Auth::guard('anggota')->user();
        $anggotaId = $anggota->id;
        $nama = $anggota->nama;
        $selectedYear = now()->year;

        // saldo akhir tahun sebelumnya
        $saldoAwal = KasHarian::where('anggota_id', $anggotaId)
            ->whereYear('tanggal', '<=', $selectedYear - 1)
            ->selectRaw('
                SUM(CASE WHEN jenis_transaksi = "kas masuk" THEN manasuka ELSE 0 END) -
                SUM(CASE WHEN jenis_transaksi = "kas keluar" THEN manasuka ELSE 0 END) as saldo
            ')
            ->value('saldo') ?? 0;

        // transaksi per bulan tahun berjalan
        $rows = KasHarian::where('anggota_id', $anggotaId)
            ->whereYear('tanggal', $selectedYear)
            ->selectRaw('
                MONTH(tanggal) as bulan,
                SUM(CASE WHEN jenis_transaksi = "kas masuk" THEN manasuka ELSE 0 END) -
                SUM(CASE WHEN jenis_transaksi = "kas keluar" THEN manasuka ELSE 0 END) as transaksi
            ')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // tentukan bulan maksimal
        $currentMonth = now()->month;
        $maxBulan = $currentMonth;

        $saldo = $saldoAwal;
        $result = [
            'nama' => $nama,
            'bulan' => array_fill(1, 12, 0),
        ];

        for ($bulan = 1; $bulan <= $maxBulan; $bulan++) {
            $row = $rows->firstWhere('bulan', $bulan);

            if ($row) {
                $saldo += $row->transaksi;
            }

            // jasa bulan ini = saldo terakhir x 0.5%
            $result['bulan'][$bulan] = $saldo * 0.005;
        }

        $this->data = $result;
    }

    public function render()
    {
        $this->updateJasaManasuka();

        return view('livewire.anggota.jasa-manasuka', [
            'jasa' => $this->data,
        ]);
    }
}
