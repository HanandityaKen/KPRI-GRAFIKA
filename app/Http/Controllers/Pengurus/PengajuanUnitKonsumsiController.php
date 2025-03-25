<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\PengajuanUnitKonsumsi;

class PengajuanUnitKonsumsiController extends Controller
{
    public function index()
    {
        return view('pengurus.pengajuan-unit-konsumsi.index-pengajuan-unit-konsumsi');
    }

    public function create()
    {
        $namaList = Anggota::pluck('nama', 'id');

        return view('pengurus.pengajuan-unit-konsumsi.create-pengajuan-unit-konsumsi', compact('namaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required',
            'pengurus_id' => 'required',
            'nama_barang' => 'required',
            'nominal' => 'required',
            'lama_angsuran' => 'required',
            'nominal_pokok' => 'required',
            'nominal_bunga' => 'required',
            'jumlah_nominal' => 'required',
        ]);

        $nominal = intval(str_replace(['Rp', '.', ' '], '', $request->nominal));
        $nominal_pokok = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_pokok));
        $nominal_bunga = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_bunga));
        $jumlah_nominal = intval(str_replace(['Rp', '.', ' '], '', $request->jumlah_nominal));

        $lama_angsuran = (int) preg_replace('/[^0-9]/', '', $request->lama_angsuran); 

        PengajuanUnitKonsumsi::create([
            'anggota_id' => $request->anggota_id,
            'pengurus_id' => $request->pengurus_id,
            'nama_barang' => $request->nama_barang,
            'nominal' => $nominal,
            'lama_angsuran' => $lama_angsuran . ' bulan',
            'nominal_bunga' => $nominal_bunga,
            'nominal_pokok' => $nominal_pokok,
            'jumlah_nominal' => $jumlah_nominal,
            'status' => 'menunggu',
        ]);

        return redirect()->route('pengurus.pengajuan-unit-konsumsi.index')->with('success', 'Berhasil Menambahkan Data Pengajuan Unit Konsumsi');
    }

    public function edit(string $id)
    {
        $pengajuanUnitKonsumsi = PengajuanUnitKonsumsi::findOrFail($id);

        if (!$pengajuanUnitKonsumsi){
            return back()->with(['error' => 'Pengajuan Unit Konsumsi tidak ditemukan']);
        }

        if ($pengajuanUnitKonsumsi->status !== 'menunggu') {
            return back()->with(['error' => 'Pengajuan Unit Konsumsi sudah diproses']);
        }

        return view('pengurus.pengajuan-unit-konsumsi.edit-pengajuan-unit-konsumsi', compact('pengajuanUnitKonsumsi'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'pengurus_id' => 'required',
            'anggota_id' => 'required',
            'nama_barang' => 'required',
            'nominal' => 'required',
            'lama_angsuran' => 'required',
            'nominal_pokok' => 'required',
            'nominal_bunga' => 'required',
            'jumlah_nominal' => 'required',
        ]);

        $nominal = intval(str_replace(['Rp', '.', ' '], '', $request->nominal));
        $nominal_pokok = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_pokok));
        $nominal_bunga = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_bunga));
        $jumlah_nominal = intval(str_replace(['Rp', '.', ' '], '', $request->jumlah_nominal));

        $lama_angsuran = (int) preg_replace('/[^0-9]/', '', $request->lama_angsuran);

        $pengajuanUnitKonsumsi = PengajuanUnitKonsumsi::findOrFail($id);

        $pengajuanUnitKonsumsi->update([
            'anggota_id' => $request->anggota_id,
            'pengurus_id' => $request->pengurus_id,
            'nama_barang' => $request->nama_barang,
            'nominal' => $nominal,
            'lama_angsuran' => $lama_angsuran . ' bulan',
            'nominal_bunga' => $nominal_bunga,
            'nominal_pokok' => $nominal_pokok,
            'jumlah_nominal' => $jumlah_nominal,
        ]);

        return redirect()->route('pengurus.pengajuan-unit-konsumsi.index')->with('success', 'Berhasil Mengubah Data Pengajuan Unit Konsumsi');
    }

    public function destroy(string $id)
    {
        $pengajuanUnitKonsumsi = PengajuanUnitKonsumsi::findOrFail($id);

        if (!$pengajuanUnitKonsumsi){
            return back()->with(['error' => 'Pengajuan Unit Konsumsi tidak ditemukan']);
        }

        if ($pengajuanUnitKonsumsi->status !== 'menunggu') {
            return back()->with(['error' => 'Pengajuan Unit Konsumsi sudah diproses']);
        }

        $pengajuanUnitKonsumsi->delete();

        return redirect()->route('pengurus.pengajuan-unit-konsumsi.index')->with('success', 'Berhasil Menghapus Data Pengajuan Unit Konsumsi');
    }
}
