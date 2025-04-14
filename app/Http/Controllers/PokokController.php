<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokok;

class PokokController extends Controller
{
    /**
     * Menampilkan halaman index pokok
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pokok = Pokok::first();
        return view('admin.pokok.index-pokok', compact('pokok'));
    }

    /**
     * Menampilkan halaman edit pokok
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $pokok = Pokok::findOrFail($id);
        return view('admin.pokok.edit-pokok', compact('pokok'));
    }

    /**
     * Proses edit pokok
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

        $pokok = Pokok::findOrFail($id);

        $pokok->update([
            'nominal' => $nominal
        ]);

        return redirect()->route('admin.pokok.index')->with('success', 'Berhasil Mengubah Nominal Pokok');
    }
}
