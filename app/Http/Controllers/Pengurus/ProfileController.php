<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pengurus = Auth::guard('pengurus')->user();
        return view('pengurus.profile.index-profile', compact('pengurus'));
    }

    /**
     * Mengupdate profil pengurus
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $pengurus = Auth::guard('pengurus')->user();

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:pengurus,email,' . $pengurus->id,
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|min:6',
        ]);

        // Update data
        $pengurus->nama = $request->nama;
        $pengurus->telepon = $request->telepon;
        $pengurus->email = $request->email;

        // Jika ada password baru, update
        if ($request->filled('password')) {
            $pengurus->password = Hash::make($request->password);
        }

        if ($request->hasFile('foto_profile')) {
            if ($pengurus->foto_profile) {
                Storage::disk('public')->delete($pengurus->foto_profile);
            }
            
            $fotoPath = $request->file('foto_profile')->store('pengurus', 'public');
            $pengurus->foto_profile = $fotoPath;
        } elseif ($request->has('delete_foto') && $request->delete_foto == "1") { 
            // Jika pengguna menghapus foto
            if ($pengurus->foto_profile) {
                Storage::disk('public')->delete($pengurus->foto_profile);
            }
            $pengurus->foto_profile = null;
        } else {
            $pengurus->foto_profile = $pengurus->foto_profile;
        }

        $pengurus->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
