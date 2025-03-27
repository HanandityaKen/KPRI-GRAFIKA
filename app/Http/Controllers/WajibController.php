<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wajib;

class WajibController extends Controller
{
    public function index()
    {
        return view('admin.wajib.index-wajib');
    }

    public function edit(string $id)
    {
        $wajib = Wajib::findOrFail($id);

        return view('admin.wajib.edit-wajib', compact('wajib'));
    }

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
