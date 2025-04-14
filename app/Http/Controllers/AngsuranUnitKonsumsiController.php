<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AngsuranUnitKonsumsi;
use App\Models\KasHarian;
use App\Models\Jkm;
use App\Models\Saldo;

class AngsuranUnitKonsumsiController extends Controller
{
    /**
     * Menampilkan halaman index angsuran unit konsumsi
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.angsuran-unit-konsumsi.index-angsuran-unit-konsumsi');
    }

    /**
     * Menampilkan halaman pembayaran angsuran unit konsumsi 
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $angsuran  = AngsuranUnitKonsumsi::findOrFail($id);

        return view('admin.angsuran-unit-konsumsi.bayar-angsuran-unit-konsumsi', compact('angsuran'));
    }

    /**
     * Proses pembayaran angsuran unit konsumsi
     * 
     * Fungsi ini menangani proses pembayaran angsuran unit konsumsi anggota dengan:
     * - Validasi input angsuran dan jasa
     * - Perhitungan tunggakan, kurang angsuran, kurang jasa, angsuran ke, dan sisa angsuran
     * - Pembaruan status unit konsumsi menjadi lunas jika sisa angsuran menjadi 0
     * - Pencatatan pembayaran ke dalam tabel kas_harian
     * - Pencatatan ke dalam tabel jkm
     * - Pembaruan saldo koperasi
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

        $nama = $angsuranUnitKonsumsi->unit_konsumsi->pengajuan_unit_konsumsi->nama_anggota;

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
            'nama_anggota' => $nama,
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

        return redirect()->route('admin.angsuran-unit-konsumsi.index')->with('success', 'Pembayaran Angsuran Unit Konsumsi Berhasil!');
    }
}
