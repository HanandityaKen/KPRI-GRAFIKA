<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Saldo;
use App\Models\KasHarian;
use App\Models\Jkk;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\UnitKonsumsi;
use App\Models\AngsuranUnitKonsumsi;
use Carbon\Carbon;

class PengajuanUnitKonsumsiController extends Controller
{
    /**
     * Menampilkan halaman index pengajuan unit konsumsi di admin
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.pengajuan-unit-konsumsi.index-pengajuan-unit-konsumsi');
    }

    /**
     * Proses setujui pengajuan pinjaman
     * 
     * Fungsi ini menangani proses persetujuan pengajuan unit konsumsi anggota dengan:
     * - Mengambil pengajuan unit konsumsi berdasarkan ID
     * - Memeriksa apakah pengajuan unit konsumsi ditemukan
     * - Memeriksa status pengajuan unit konsumsi
     * - Memeriksa apakah anggota masih memiliki unit konsumsi yang belum lunas
     * - Mengambil saldo terakhir koperasi
     * - Memeriksa apakah saldo koperasi cukup untuk menyetujui unit konsumsi
     * - Create kas harian keluar untuk barang_kons
     * - Memperbarui saldo koperasi setelah barang_kons
     * - Create Jkk untuk kas harian keluar
     * - Create unit konsumsi baru
     * - Create angsuran baru untuk unit konsumsi
     * - Memperbarui status pengajuan unit konsumsi menjadi disetujui
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setujuiUnitKonsumsi(Request $request, $id)
    {
        $request->validate([
            'reviewed_by' => 'required',
        ]);

        $pengajuanUnitKonsumsi = PengajuanUnitKonsumsi::find($id);

        $reviewedBy = $request->reviewed_by;

        if (!$pengajuanUnitKonsumsi) {
            return back()->with(['error' => 'Unit Konsumsi tidak ditemukan']);
        }

        if ($pengajuanUnitKonsumsi->status !== 'menunggu') {
            return back()->with(['error' => 'Unit Konsumsi sudah diproses']);
        }

        $unitKonsumsi = UnitKonsumsi::whereHas('pengajuan_unit_konsumsi', function ($query) use ($pengajuanUnitKonsumsi) {
            $query->where('anggota_id', $pengajuanUnitKonsumsi->anggota_id);
        })
        ->where('status', 'dalam pembayaran')
        ->exists();

        if ($unitKonsumsi) {
            return back()->with(['error' => 'Anggota ini masih memiliki angsuran yang belum lunas.']);
        }

        $nominalUnitKonsumsi = $pengajuanUnitKonsumsi->nominal;

        $saldoTerakhir = Saldo::first();

        if ($saldoTerakhir->saldo < $nominalUnitKonsumsi) {
            return back()->with(['error' => 'Saldo Koperasi tidak cukup']);
        }

        $kasHarian = KasHarian::create([
            'anggota_id' => $pengajuanUnitKonsumsi->anggota_id,
            'nama_anggota' => $pengajuanUnitKonsumsi->nama_anggota,
            'jenis_transaksi' => 'kas keluar',
            'tanggal' => $pengajuanUnitKonsumsi->tanggal,
            'barang_kons' => $nominalUnitKonsumsi,

            'pokok'             => 0,
            'wajib'             => 0,
            'manasuka'          => 0,
            'wajib_pinjam'      => 0,
            'qurban'            => 0,
            'angsuran'          => 0,
            'jasa'              => 0,
            'js_admin'          => 0,
            'lain_lain'         => 0,
            'piutang'           => 0,
            'hutang'            => 0,
            'b_umum'            => 0,
            'b_orgns'           => 0,
            'b_oprs'            => 0,
            'b_lain'            => 0,
            'tnh_kav'           => 0,
            'keterangan'        => 'Unit atau Barang Konsumsi'
        ]);

        $saldoTerakhir->update([
            'saldo' => $saldoTerakhir->saldo - $nominalUnitKonsumsi
        ]);

        $bulan = strtolower(Carbon::parse($pengajuanUnitKonsumsi->tanggal)->translatedFormat('F'));
        $tahun = Carbon::parse($pengajuanUnitKonsumsi->tanggal)->format('Y');

        Jkk::create([
            'kas_harian_id' => $kasHarian->id,
            'anggota_id' => $kasHarian->anggota_id,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        $unitKonsumsi = UnitKonsumsi::create([
            'pengajuan_unit_konsumsi_id' => $pengajuanUnitKonsumsi->id,
            'kas_harian_id' => $kasHarian->id,
            'status' => 'dalam pembayaran'
        ]);

        $kasHarian->update([
            'unit_konsumsi_id' => $unitKonsumsi->id
        ]);

        $lama_angsuran = (int) preg_replace('/[^0-9]/', '', $pengajuanUnitKonsumsi->lama_angsuran);

        AngsuranUnitKonsumsi::create([
            'unit_konsumsi_id' => $unitKonsumsi->id,
            'kurang_jasa' => intval($pengajuanUnitKonsumsi->nominal_bunga * $lama_angsuran),
            'kurang_angsuran' => intval($pengajuanUnitKonsumsi->nominal_pokok * $lama_angsuran),
            'sisa_angsuran' => $lama_angsuran
        ]);

        $pengajuanUnitKonsumsi->update([
            'reviewed_by' => $reviewedBy,
            'status' => 'disetujui',
        ]);

        return back()->with('success', 'Pengajuan Unit Konsumsi berhasil disetujui');
    }

    /**
     * Proses tolak pengajuan unit konsumsi
     * 
     * Fungsi ini menangani proses penolakan pengajuan unit konsumsi anggota dengan:
     * - Mengambil pengajuan unit konsumsi berdasarkan ID
     * - Memeriksa apakah pengajuan unit konsumsi ditemukan
     * - Memeriksa status pengajuan unit konsumsi
     * - Memperbarui status pengajuan unit konsumsi menjadi ditolak
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tolakUnitKonsumsi(Request $request, $id)
    {
        $request->validate([
            'reviewed_by' => 'required',
        ]);

        $pengajuanUnitKonsumsi = PengajuanUnitKonsumsi::find($id);

        $reviewedBy = $request->reviewed_by;

        if (!$pengajuanUnitKonsumsi) {
            return back()->with(['error' => 'Unit Konsumsi tidak ditemukan']);
        }

        if ($pengajuanUnitKonsumsi->status !== 'menunggu') {
            return back()->with(['error' => 'Unit Konsumsi sudah diproses']);
        }

        $pengajuanUnitKonsumsi->update([
            'reviewed_by' => $reviewedBy,
            'status' => 'ditolak',
        ]);

        return back()->with('success', 'Pengajuan Unit Konsumsi berhasil ditolak');
    }

    public function detail($id)
    {
        $pengajuanUnitKonsumsi = PengajuanUnitKonsumsi::find($id);

        return view('admin.pengajuan-unit-konsumsi.detail-pengajuan-unit-konsumsi', compact('pengajuanUnitKonsumsi'));
    }
}
