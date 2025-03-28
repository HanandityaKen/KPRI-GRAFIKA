<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $pengurus = Auth::guard('pengurus')->user();
        return view('pengurus.profile.index-profile', compact('pengurus'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $pengurus = Auth::guard('pengurus')->user();

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'email' => 'required|email|unique:anggota,email,' . $pengurus->id,
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|min:6',
        ]);

        // Update data
        $pengurus->nama = $request->nama;
        $pengurus->telepon = $request->telepon;
        $pengurus->email = $request->email;

        // Jika ada password baru, update
        if ($request->filled('password')) {
            $pengurus->password = bcrypt($request->password);
        }

        if ($request->hasFile('foto_profile')) {
            $fotoPath = $request->file('foto_profile')->store('pengurus', 'public');
            $pengurus->foto_profile = $fotoPath;
        } elseif ($request->has('delete_foto')) { 
            $pengurus->foto_profile = null;
        }

        $pengurus->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
