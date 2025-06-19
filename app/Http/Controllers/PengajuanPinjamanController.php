<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Saldo;
use App\Models\KasHarian;
use App\Models\Jkm;
use App\Models\Jkk;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use App\Models\Angsuran;
use Carbon\Carbon;

class PengajuanPinjamanController extends Controller
{
    /**
     * Menampilkan halaman index pengajuan pinjaman di admin
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.pengajuan-pinjaman.index-pengajuan-pinjaman');
    }

    /**
     * Proses setujui pengajuan pinjaman
     * 
     * Fungsi ini menangani proses persetujuan pengajuan pinjaman anggota dengan:
     * - Mengambil pengajuan pinjaman berdasarkan ID
     * - Memeriksa apakah pengajuan pinjaman ditemukan
     * - Memeriksa status pengajuan pinjaman
     * - Memeriksa apakah anggota masih memiliki pinjaman yang belum lunas
     * - Mengambil saldo terakhir koperasi
     * - Memeriksa apakah saldo koperasi cukup untuk menyetujui pinjaman
     * - Create kas harian masuk untuk biaya admin
     * - Memperbarui saldo koperasi setelah biaya admin
     * - Create Jkm untuk kas harian masuk
     * - Create kas harian keluar untuk pinjaman
     * - Memperbarui saldo koperasi setelah pinjaman
     * - Create Jkk untuk kas harian keluar
     * - Create pinjaman baru
     * - Create angsuran baru untuk pinjaman
     * - Memperbarui status pengajuan pinjaman menjadi disetujui
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setujuiPinjaman(Request $request, $id)
    {
        $request->validate([
            'reviewed_by' => 'required'
        ]);

        $pengajuanPinjaman = PengajuanPinjaman::find($id);

        $reviewedBy = $request->reviewed_by;

        if (!$pengajuanPinjaman) {
            return back()->with(['error' => 'Pinjaman tidak ditemukan']);
        }

        if ($pengajuanPinjaman->status !== 'menunggu') {
            return back()->with(['error' => 'Pinjaman sudah diproses']);
        }

        $pinjaman = Pinjaman::whereHas('pengajuan_pinjaman', function ($query) use ($pengajuanPinjaman) {
            $query->where('anggota_id', $pengajuanPinjaman->anggota_id);
        })
        ->where('status', 'dalam pembayaran')
        ->orderBy('created_at', 'desc')
        ->first();

        $saldoTerakhir = Saldo::first();
        
        $jumlahPinjaman = $pengajuanPinjaman->jumlah_pinjaman;

        if ($saldoTerakhir->saldo < $jumlahPinjaman) {
            return back()->with(['error' => 'Saldo Koperasi tidak cukup']);
        }

        // Cek angsuran lama
        $angsuranLama = Angsuran::whereHas('pinjaman.pengajuan_pinjaman', function ($query) use ($pengajuanPinjaman) {
            $query->where('anggota_id', $pengajuanPinjaman->anggota_id);
        })->orderBy('id', 'desc')->first();

        if ($pengajuanPinjaman->jumlah_pinjaman < 5000000) {
            // Jika jumlah pinjaman kurang dari 5 juta
            $jumlahPinjamanBaru = intval($pengajuanPinjaman->jumlah_pinjaman);
        } else {
            // Jika jumlah pinjaman lebih dari atau sama dengan 5 juta

            // Hitung sisa jumlah pinjaman hasil dari pengajuan pinjaman dikurangi angsuran lama
            $jumlahPinjamanBaru = intval($pengajuanPinjaman->total_pinjaman - ($angsuranLama->kurang_angsuran ?? 0));

            if ($pinjaman) {
                if ($pengajuanPinjaman->jumlah_pinjaman <= $angsuranLama->kurang_angsuran) {
                    return back()->with(['error' => 'Jumlah pinjaman tidak boleh kurang dari atau sama dengan sisa angsuran']);
                }
    
                $pinjaman->update([
                    'status' => 'lunas'
                ]);
            }
            
            if ($angsuranLama) {
                $angsuranLama->update([
                    'kurang_angsuran' => 0,
                    'kurang_jasa' => 0,
                    'sisa_angsuran' => 0
                ]);
                
            }
        }            

        $kasHarianMasuk = KasHarian::create([
            'anggota_id' => $pengajuanPinjaman->anggota_id,
            'nama_anggota' => $pengajuanPinjaman->nama_anggota,
            'jenis_transaksi' => 'kas masuk',
            'tanggal' => $pengajuanPinjaman->created_at->format('Y-m-d'),
            'angsuran' => ($angsuranLama && $angsuranLama->kurang_angsuran > 0 && $pengajuanPinjaman->jumlah_pinjaman >= 5000000) ? $angsuranLama->kurang_angsuran : 0,
            'js_admin' => $pengajuanPinjaman->biaya_admin,

            'pokok'             => 0,
            'wajib'             => 0,
            'manasuka'          => 0,
            'wajib_pinjam'      => 0,
            'qurban'            => 0,
            'jasa'              => 0,
            'lain_lain'         => 0,
            'barang_kons'       => 0,
            'piutang'           => 0,
            'hutang'            => 0,
            'b_umum'            => 0,
            'b_orgns'           => 0,
            'b_oprs'            => 0,
            'b_lain'            => 0,
            'tnh_kav'           => 0,
            'keterangan'        => ($angsuranLama && $angsuranLama->kurang_angsuran > 0 && $pengajuanPinjaman->jumlah_pinjaman >= 5000000) ? 'Biaya Admin dan Bayar Angsuran Sebelumnya' : 'Biaya Admin',
        ]);
        
        $saldoTerakhir->update([
            'saldo' => $saldoTerakhir->saldo + $pengajuanPinjaman->biaya_admin + (($angsuranLama && $angsuranLama->kurang_angsuran > 0 && $pengajuanPinjaman->jumlah_pinjaman >= 5000000) ? $angsuranLama->kurang_angsuran : 0)
        ]);

        $bulan = strtolower($pengajuanPinjaman->created_at->translatedFormat('F'));
        $tahun = $pengajuanPinjaman->created_at->format('Y'); 

        Jkm::create([
            'kas_harian_id' => $kasHarianMasuk->id,
            'anggota_id' => $pengajuanPinjaman->anggota_id,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        $kasHarianKeluar = KasHarian::create([
            'anggota_id' => $pengajuanPinjaman->anggota_id,
            'nama_anggota' => $pengajuanPinjaman->nama_anggota,
            'jenis_transaksi' => 'kas keluar',
            'tanggal' => $pengajuanPinjaman->created_at->format('Y-m-d'),
            'hutang' => $jumlahPinjamanBaru,

            'pokok'             => 0,
            'wajib'             => 0,
            'manasuka'          => 0,
            'wajib_pinjam'      => 0,
            'qurban'            => 0,
            'angsuran'          => 0,
            'jasa'              => 0,
            'js_admin'          => 0,
            'lain_lain'         => 0,
            'barang_kons'       => 0,
            'piutang'           => 0,
            'b_umum'            => 0,
            'b_orgns'           => 0,
            'b_oprs'            => 0,
            'b_lain'            => 0,
            'tnh_kav'           => 0,
            'keterangan'        => 'Pinjaman'
        ]);

        $saldoTerakhir->update([
            'saldo' => $saldoTerakhir->saldo - $jumlahPinjamanBaru
        ]);

        Jkk::create([
            'kas_harian_id' => $kasHarianKeluar->id,
            'anggota_id' => $kasHarianKeluar->anggota_id,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        $lama_angsuran = (int) preg_replace('/[^0-9]/', '', $pengajuanPinjaman->lama_angsuran);
        $kurangJasa = intval($pengajuanPinjaman->nominal_bunga * $lama_angsuran);
        $kurangAngsuran = intval($pengajuanPinjaman->nominal_pokok * $lama_angsuran);

        if ($pengajuanPinjaman->jumlah_pinjaman < 5000000 && $pinjaman) {
            $angsuranLama->update([
                'kurang_jasa' => $kurangJasa,
                'kurang_angsuran' => $kurangAngsuran,
                'sisa_angsuran' => $lama_angsuran,
                'angsuran_ke' => 0
            ]);
        } else {
            $pinjaman = Pinjaman::create([
                'pengajuan_pinjaman_id' => $pengajuanPinjaman->id,
                'kas_harian_id' => $kasHarianKeluar->id,
                'status' => 'dalam pembayaran'
            ]);
            
            Angsuran::create([
                'pinjaman_id' => $pinjaman->id,
                'kurang_jasa' => $kurangJasa,
                'kurang_angsuran' => $kurangAngsuran,
                'sisa_angsuran' => $lama_angsuran
            ]);
        }
        
        $pengajuanPinjaman->update([
            'reviewed_by' => $reviewedBy,
            'status' => 'disetujui',
        ]);

        return back()->with('success', 'Pengajuan Pinjaman berhasil disetujui');
    }

    /**
     * Proses tolak pengajuan pinjaman
     * 
     * Fungsi ini menangani proses penolakan pengajuan pinjaman anggota dengan:
     * - Mengambil pengajuan pinjaman berdasarkan ID
     * - Memeriksa apakah pengajuan pinjaman ditemukan
     * - Memeriksa status pengajuan pinjaman
     * - Memperbarui status pengajuan pinjaman menjadi ditolak
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tolakPinjaman(Request $request, $id)
    {
        $request->validate([
            'reviewed_by' => 'required'
        ]);

        $pengajuanPinjaman = PengajuanPinjaman::find($id);

        $reviewedBy = $request->reviewed_by;

        if (!$pengajuanPinjaman) {
            return back()->with(['error' => 'Pinjaman tidak ditemukan']);
        }

        if ($pengajuanPinjaman->status !== 'menunggu') {
            return back()->with(['error' => 'Pinjaman sudah diproses']);
        }

        $pengajuanPinjaman->update([
            'reviewed_by' => $reviewedBy,
            'status' => 'ditolak',
        ]);

        return back()->with('success', 'Pengajuan Pinjaman berhasil ditolak');
    }

    public function detail($id)
    {
        $pengajuanPinjaman = PengajuanPinjaman::findOrFail($id);

        return view('admin.pengajuan-pinjaman.detail-pengajuan-pinjaman', compact('pengajuanPinjaman'));
    }
}
