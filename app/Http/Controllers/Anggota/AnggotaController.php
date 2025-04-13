<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\KasHarian;
use App\Models\Simpanan;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use App\Models\Angsuran;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\UnitKonsumsi;
use App\Models\AngsuranUnitKonsumsi;
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

        $totalUnitKonsumsi = PengajuanUnitKonsumsi::where('status', 'disetujui')->sum('nominal');

        $jumlahSaldo = Saldo::first()?->saldo ?? 0;

        $simpananAnggota = Simpanan::where('anggota_id', $anggotaId)->value('total');

        //total pinjaman
        // $pinjamanAnggota = PengajuanPinjaman::where('anggota_id', $anggotaId)
        //     ->where('status', 'disetujui')
        //     ->sum('jumlah_pinjaman');

        //total unit konsumsi
        // $unitKonsumsiAnggota = PengajuanUnitKonsumsi::where('anggota_id', $anggotaId)
        //     ->where('status', 'disetujui')
        //     ->sum('nominal');

        // $pinjaman = $pinjamanAnggota + $unitKonsumsiAnggota;

        // sisa pinjaman
        $sisaPinjaman = Angsuran::whereHas('pinjaman', function ($query) use ($anggotaId) {
            $query->where('status', 'dalam pembayaran')
                    ->whereHas('pengajuan_pinjaman', function ($q) use ($anggotaId) {
                        $q->where('anggota_id', $anggotaId);
                    });
            })
            ->orderByDesc('created_at') 
            ->first();
        
        if ($sisaPinjaman) {
            $sisaPinjaman = $sisaPinjaman->kurang_angsuran + $sisaPinjaman->kurang_jasa;
        } else {
            $sisaPinjaman = 0; // Jika tidak ada data, set ke 0
        }

        //sisa unit konsumsi
        $sisaUnitKonsumsi = AngsuranUnitKonsumsi::whereHas('unit_konsumsi', function ($query) use ($anggotaId) {
            $query->where('status', 'dalam pembayaran')
                    ->whereHas('pengajuan_unit_konsumsi', function ($q) use ($anggotaId) {
                        $q->where('anggota_id', $anggotaId);
                    });
            })
            ->orderByDesc('created_at') 
            ->first();
        
        if ($sisaUnitKonsumsi) {
            $sisaUnitKonsumsi = $sisaUnitKonsumsi->kurang_angsuran + $sisaUnitKonsumsi->kurang_jasa;
        } else {
            $sisaUnitKonsumsi = 0; // Jika tidak ada data, set ke 0
        }

        return view('anggota.dashboard', compact('jumlahAnggota', 'totalSimpanan', 'totalPinjaman', 'totalUnitKonsumsi', 'jumlahSaldo', 'simpananAnggota', 'sisaPinjaman', 'sisaUnitKonsumsi'));
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

    public function pinjaman()
    {
        $anggotaId = Auth::guard('anggota')->user()->id;

        $angsuranPinjaman = Angsuran::whereHas('pinjaman', function ($query) use ($anggotaId) {
            $query->where('status', 'dalam pembayaran')
                    ->whereHas('pengajuan_pinjaman', function ($q) use ($anggotaId) {
                        $q->where('anggota_id', $anggotaId);
                    });
            })
            ->orderByDesc('created_at') 
            ->first();

        return view('anggota.pinjaman', compact('angsuranPinjaman'));
    }

    public function unitKonsumsi()
    {
        $anggotaId = Auth::guard('anggota')->user()->id;

        $angsuranUnitKonsumsi = AngsuranUnitKonsumsi::whereHas('unit_konsumsi', function ($query) use ($anggotaId) {
            $query->where('status', 'dalam pembayaran')
                    ->whereHas('pengajuan_unit_konsumsi', function ($q) use ($anggotaId) {
                        $q->where('anggota_id', $anggotaId);
                    });
            })
            ->orderByDesc('created_at') 
            ->first();

            return view('anggota.unit-konsumsi', compact('angsuranUnitKonsumsi'));
    }

    public function riwayat()
    {
        return view('anggota.riwayat');
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
            'telepon' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:anggota,email,' . $anggota->id,
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

        // Update the kas_harian table with the new name
        KasHarian::where('anggota_id', $anggota->id)->update([
            'nama_anggota' => $anggota->nama
        ]);

        // Update the pengajuan_pinjaman table with the new name
        PengajuanPinjaman::where('anggota_id', $anggota->id)->update([
            'nama_anggota' => $anggota->nama
        ]);

        // Update the pengajuan_unit_konsumsi table with the new name
        PengajuanUnitKonsumsi::where('anggota_id', $anggota->id)->update([
            'nama_anggota' => $anggota->nama
        ]);

        // Update the simpanan table with the new name
        Simpanan::where('anggota_id', $anggota->id)->update([
            'nama_anggota' => $anggota->nama
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');

    }
}
