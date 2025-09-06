<?php

namespace App\Livewire\Anggota;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Shu as shuModel;
use App\Models\KasHarian;
use App\Models\Anggota;

class Shu extends Component
{
    private function updateShu()
    {
        $anggotaId = Auth::guard('anggota')->user()->id;

        $tanggal = now();

        if ($tanggal->isSameDay($tanggal->copy()->endOfYear())) {
            // Kalau tepat 31 Desember → pakai tahun berjalan
            $tahun = $tanggal->year;
        } else {
            $tahun = $tanggal->year - 1;
        }

        // Ambil data SHU tahun sekarang
        $shu = shuModel::where('tahun', $tahun)->first();
        if (!$shu) {
            return collect();
        }

        $jumlahShu = $shu->jumlah_shu;
        $jasaPartisipasi = $jumlahShu * 0.2; // 20%
        $jasaSimpanan   = $jumlahShu * 0.25; // 25%

        // Ambil simpanan & jasa hanya untuk anggota yg login
        $anggotaData = KasHarian::selectRaw('
            anggota_id,
            SUM(CASE WHEN jenis_transaksi = "kas masuk" THEN (pokok + wajib + wajib_pinjam) ELSE 0 END) -
            SUM(CASE WHEN jenis_transaksi = "kas keluar" THEN (pokok + wajib + wajib_pinjam) ELSE 0 END) as total_simpanan,
            SUM(CASE WHEN jenis_transaksi = "kas masuk" THEN jasa ELSE 0 END) as total_jasa
        ')
        ->whereYear('tanggal', $tahun)
        ->where('anggota_id', $anggotaId)
        ->groupBy('anggota_id')
        ->first();

        if (!$anggotaData) return collect();

        $totalSimpanan = KasHarian::selectRaw('
            SUM(
                CASE WHEN jenis_transaksi = "kas masuk"
                    THEN (pokok + wajib + wajib_pinjam)
                    ELSE 0 END
            ) -
            SUM(
                CASE WHEN jenis_transaksi = "kas keluar"
                    THEN (pokok + wajib + wajib_pinjam)
                    ELSE 0 END
            ) as total_simpanan
        ')
        ->whereYear('tanggal', $tahun)
        ->value('total_simpanan');

        $totalJasa = KasHarian::whereYear('tanggal', $tahun)->sum('jasa');

        // Hitung bagian anggota ini
        $partisipasi = $totalJasa > 0
            ? ($anggotaData->total_jasa / $totalJasa) * $jasaPartisipasi
            : 0;

        $simpanan = $totalSimpanan > 0
            ? ($anggotaData->total_simpanan / $totalSimpanan) * $jasaSimpanan
            : 0;

        $jumlah = $partisipasi + $simpanan;

        return collect([
            'tahun'       => $tahun,
            'simpanan'     => $simpanan,
            'partisipasi'  => $partisipasi,
            'jumlah'       => $jumlah,
        ]);
    }

    public function render()
    {
        return view('livewire.anggota.shu', [
            'shuData' => $this->updateShu()
        ]);
    }
}
