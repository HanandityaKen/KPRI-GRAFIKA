<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persentase;

class PersentaseController extends Controller
{
    public function index()
    {
        return view('admin.persentase.index-persentase');
    }

    public function create()
    {
        return view('admin.persentase.create-persentase');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'persentase' => 'required|regex:/^\d+(\.\d+)?%?$/'
        ]);
    
        $persentase = str_replace('%', '', $request->persentase) / 100;
    
        Persentase::create([
            'nama' => $request->nama,
            'persentase' => $persentase
        ]);

        return redirect()->route('admin.persentase.index')->with('success', 'Berhasil Menambahkan Persentase');
    }

    public function edit(string $id)
    {
        $persentase = Persentase::findOrFail($id);

        return view('admin.persentase.edit-persentase', compact('persentase'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'persentase' => 'required|regex:/^\d+(\.\d+)?%?$/'
        ]);
    
        $persentase = str_replace('%', '', $request->persentase) / 100;
    
        Persentase::findOrFail($id)->update([
            'persentase' => $persentase
        ]);

        return redirect()->route('admin.persentase.index')->with('success', 'Berhasil Mengubah Persentase');
    }
}
