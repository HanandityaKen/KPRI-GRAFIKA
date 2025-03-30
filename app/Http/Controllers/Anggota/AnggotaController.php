<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\Saldo;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotaId = Auth::guard('anggota')->user()->id;

        $jumlahAnggota = Anggota::count();

        $totalSimpanan = Simpanan::sum('total');

        $totalPinjaman = PengajuanPinjaman::where('status', 'disetujui')->sum('jumlah_pinjaman');

        $jumlahSaldo = Saldo::first()?->saldo ?? 0;

        $simpananAnggota = Simpanan::where('anggota_id', $anggotaId)->value('total');

        $pinjamanAnggota = PengajuanPinjaman::where('anggota_id', $anggotaId)
            ->where('status', 'disetujui')
            ->sum('jumlah_pinjaman');

        $unitKonsumsiAnggota = PengajuanUnitKonsumsi::where('anggota_id', $anggotaId)
            ->where('status', 'disetujui')
            ->sum('nominal');

        $pinjaman = $pinjamanAnggota + $unitKonsumsiAnggota;

        return view('anggota.dashboard', compact('jumlahAnggota', 'totalSimpanan', 'totalPinjaman', 'jumlahSaldo', 'simpananAnggota', 'pinjaman'));
    }

    public function simpanan()
    {
        $anggotaId = Auth::guard('anggota')->user()->id;

        $pokok = Simpanan::where('anggota_id', $anggotaId)->value('pokok');

        $wajib = Simpanan::where('anggota_id', $anggotaId)->value('wajib');

        $manasuka = Simpanan::where('anggota_id', $anggotaId)->value('manasuka');

        $wajib_pinjam = Simpanan::where('anggota_id', $anggotaId)->value('wajib_pinjam');

        $qurban = Simpanan::where('anggota_id', $anggotaId)->value('qurban');

        $total = Simpanan::where('anggota_id', $anggotaId)->value('total');

        // dd($pokok, $wajib, $manasuka, $wajib_pinjam, $qurban);

        return view('anggota.simpanan', compact('pokok', 'wajib', 'manasuka', 'wajib_pinjam', 'qurban', 'total'));
    }
}
