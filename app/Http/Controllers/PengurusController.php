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
        $users = Anggota::where('posisi', 'pengurus')->get(); 

        return view('admin.pengurus.index-pengurus', compact('users'));
    }

    public function create()
    {
        $jumlahBendahara = Anggota::where('jabatan', 'bendahara')->count();

        return view('admin.pengurus.create-pengurus', compact('jumlahBendahara'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'nama'      => 'required|string',
            'posisi'      => 'required|in:pengurus',
            'jabatan'      => 'required|in:pengawas,bendahara',
            'telepon'   => 'required|numeric|regex:/^08[0-9]{8,11}$/',
            'email'   => 'required|email',
            'password'   => 'required|string|min:8',
        ], [
            'telepon.regex' => '* Nomor telepon harus dimulai dengan 08 dan berisi 10-13 digit.',
            'telepon.numeric' => '* Nomor telepon hanya boleh berisi angka. ',
            'password.min' => '* Password harus berisi minimal 8 karakter. ',
        ]);

        Anggota::create([
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'jabatan' => $request->jabatan,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.pengurus.index')->with('success', 'Berhasil Menambahkan Pengurus');
    }

    public function edit(string $id)
    {
        $user = Anggota::findOrFail($id);

        $jumlahBendahara = Anggota::where('jabatan', 'bendahara')->count();

        return view('admin.pengurus.edit-pengurus', compact('user', 'jumlahBendahara'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama'      => 'required|string',
            'posisi'      => 'required|in:pengurus',
            'jabatan'      => 'required|in:pengawas,bendahara',
            'telepon'   => 'required|numeric|regex:/^08[0-9]{8,11}$/',
            'email'   => 'required|email',
            'password'   => 'nullable|string|min:8',
        ], [
            'telepon.regex' => '* Nomor telepon harus dimulai dengan 08 dan berisi 10-13 digit.',
            'telepon.numeric' => '* Nomor telepon hanya boleh berisi angka. ',
            'password.min' => '* Password harus berisi minimal 8 karakter. ',
        ]);

        $user = Anggota::findOrFail($id);

        $user->nama = $request->input('nama');
        $user->posisi = $request->input('posisi');
        $user->jabatan = $request->input('jabatan');
        $user->telepon = $request->input('telepon');
        $user->email = $request->input('email');
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

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
