<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WajibPinjam;

class WajibPinjamController extends Controller
{
    public function index()
    {
        return view('admin.wajib-pinjam.index-wajib-pinjam');
    }

    public function create()
    {
        return view('admin.wajib-pinjam.create-wajib-pinjam');        
    }

    public function store(Request $request)
    {
        $request->validate([
            'nominal' => 'required'
        ]);

        $nominal = intval(str_replace(['Rp', '.', ' '], '', $request->nominal));

        WajibPinjam::create([
            'nominal' => $nominal
        ]);

        return redirect()->route('admin.wajib-pinjam.index')->with('success', 'Berhasil Menambahkan Nominal Wajib Pinjam');
    }

    public function edit(string $id)
    {
        $wajib_pinjam = WajibPinjam::findOrFail($id);

        return view('admin.wajib-pinjam.edit-wajib-pinjam', compact('wajib_pinjam'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nominal' => 'required',
        ]);

        $nominal = intval(str_replace(['Rp', '.', ' '], '', $request->nominal));

        $wajib_pinjam = WajibPinjam::findOrFail($id);

        $wajib_pinjam->update([
            'nominal' => $nominal
        ]);

        return redirect()->route('admin.wajib-pinjam.index')->with('success', 'Berhasil Mengubah Nominal Wajib Pinjam');
    }

    public function destroy(string $id)
    {
        $wajib_pinjam = WajibPinjam::findOrFail($id);
    
        $wajib_pinjam->delete();

        return redirect()->route('admin.wajib-pinjam.index')->with('success', 'Berhasil Menghapus Nominal Wajib Pinjam');
    }
}
