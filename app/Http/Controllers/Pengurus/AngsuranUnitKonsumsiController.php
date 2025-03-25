<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AngsuranUnitKonsumsi;
use App\Models\KasHarian;
use App\Models\Jkm;
use App\Models\Saldo;

class AngsuranUnitKonsumsiController extends Controller
{
    public function index()
    {
        return view('pengurus.angsuran-unit-konsumsi.index-angsuran-unit-konsumsi');
    }

    public function edit(string $id)
    {
        $angsuran  = AngsuranUnitKonsumsi::findOrFail($id);

        return view('pengurus.angsuran-unit-konsumsi.bayar-angsuran-unit-konsumsi', compact('angsuran'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'angsuran' => 'nullable|string',
            'jasa' => 'required|string',
        ]);

        $bayarAngsuran = intval($request->angsuran);
        $bayarJasa = intval(str_replace(['Rp', '.', ' '], '', $request->jasa ?? '0'));

        $angsuranUnitKonsumsi = AngsuranUnitKonsumsi::findOrFail($id);

        $anggota_id = $angsuranUnitKonsumsi->unit_konsumsi->pengajuan_unit_konsumsi->anggota_id;

        $tunggakan = $angsuranUnitKonsumsi->tunggakan;

        if ($angsuranUnitKonsumsi->sisa_angsuran == 1 && empty($request->angsuran)) {
            return back()->withErrors(['angsuran' => '* Angsuran harus diisi karena ini adalah pembayaran terakhir!'])->withInput();
        }    

        if ($bayarAngsuran == 0) {
            $angsuranUnitKonsumsi->tunggakan = $angsuranUnitKonsumsi->tunggakan + intval($angsuranUnitKonsumsi->unit_konsumsi->pengajuan_unit_konsumsi->nominal_pokok);
        } else {
            $angsuranUnitKonsumsi->kurang_angsuran = $angsuranUnitKonsumsi->kurang_angsuran - $bayarAngsuran;
            $angsuranUnitKonsumsi->tunggakan = $angsuranUnitKonsumsi->tunggakan - $tunggakan;
        }

        $angsuranUnitKonsumsi->kurang_jasa = max(0, $angsuranUnitKonsumsi->kurang_jasa - $bayarJasa);

        $angsuranUnitKonsumsi->angsuran_ke = $angsuranUnitKonsumsi->angsuran_ke + 1;
        $angsuranUnitKonsumsi->sisa_angsuran = $angsuranUnitKonsumsi->sisa_angsuran - 1;

        $angsuranUnitKonsumsi->save();

        if ($angsuranUnitKonsumsi->sisa_angsuran == 0) {
            $unit_konsumsi = $angsuranUnitKonsumsi->unit_konsumsi;
            $unit_konsumsi->update([
                'status' => 'lunas'
            ]);
        }

        $kasHarian = KasHarian::create([
            'anggota_id' => $anggota_id,
            'jenis_transaksi' => 'kas masuk',
            'tanggal' => $angsuranUnitKonsumsi->updated_at->format('Y-m-d'),
            'barang_kons' => $bayarAngsuran,
            'jasa' => $bayarJasa,
            
            'pokok'             => 0,
            'wajib'             => 0,
            'manasuka'          => 0,
            'wajib_pinjam'      => 0,
            'qurban'            => 0,
            'angsuran'          => 0,
            'js_admin'          => 0,
            'lain_lain'         => 0,
            'piutang'           => 0,
            'hutang'            => 0,
            'b_umum'            => 0,
            'b_orgns'           => 0,
            'b_oprs'            => 0,
            'b_lain'            => 0,
            'tnh_kav'           => 0,
            'keterangan'        => 'Bayar Angsuran Unit atau Barang Konsumsi'
        ]);

        $bulan = strtolower($kasHarian->created_at->translatedFormat('F'));
        $tahun = $kasHarian->created_at->format('Y'); 

        Jkm::create([
            'kas_harian_id' => $kasHarian->id,
            'anggota_id' => $anggota_id,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        
        $saldoMasuk = $bayarAngsuran + $bayarJasa;

        $saldo = Saldo::first();

        $saldo->increment('saldo', $saldoMasuk);

        return redirect()->route('pengurus.angsuran-unit-konsumsi.index')->with('success', 'Pembayaran Angsuran Unit Konsumsi Berhasil!');
    }
}
