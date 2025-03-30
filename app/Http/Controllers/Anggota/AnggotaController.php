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

        // dd($unitKonsumsiAnggota);

        $pinjaman = $pinjamanAnggota + $unitKonsumsiAnggota;
        // dd($pinjaman);

        return view('anggota.dashboard', compact('jumlahAnggota', 'totalSimpanan', 'totalPinjaman', 'jumlahSaldo', 'simpananAnggota', 'pinjaman'));
    }
}
