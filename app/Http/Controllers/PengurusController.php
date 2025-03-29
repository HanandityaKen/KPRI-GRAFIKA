<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PengurusController extends Controller
{
    public function index()
    {
        return view('admin.pengurus.index-pengurus');
    }

    public function create()
    {
        $anggotaList = Anggota::where('posisi', 'anggota')->pluck('nama', 'id');
        
        $jumlahBendahara = Anggota::where('jabatan', 'bendahara')->count();

        return view('admin.pengurus.create-pengurus', compact('anggotaList', 'jumlahBendahara'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id'      => 'required|exists:anggota,id',
            'posisi'      => 'required|in:pengurus',
            'jabatan'      => 'required|in:pengawas,bendahara',
        ]);

        $anggota = Anggota::find($request->anggota_id);

        $anggota->update([
            'posisi'  => $request->posisi,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('admin.pengurus.index')->with('success', 'Berhasil Menambahkan Pengurus');
    }

    public function edit(string $id)
    {
        $user = Anggota::findOrFail($id);

        $anggotaList = Anggota::where('posisi', 'anggota')
            ->orWhere('id', $id)
            ->pluck('nama', 'id');

        $jumlahBendahara = Anggota::where('jabatan', 'bendahara')->count();

        return view('admin.pengurus.edit-pengurus', compact('user', 'anggotaList', 'jumlahBendahara'));
    }

    public function update(Request $request, string $id)
    {   
        $request->validate([
            'nama'      => 'required|string',
            'posisi'      => 'required|in:pengurus',
            'jabatan'      => 'required|in:pengawas,bendahara',
        ]);

        $user = Anggota::findOrFail($id);

        $user->nama = $request->input('nama');
        $user->posisi = $request->input('posisi');
        $user->jabatan = $request->input('jabatan');

        $user->save();

        return redirect()->route('admin.pengurus.index')->with('success', 'Berhasil Mengubah Pengurus');
    }

    public function destroy(string $id)
    {
        $user = Anggota::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.pengurus.index')->with('success', 'Berhasil Menghapus Pengurus');
    }


}
