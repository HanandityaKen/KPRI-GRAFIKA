<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.index-profile', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $admin = Auth::guard('admin')->user();

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|min:6',
        ]);

        // Update data
        $admin->nama = $request->nama;
        $admin->telepon = $request->telepon;

        // Jika ada password baru, update
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }

        if ($request->hasFile('foto_profile')) {
            $fotoPath = $request->file('foto_profile')->store('admin', 'public');
            $admin->foto_profile = $fotoPath;
        } elseif ($request->has('delete_foto')) { 
            $admin->foto_profile = null;
        }

        $admin->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
