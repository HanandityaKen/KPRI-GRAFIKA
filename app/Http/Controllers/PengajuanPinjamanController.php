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
    public function index()
    {
        return view('admin.pengajuan-pinjaman.index-pengajuan-pinjaman');
    }

    public function setujuiPinjaman($id)
    {
        $pengajuanPinjaman = PengajuanPinjaman::find($id);

        if (!$pengajuanPinjaman) {
            return back()->with(['error' => 'Pinjaman tidak ditemukan']);
        }

        if ($pengajuanPinjaman->status !== 'menunggu') {
            return back()->with(['error' => 'Pinjaman sudah diproses']);
        }

        $saldoTerakhir = Saldo::first();
        
        $jumlahPinjaman = $pengajuanPinjaman->jumlah_pinjaman;

        if ($saldoTerakhir->saldo < $jumlahPinjaman) {
            return back()->with(['error' => 'Saldo Koperasi tidak cukup']);
        }

        $kasHarianMasuk = KasHarian::create([
            'anggota_id' => $pengajuanPinjaman->anggota_id,
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
        ]);

        $pengajuanPinjaman->update([
            'status' => 'disetujui'
        ]);

        return back()->with('success', 'Pinjaman berhasil disetujui');
    }

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

        return back()->with('success', 'Pinjaman berhasil ditolak');
    }

}
