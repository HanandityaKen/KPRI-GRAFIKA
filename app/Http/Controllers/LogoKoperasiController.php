<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\LogoKoperasi;

class LogoKoperasiController extends Controller
{
    public function index()
    {
        $logoKoperasi = LogoKoperasi::first();
        return view('admin.logo-koperasi.index-logo-koperasi', compact('logoKoperasi'));
    }

    public function update(Request $request)
    {        
        $request->validate([
            'logo_koperasi' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        // Cari data pertama, atau buat baru jika tidak ada
        $logoKoperasi = LogoKoperasi::first();

        if (!$logoKoperasi) {
            $logoKoperasi = new LogoKoperasi();
        }

        if ($request->hasFile('logo_koperasi')) {
            $file = $request->file('logo_koperasi');

            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $slugName = Str::slug($originalName);
            $filename = $slugName . '-' . time() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke disk `public/foto-koperasi`
            $path = $file->storeAs('logo-koperasi', $filename, 'public');

            // Hapus file lama kalau ada
            if ($logoKoperasi->logo && Storage::disk('public')->exists('logo-koperasi/' . $logoKoperasi->logo)) {
                Storage::disk('public')->delete('logo-koperasi/' . $logoKoperasi->logo);
            }

            // Simpan nama file ke database
            $logoKoperasi->logo = $filename;
            $logoKoperasi->save();
        }

        return redirect()->route('admin.logo-koperasi-index')->with('success', 'Berhasil Mengubah Foto Koperasi');
    }

}
