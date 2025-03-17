<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\PengajuanPinjaman;

class PengajuanPinjamanController extends Controller
{
    public function index()
    {
        return view('pengurus.pengajuan-pinjaman.index-pengajuan-pinjaman');
    }

    public function create()
    {
        $namaList = Anggota::pluck('nama', 'id');

        return view('pengurus.pengajuan-pinjaman.create-pengajuan-pinjaman', compact('namaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengurus_id' => 'required',
            'anggota_id' => 'required',
            'jumlah_pinjaman' => 'required',
            'lama_angsuran' => 'required|in:3 bulan,6 bulan,12 bulan,24 bulan,36 bulan,48 bulan,60 bulan',
            'nominal_pokok' => 'required',
            'nominal_bunga' => 'required',
            'nominal_angsuran' => 'required',
            'biaya_admin' => 'required',
            'total_pinjaman' => 'required',
        ]);

        $jumlah_pinjaman = intval(str_replace(['Rp', '.', ' '], '', $request->jumlah_pinjaman));
        $nominal_pokok = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_pokok));
        $nominal_bunga = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_bunga));
        $nominal_angsuran = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_angsuran));
        $biaya_admin = intval(str_replace(['Rp', '.', ' '], '', $request->biaya_admin));
        $total_pinjaman = intval(str_replace(['Rp', '.', ' '], '', $request->total_pinjaman));

        PengajuanPinjaman::create([
            'anggota_id' => $request->anggota_id,
            'pengurus_id' => $request->pengurus_id,
            'jumlah_pinjaman' => $jumlah_pinjaman,
            'lama_angsuran' => $request->lama_angsuran,
            'nominal_pokok' => $nominal_pokok,
            'nominal_bunga' => $nominal_bunga,
            'nominal_angsuran' => $nominal_angsuran,
            'biaya_admin' => $biaya_admin,
            'total_pinjaman' => $total_pinjaman,
            'status' => 'menunggu',
        ]);

        return redirect()->route('pengurus.pengajuan-pinjaman.index')->with('success', 'Berhasil Menambahkan Data Pengajuan Pinjaman');
    }

    public function edit(string $id)
    {
        $pengajuanPinjaman = PengajuanPinjaman::findOrFail($id);

        if (!$pengajuanPinjaman) {
            return back()->with(['error' => 'Pinjaman tidak ditemukan']);
        }

        if ($pengajuanPinjaman->status !== 'menunggu') {
            return back()->with(['error' => 'Pinjaman sudah diproses']);
        }

        return view('pengurus.pengajuan-pinjaman.edit-pengajuan-pinjaman', compact('pengajuanPinjaman'));
    }

    public function update(Request $request, string $id)
    {
        $pengajuanPinjaman = PengajuanPinjaman::findOrFail($id);

        $request->validate([
            'pengurus_id' => 'required',
            'anggota_id' => 'required',
            'jumlah_pinjaman' => 'required',
            'lama_angsuran' => 'required|in:3 bulan,6 bulan,12 bulan,24 bulan,36 bulan,48 bulan,60 bulan',
            'nominal_pokok' => 'required',
            'nominal_bunga' => 'required',
            'nominal_angsuran' => 'required',
            'biaya_admin' => 'required',
            'total_pinjaman' => 'required',
        ]);

        $jumlah_pinjaman = intval(str_replace(['Rp', '.', ' '], '', $request->jumlah_pinjaman));
        $nominal_pokok = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_pokok));
        $nominal_bunga = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_bunga));
        $nominal_angsuran = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_angsuran));
        $biaya_admin = intval(str_replace(['Rp', '.', ' '], '', $request->biaya_admin));
        $total_pinjaman = intval(str_replace(['Rp', '.', ' '], '', $request->total_pinjaman));

        $pengajuanPinjaman = PengajuanPinjaman::findOrFail($id);

        $pengajuanPinjaman->update([
            'anggota_id' => $request->anggota_id,
            'pengurus_id' => $request->pengurus_id,
            'jumlah_pinjaman' => $jumlah_pinjaman,
            'lama_angsuran' => $request->lama_angsuran,
            'nominal_pokok' => $nominal_pokok,
            'nominal_bunga' => $nominal_bunga,
            'nominal_angsuran' => $nominal_angsuran,
            'biaya_admin' => $biaya_admin,
            'total_pinjaman' => $total_pinjaman,
        ]);

        return redirect()->route('pengurus.pengajuan-pinjaman.index')->with('success', 'Berhasil Mengubah Pengajuan Pinjaman');
    }

    public function destroy(string $id)
    {
        $pengajuanPinjaman = PengajuanPinjaman::findOrFail($id);

        if (!$pengajuanPinjaman) {
            return back()->with(['error' => 'Pinjaman tidak ditemukan']);
        }

        if ($pengajuanPinjaman->status !== 'menunggu') {
            return back()->with(['error' => 'Pinjaman sudah diproses']);
        }
        
        $pengajuanPinjaman->delete();

        return redirect()->route('pengurus.pengajuan-pinjaman.index')->with('success', 'Berhasil Menghapus Pengajuan Pinjaman');
    }
}
