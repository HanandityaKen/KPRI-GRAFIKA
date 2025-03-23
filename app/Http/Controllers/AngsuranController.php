<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Angsuran;
use App\Models\KasHarian;
use App\Models\Jkm;
use App\Models\Saldo;

class AngsuranController extends Controller
{
    public function index()
    {
        return view('admin.angsuran.index-angsuran');
    }

    // Menampilkan form pembayaran angsuran
    public function edit(string $id)
    {
        $angsuran  = Angsuran::findOrFail($id);

        return view('admin.angsuran.bayar-angsuran', compact('angsuran'));
    }

    // Proses pembayaran angsuran
    public function update(Request $request, string $id)
    {
        $request->validate([
            'angsuran' => 'nullable|string',
            'jasa' => 'required|string',
        ]);

        $bayarAngsuran = intval($request->angsuran);
        $bayarJasa = intval(str_replace(['Rp', '.', ' '], '', $request->jasa ?? '0'));

        $angsuran = Angsuran::findOrFail($id);

        $anggota_id = $angsuran->pinjaman->pengajuan_pinjaman->anggota_id;

        $tunggakan = $angsuran->tunggakan;

        if ($angsuran->sisa_angsuran == 1 && empty($request->angsuran)) {
            return back()->withErrors(['angsuran' => '* Angsuran harus diisi karena ini adalah pembayaran terakhir!'])->withInput();
        }        

        if ($bayarAngsuran == 0) {
            $angsuran->tunggakan = $angsuran->tunggakan + intval($angsuran->pinjaman->pengajuan_pinjaman->nominal_pokok);
        } else {
            $angsuran->kurang_angsuran = $angsuran->kurang_angsuran - $bayarAngsuran;
            $angsuran->tunggakan = $angsuran->tunggakan - $tunggakan;
        }
        
        $angsuran->kurang_jasa = max(0, $angsuran->kurang_jasa - $bayarJasa);
        
        $angsuran->angsuran_ke = $angsuran->angsuran_ke + 1;
        $angsuran->sisa_angsuran = $angsuran->sisa_angsuran - 1;

        $angsuran->save();

        if ($angsuran->sisa_angsuran == 0) {
            $pinjaman = $angsuran->pinjaman;
            $pinjaman->update([
                'status' => 'lunas'
            ]);
        }

        $kasHarian = KasHarian::create([
            'anggota_id' => $anggota_id,
            'jenis_transaksi' => 'kas masuk',
            'tanggal' => $angsuran->updated_at->format('Y-m-d'),
            'angsuran' => $bayarAngsuran,
            'jasa' => $bayarJasa,

            'pokok'             => 0,
            'wajib'             => 0,
            'manasuka'          => 0,
            'wajib_pinjam'      => 0,
            'qurban'            => 0,
            'js_admin'          => 0,
            'lain_lain'         => 0,
            'barang_kons'       => 0,
            'piutang'           => 0,
            'hutang'            => 0,
            'b_umum'            => 0,
            'b_orgns'           => 0,
            'b_oprs'            => 0,
            'b_lain'            => 0,
            'tnh_kav'           => 0,
            'keterangan'        => 'Bayar Angsuran'
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
        
        return redirect()->route('admin.angsuran.index')->with('success', 'Pembayaran Angsuran Berhasil!');
    }

}
