<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profile admin
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.index-profile', compact('admin'));
    }


    /**
     * Mengupdate profile admin
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
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
            $admin->password = Hash::make($request->password);
        }

        if ($request->hasFile('foto_profile')) {
            if ($admin->foto_profile) {
                Storage::disk('public')->delete($admin->foto_profile);
            }
            
            $fotoPath = $request->file('foto_profile')->store('admin', 'public');
            $admin->foto_profile = $fotoPath;
        } elseif ($request->has('delete_foto') && $request->delete_foto == "1") { 
            // Jika pengguna menghapus foto
            if ($admin->foto_profile) {
                Storage::disk('public')->delete($admin->foto_profile);
            }
            $admin->foto_profile = null;
        } else {
            $admin->foto_profile = $admin->foto_profile;
        }

        $admin->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
