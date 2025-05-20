<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wajib;

class WajibController extends Controller
{
    /**
     * Menampilkan halaman index wajib
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.wajib.index-wajib');
    }

    /**
     * Menampilkan halaman tambah wajib
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.wajib.create-wajib');
    }

    /**
     * Proses tambah wajib
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_pegawai' => 'required|string',
            'nominal' => 'required'
        ]);

        $jenis_pegawai = $request->jenis_pegawai;
        $nominal = intval(str_replace(['Rp', '.', ' '], '', $request->nominal));

        Wajib::create([
            'jenis_pegawai' => $jenis_pegawai,
            'nominal' => $nominal
        ]);

        return redirect()->route('admin.wajib.index')->with('success', 'Berhasil Menambahkan Jenis Pegawai');
    }

    /**
     * Menampilkan halaman edit wajib
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $wajib = Wajib::findOrFail($id);

        return view('admin.wajib.edit-wajib', compact('wajib'));
    }

    /**
     * Proses edit wajib
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
        
        $wajib = Wajib::findOrFail($id);

        $wajib->update([
            'nominal' => $nominal
        ]);
        
        return redirect()->route('admin.wajib.index')->with('success', 'Berhasil Mengubah Nominal Wajib');
    }

    /**
     * Proses hapus wajib
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $wajib = Wajib::findOrFail($id);

        $wajib->delete();

        return redirect()->route('admin.wajib.index')->with('success', 'Berhasil Menghapus Jenis Pegawai');
    }
}
