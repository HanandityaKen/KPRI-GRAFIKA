<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WajibPinjam;

class WajibPinjamController extends Controller
{
    /**
     * Menampilkan halaman index wajib pinjam
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.wajib-pinjam.index-wajib-pinjam');
    }

    /**
     * Menampilkan halaman create wajib pinjam
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.wajib-pinjam.create-wajib-pinjam');        
    }

    /**
     * Proses create wajib pinjam
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Menampilkan halaman edit wajib pinjam
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $wajib_pinjam = WajibPinjam::findOrFail($id);

        return view('admin.wajib-pinjam.edit-wajib-pinjam', compact('wajib_pinjam'));
    }

    /**
     * Proses edit wajib pinjam
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Proses hapus wajib pinjam
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $wajib_pinjam = WajibPinjam::findOrFail($id);
    
        $wajib_pinjam->delete();

        return redirect()->route('admin.wajib-pinjam.index')->with('success', 'Berhasil Menghapus Nominal Wajib Pinjam');
    }
}
