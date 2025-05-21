<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NamaKoperasi;

class NamaKoperasiController extends Controller
{
    public function index()
    {
        $namaKoperasi = NamaKoperasi::first();
        return view('admin.nama-koperasi.index-nama-koperasi', compact('namaKoperasi'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_koperasi' => 'required|string',
        ]);

        $namaKoperasi = NamaKoperasi::first();

        $namaKoperasi->update([
            'nama' => $request->nama_koperasi,
        ]);

        return redirect()->route('admin.nama-koperasi-index')->with('success', 'Berhasil Mengubah Nama Koperasi');
    }
}
