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
    public function index()
    {
        return view('admin.pengajuan-unit-konsumsi.index-pengajuan-unit-konsumsi');
    }

    public function setujuiUnitKonsumsi($id)
    {
        $pengajuanUnitKonsumsi = PengajuanUnitKonsumsi::find($id);

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
            'jenis_transaksi' => 'kas keluar',
            'tanggal' => $pengajuanUnitKonsumsi->created_at->format('Y-m-d'),
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

        $bulan = strtolower($pengajuanUnitKonsumsi->created_at->translatedFormat('F'));
        $tahun = $pengajuanUnitKonsumsi->created_at->format('Y'); 

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

        $lama_angsuran = (int) preg_replace('/[^0-9]/', '', $pengajuanUnitKonsumsi->lama_angsuran);

        AngsuranUnitKonsumsi::create([
            'unit_konsumsi_id' => $unitKonsumsi->id,
            'kurang_jasa' => intval($pengajuanUnitKonsumsi->nominal_bunga * $lama_angsuran),
            'kurang_angsuran' => intval($pengajuanUnitKonsumsi->nominal_pokok * $lama_angsuran),
            'sisa_angsuran' => $lama_angsuran
        ]);

        $pengajuanUnitKonsumsi->update([
            'status' => 'disetujui'
        ]);

        return back()->with('success', 'Pengajuan Unit Konsumsi berhasil disetujui');
    }

    public function tolakUnitKonsumsi($id)
    {
        $pengajuanUnitKonsumsi = PengajuanUnitKonsumsi::find($id);

        if (!$pengajuanUnitKonsumsi) {
            return back()->with(['error' => 'Unit Konsumsi tidak ditemukan']);
        }

        if ($pengajuanUnitKonsumsi->status !== 'menunggu') {
            return back()->with(['error' => 'Unit Konsumsi sudah diproses']);
        }

        $pengajuanUnitKonsumsi->update([
            'status' => 'ditolak'
        ]);

        return back()->with('success', 'Pengajuan Unit Konsumsi berhasil ditolak');
    }
}
