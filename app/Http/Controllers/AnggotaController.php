<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AnggotaController extends Controller
{
    public function index()
    {
        return view('admin.anggota.index-anggota');
    }

    public function create()
    {
        return view('admin.anggota.create-anggota');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_anggota'    => 'required|numeric|unique:anggota',
            'nama'      => 'required|string',
            'jenis_pegawai' => 'required|in:PNS,P3K,GTT',
            'posisi'      => 'required|in:anggota',
            'telepon'   => 'required|numeric|regex:/^08[0-9]{8,11}$/',
            'email'   => 'required|email',
            'password'   => 'required|string|min:8',
        ], [
            'no_anggota.unique' => '* No Anggota sudah terdaftar.',
            'telepon.regex' => '* Nomor telepon harus dimulai dengan 08 dan berisi 10-13 digit.',
            'telepon.numeric' => '* Nomor telepon hanya boleh berisi angka. ',
            'password.min' => '* Password harus berisi minimal 8 karakter. ',
        ]);

        Anggota::create([
            'no_anggota' => $request->no_anggota,
            'nama' => $request->nama,
            'jenis_pegawai' => $request->jenis_pegawai,
            'posisi' => $request->posisi,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Berhasil Menambahkan Anggota');
    }

    public function edit(string $id)
    {
        $user = Anggota::findOrFail($id);
        return view('admin.anggota.edit-anggota', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_anggota' => 'required|numeric|unique:anggota,no_anggota,' . $id . ',id',
            'nama'      => 'required|string',
            'jenis_pegawai' => 'required|in:PNS,P3K,GTT',
            'telepon'   => 'required|numeric|regex:/^08[0-9]{8,11}$/',
            'email'   => 'required|email',
            'password'   => 'nullable|string|min:8',
        ], [
            'no_anggota.unique' => '* No Anggota sudah terdaftar.',
            'telepon.regex' => '* Nomor telepon harus dimulai dengan 08 dan berisi 10-13 digit.',
            'telepon.numeric' => '* Nomor telepon hanya boleh berisi angka. ',
            'password.min' => '* Password harus berisi minimal 8 karakter. ',
        ]);

        $user = Anggota::findOrFail($id);

        $user->no_anggota = $request->input('no_anggota');
        $user->nama = $request->input('nama');
        $user->jenis_pegawai = $request->input('jenis_pegawai');
        $user->telepon = $request->input('telepon');
        $user->email = $request->input('email');
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.anggota.index')->with('success', 'Berhasil Mengubah Anggota');
    }

    public function destroy(string $id)
    {
        $user = Anggota::findOrFail($id);
    
        $user->delete();

        return redirect()->route('admin.anggota.index')->with('success', 'Berhasil Menghapus Anggota');
    }
}
