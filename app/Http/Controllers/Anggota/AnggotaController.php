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
    /**
     * Menampilkan halaman dashboard untuk anggota.
     *
     * Fungsi ini mengambil data terkait anggota saat ini dan informasi global yang relevan
     * untuk ditampilkan pada dashboard, seperti jumlah anggota, total simpanan, total pinjaman,
     * saldo koperasi, serta sisa pinjaman dan unit konsumsi anggota.
     *
     * Data yang diambil antara lain:
     * - Jumlah seluruh anggota yang terdaftar
     * - Total simpanan dari semua anggota
     * - Total pinjaman yang telah disetujui
     * - Total unit konsumsi yang telah disetujui
     * - Saldo koperasi (jika tidak tersedia, dianggap 0)
     * - Simpanan dari anggota yang sedang login
     * - Sisa pinjaman anggota yang masih dalam pembayaran
     * - Sisa unit konsumsi anggota yang masih dalam pembayaran
     *
     * @return \Illuminate\View\View
     */
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

    /**
     * Menampilkan halaman simpanan untuk anggota.
     * 
     * Fungsi ini mengambil data simpanan anggota yang sedang login,
     * termasuk simpanan pokok, wajib, manasuka, wajib pinjam, qurban,
     * dan total simpanan.
     * 
     * @return \Illuminate\View\View
     */
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

    /**
     * Menampilkan halaman pinjaman untuk anggota.
     * 
     * Fungsi ini mengambil data pinjaman anggota yang sedang login terakhir dan dalam status dalam pembayaran.
     * 
     * @return \Illuminate\View\View
     */
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


    /**
     * Menampilkan halaman unit konsumsi untuk anggota.
     * 
     * Fungsi ini mengambil data unit konsumsi anggota yang sedang login terakhir dan dalam status dalam pembayaran.
     * 
     * @return \Illuminate\View\View
     */
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

    /**
     * Menampilkan halaman riwayat untuk anggota.
     * 
     * @return \Illuminate\View\View
     */
    public function riwayat()
    {
        return view('anggota.riwayat');
    }


    /**
     * Menampilkan halaman profil untuk anggota.
     * 
     * Fungsi ini mengambil data anggota yang sedang login
     * dan menampilkannya pada halaman profil.
     * 
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $anggota = Auth::guard('anggota')->user();

        return view('anggota.profile', compact('anggota'));
    }

    /**
     * Memperbarui profil anggota.
     * 
     * Fungsi ini menangani permintaan untuk memperbarui informasi profil anggota,
     * termasuk nama, telepon, email, foto profil, dan password.
     * 
     * Mengubah juga nama anggota pada tabel lain yang terkait dengan anggota,
     * seperti kas_harian, pengajuan_pinjaman, pengajuan_unit_konsumsi, dan simpanan.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
