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
     * Menampilkan halaman index pengajuan pinjaman
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
    public function setujuiPinjaman($id)
    {
        $pengajuanPinjaman = PengajuanPinjaman::find($id);

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
        ->exists();

        if ($pinjaman) {
            return back()->with(['error' => 'Anggota ini masih memiliki angsuran yang belum lunas.']);
        }

        $saldoTerakhir = Saldo::first();
        
        $jumlahPinjaman = $pengajuanPinjaman->jumlah_pinjaman;

        if ($saldoTerakhir->saldo < $jumlahPinjaman) {
            return back()->with(['error' => 'Saldo Koperasi tidak cukup']);
        }

        $kasHarianMasuk = KasHarian::create([
            'anggota_id' => $pengajuanPinjaman->anggota_id,
            'nama_anggota' => $pengajuanPinjaman->nama_anggota,
            'jenis_transaksi' => 'kas masuk',
            'tanggal' => $pengajuanPinjaman->created_at->format('Y-m-d'),
            'js_admin' => $pengajuanPinjaman->biaya_admin,

            'pokok'             => 0,
            'wajib'             => 0,
            'manasuka'          => 0,
            'wajib_pinjam'      => 0,
            'qurban'            => 0,
            'angsuran'          => 0,
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
            'keterangan'        => 'Biaya Admin'
        ]);

        $saldoTerakhir->update([
            'saldo' => $saldoTerakhir->saldo + $pengajuanPinjaman->biaya_admin
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
            'hutang' => $pengajuanPinjaman->jumlah_pinjaman,

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
            'saldo' => $saldoTerakhir->saldo - $jumlahPinjaman
        ]);

        Jkk::create([
            'kas_harian_id' => $kasHarianKeluar->id,
            'anggota_id' => $kasHarianKeluar->anggota_id,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        $pinjaman = Pinjaman::create([
            'pengajuan_pinjaman_id' => $pengajuanPinjaman->id,
            'kas_harian_id' => $kasHarianKeluar->id,
            'status' => 'dalam pembayaran'
        ]);

        $lama_angsuran = (int) preg_replace('/[^0-9]/', '', $pengajuanPinjaman->lama_angsuran);

        Angsuran::create([
            'pinjaman_id' => $pinjaman->id,
            'kurang_jasa' => intval($pengajuanPinjaman->nominal_bunga * $lama_angsuran),
            'kurang_angsuran' => intval($pengajuanPinjaman->nominal_pokok * $lama_angsuran),
            'sisa_angsuran' => $lama_angsuran
        ]);

        $pengajuanPinjaman->update([
            'status' => 'disetujui'
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
    public function tolakPinjaman($id)
    {
        $pengajuanPinjaman = PengajuanPinjaman::find($id);

        if (!$pengajuanPinjaman) {
            return back()->with(['error' => 'Pinjaman tidak ditemukan']);
        }

        if ($pengajuanPinjaman->status !== 'menunggu') {
            return back()->with(['error' => 'Pinjaman sudah diproses']);
        }

        $pengajuanPinjaman->update([
            'status' => 'ditolak'
        ]);

        return back()->with('success', 'Pengajuan Pinjaman berhasil ditolak');
    }

}
