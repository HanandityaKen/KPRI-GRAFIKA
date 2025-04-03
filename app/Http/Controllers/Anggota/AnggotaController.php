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
        $anggotaId = Auth::guard('anggota')->user()->id;

        // Pagination dengan mengambil data KasHarian dan melakukan pemetaan
        $riwayat = KasHarian::where('anggota_id', $anggotaId)
            ->orderByDesc('created_at')
            ->paginate(10)
            ->through(function ($item) {
                $fields = [
                    'pokok' => 'Pokok',
                    'wajib' => 'Wajib',
                    'manasuka' => 'Manasuka',
                    'wajib_pinjam' => 'Wajib Pinjam',
                    'qurban' => 'Qurban',
                    'angsuran' => 'Angsuran',
                    'jasa' => 'Jasa',
                    'js_admin' => 'Jasa admin',
                    'lain_lain' => 'Lain-lain',
                    'barang_kons' => 'Pengajuan unit konsumsi',
                    'piutang' => 'Piutang',
                    'hutang' => 'Pengajuan pinjaman',
                    'b_umum' => 'Biaya Umum',
                    'b_orgns' => 'Biaya Organisasi',
                    'b_oprs' => 'Biaya Operasional',
                    'b_lain' => 'Biaya Lain',
                    'tnh_kav' => 'Tanah Kavling'
                ];

                $transaksi = [];
                $totalJumlah = 0;

                foreach ($fields as $field => $label) {
                    if (!empty($item->$field)) {
                        if (in_array($field, ['wajib', 'wajib_pinjam', 'manasuka', 'qurban']) && $item->jenis_transaksi == 'kas keluar') {
                            $transaksi[] = $label; 
                            $totalJumlah -= $item->$field; 
                        } else {
                            $transaksi[] = $label;
                            $totalJumlah += $item->$field;
                        }
                    }
                }

                if (!empty($item->jasa) && !empty($item->angsuran)) {
                    $item->transaksi = 'Bayar angsuran pinjaman';
                    $item->jumlah = $totalJumlah;
                } elseif (!empty($item->jasa) && !empty($item->barang_kons)) {
                    $item->transaksi = 'Bayar angsuran unit konsumsi';
                    $item->jumlah = $totalJumlah; 
                } elseif (!empty($item->jasa)) {
                    $item->transaksi = 'Bayar jasa';
                    $item->jumlah = $totalJumlah; 
                } else {
                    // Gabungkan transaksi menjadi satu string
                    $item->transaksi = implode(', ', $transaksi);
                    $item->jumlah = $totalJumlah; 
                }

                return $item;
            });

        return view('anggota.riwayat', compact('riwayat'));
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
