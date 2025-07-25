<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KasHarian;
use App\Models\Saldo;
use Carbon\Carbon;

class RiwayatSaldoFilter extends Component
{
    public $selectedYear;

    public $availableYears = [];

    public function mount()
    {
        $this->availableYears = KasHarian::whereYear('tanggal', '>=', 2025)
            ->selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        if (!isset($this->selectedYear)) {
            $this->selectedYear = now()->year;
        }
    }

    public function render()
    {
        Carbon::setLocale('id');

        $baseYear = 2025;
        $baseSaldo = 917710655;

        $selectedYear = $this->selectedYear ?? now()->year;

        // Hitung saldo awal untuk tahun yang dipilih
        $saldoAwal = $baseSaldo;

        if ($selectedYear > $baseYear) {
            $saldoAwal = $this->getSaldoAkhirTahunSebelumnya($selectedYear - 1);
        }

        $kasData = KasHarian::selectRaw('
                MONTH(tanggal) as bulan,
                SUM(CASE WHEN jenis_transaksi = "kas masuk" THEN 
                    pokok + wajib + manasuka + wajib_pinjam + qurban + angsuran + jasa + js_admin + lain_lain + barang_kons 
                    ELSE 0 END) as total_masuk,
                SUM(CASE WHEN jenis_transaksi = "kas keluar" THEN 
                    pokok + wajib + manasuka + wajib_pinjam + qurban + angsuran + jasa + js_admin + lain_lain + barang_kons + piutang + hutang + hari_lembur + perjalanan_pengawas + thr + admin + iuran_dekopinda + honor_pengurus + rkrab + pembinaan + harkop + dandik + rapat + jasa_manasuka + pajak + tabungan_qurban + dekopinda + wajib_pkpri + dansos + shu + dana_pengurus + dana_kesejahteraan + pembayaran_listrik_dan_air + tnh_kav 
                    ELSE 0 END) as total_keluar
            ')
            ->whereYear('tanggal', $selectedYear)
            ->where('tanggal', '>=', Carbon::create($baseYear, 1, 1)) // filter data dari 1 Jan 2025 ke atas saja
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        $allMonths = collect([
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ]);

        $runningSaldo = $saldoAwal;

        $riwayatSaldo = $allMonths->map(function ($monthName, $monthNumber) use ($kasData, &$runningSaldo) {
            $masuk = $kasData->get($monthNumber)->total_masuk ?? 0;
            $keluar = $kasData->get($monthNumber)->total_keluar ?? 0;

            $saldoAkhir = $runningSaldo + $masuk - $keluar;

            $data = [
                'bulan' => $monthName,
                'kas_masuk' => $masuk,
                'kas_keluar' => $keluar,
                'saldo_awal' => $runningSaldo,
                'saldo_akhir' => $saldoAkhir,
            ];

            $runningSaldo = $saldoAkhir;

            return $data;
        });

        return view('livewire.riwayat-saldo-filter', [
            'riwayatSaldo' => $riwayatSaldo,
        ]);
    }


    protected function getSaldoAkhirTahunSebelumnya($tahun)
    {
        $baseSaldo = 917710655;
        $startDate = Carbon::create(2025, 1, 1);
        $endDate = Carbon::create($tahun, 12, 31);

        $kasMasuk = KasHarian::whereBetween('tanggal', [$startDate, $endDate])
            ->where('jenis_transaksi', 'kas masuk')
            ->sum(\DB::raw('pokok + wajib + manasuka + wajib_pinjam + qurban + angsuran + jasa + js_admin + lain_lain + barang_kons'));

        $kasKeluar = KasHarian::whereBetween('tanggal', [$startDate, $endDate])
            ->where('jenis_transaksi', 'kas keluar')
            ->sum(\DB::raw('pokok + wajib + manasuka + wajib_pinjam + qurban + angsuran + jasa + js_admin + lain_lain + barang_kons + piutang + hutang + hari_lembur + perjalanan_pengawas + thr + admin + iuran_dekopinda + honor_pengurus + rkrab + pembinaan + harkop + dandik + rapat + jasa_manasuka + pajak + tabungan_qurban + dekopinda + wajib_pkpri + dansos + shu + dana_pengurus + dana_kesejahteraan + pembayaran_listrik_dan_air + tnh_kav'));

        return $baseSaldo + $kasMasuk - $kasKeluar;
    }

}
