<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persentase;

class PersentaseController extends Controller
{
    /**
     * Menampilkan halaman index persentase
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.persentase.index-persentase');
    }

    /**
     * Menampilkan halaman tambah persentase
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.persentase.create-persentase');
    }

    /**
     * Proses tambah persentase
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'persentase' => 'required|regex:/^\d+(\.\d+)?%?$/'
        ]);
    
        // Menghapus tanda persen (%) dan membagi dengan 100 untuk mendapatkan nilai desimal
        $persentase = str_replace('%', '', $request->persentase) / 100;
    
        Persentase::create([
            'nama' => $request->nama,
            'persentase' => $persentase
        ]);

        return redirect()->route('admin.persentase.index')->with('success', 'Berhasil Menambahkan Persentase');
    }

    /**
     * Menampilkan halaman edit persentase
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $persentase = Persentase::findOrFail($id);

        return view('admin.persentase.edit-persentase', compact('persentase'));
    }

    /**
     * Proses edit persentase
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'persentase' => 'required|regex:/^\d+(\.\d+)?%?$/'
        ]);
    
        // Menghapus tanda persen (%) dan membagi dengan 100 untuk mendapatkan nilai desimal
        $persentase = str_replace('%', '', $request->persentase) / 100;
    
        Persentase::findOrFail($id)->update([
            'persentase' => $persentase
        ]);

        return redirect()->route('admin.persentase.index')->with('success', 'Berhasil Mengubah Persentase');
    }
}
