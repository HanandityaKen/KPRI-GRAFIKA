<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Saldo;
use App\Models\PengajuanPinjaman;

class PinjamanController extends Controller
{
    public function index()
    {
        return view('admin.pinjaman.index-pinjaman');
    }

    public function setujuiPinjaman($id)
    {
        $pinjaman = PengajuanPinjaman::find($id);

        if (!$pinjaman) {
            return back()->with(['error' => 'Pinjaman tidak ditemukan']);
        }

        if ($pinjaman->status !== 'menunggu') {
            return back()->with(['error' => 'Pinjaman sudah diproses']);
        }

        $saldoTerakhir = Saldo::first();

        $totalPinjaman = $pinjaman->total_pinjaman;

        if ($saldoTerakhir->saldo < $totalPinjaman) {
            return back()->with(['error' => 'Saldo Koperasi tidak cukup']);
        }

        $saldoTerakhir->update([
            'saldo' => $saldoTerakhir->saldo - $totalPinjaman
        ]);

        $pinjaman->update([
            'status' => 'disetujui'
        ]);

        return back()->with('success', 'Pinjaman berhasil disetujui');
    }

    public function tolakPinjaman($id)
    {
        $pinjaman = PengajuanPinjaman::find($id);

        if (!$pinjaman) {
            return back()->with(['error' => 'Pinjaman tidak ditemukan']);
        }

        if ($pinjaman->status !== 'menunggu') {
            return back()->with(['error' => 'Pinjaman sudah diproses']);
        }

        $pinjaman->update([
            'status' => 'ditolak'
        ]);

        return back()->with('success', 'Pinjaman berhasil ditolak');
    }

}
