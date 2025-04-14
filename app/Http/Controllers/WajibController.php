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
}
