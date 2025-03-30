<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\Saldo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotaId = Auth::guard('anggota')->user()->id;

        $jumlahAnggota = Anggota::count();

        $totalSimpanan = Simpanan::sum('total');

        $totalPinjaman = PengajuanPinjaman::where('status', 'disetujui')->sum('jumlah_pinjaman');

        $jumlahSaldo = Saldo::first()?->saldo ?? 0;

        $simpananAnggota = Simpanan::where('anggota_id', $anggotaId)->value('total');

        $pinjamanAnggota = PengajuanPinjaman::where('anggota_id', $anggotaId)
            ->where('status', 'disetujui')
            ->sum('jumlah_pinjaman');

        $unitKonsumsiAnggota = PengajuanUnitKonsumsi::where('anggota_id', $anggotaId)
            ->where('status', 'disetujui')
            ->sum('nominal');

        $pinjaman = $pinjamanAnggota + $unitKonsumsiAnggota;

        return view('anggota.dashboard', compact('jumlahAnggota', 'totalSimpanan', 'totalPinjaman', 'jumlahSaldo', 'simpananAnggota', 'pinjaman'));
    }

    public function simpanan()
    {
        $anggotaId = Auth::guard('anggota')->user()->id;

        $pokok = Simpanan::where('anggota_id', $anggotaId)->value('pokok');

        $wajib = Simpanan::where('anggota_id', $anggotaId)->value('wajib');

        $manasuka = Simpanan::where('anggota_id', $anggotaId)->value('manasuka');

        $wajib_pinjam = Simpanan::where('anggota_id', $anggotaId)->value('wajib_pinjam');

        $qurban = Simpanan::where('anggota_id', $anggotaId)->value('qurban');

        $total = Simpanan::where('anggota_id', $anggotaId)->value('total');

        // dd($pokok, $wajib, $manasuka, $wajib_pinjam, $qurban);

        return view('anggota.simpanan', compact('pokok', 'wajib', 'manasuka', 'wajib_pinjam', 'qurban', 'total'));
    }

    public function profile()
    {
        $anggota = Auth::guard('anggota')->user();

        return view('anggota.profile', compact('anggota'));
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());

        $anggota = Auth::guard('anggota')->user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'email' => 'required|email|unique:anggota,email,' . $anggota->id,
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|min:6',
        ]);

        $anggota->nama = $request->nama;
        $anggota->telepon = $request->telepon;
        $anggota->email = $request->email;

        if ($request->filled('password')) {
            $anggota->password = Hash::make($request->password);
        }

        if ($request->hasFile('foto_profile')) {
            if ($anggota->foto_profile) {
                Storage::disk('public')->delete($anggota->foto_profile);
            }
            
            $fotoPath = $request->file('foto_profile')->store('anggota', 'public');
            $anggota->foto_profile = $fotoPath;
        } elseif ($request->has('delete_foto') && $request->delete_foto == "1") { 
            // Jika pengguna menghapus foto
            if ($anggota->foto_profile) {
                Storage::disk('public')->delete($anggota->foto_profile);
            }
            $anggota->foto_profile = null;
        } else {
            $anggota->foto_profile = $anggota->foto_profile;
        }

        $anggota->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');

    }
}
