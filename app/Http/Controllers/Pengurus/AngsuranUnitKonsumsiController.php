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
    /**
     * Menampilkan halaman index angsuran unit konsumsi di pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pengurus.angsuran-unit-konsumsi.index-angsuran-unit-konsumsi');
    }

    /**
     * Menampilkan halaman pembayaran angsuran unit konsumsi di pengurus
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $angsuran  = AngsuranUnitKonsumsi::findOrFail($id);

        return view('pengurus.angsuran-unit-konsumsi.bayar-angsuran-unit-konsumsi', compact('angsuran'));
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
            'angsuran_manual' => 'nullable|string',
            'jasa' => 'required|string',
        ]);

        $angsuranInput = ($request->angsuran ?? $request->angsuran_manual ?? 0);

        if (strpos($angsuranInput, 'Rp') !== false) {
            // Format Rp dengan titik ribuan, hapus Rp, spasi, titik, lalu ubah koma jadi titik jika ada
            $clean = str_replace(['Rp', ' ', '.'], '', $angsuranInput);
            $clean = str_replace(',', '.', $clean);
            $bayarAngsuran = intval(floatval($clean));
        } else {
            // Format angka biasa dengan titik sebagai desimal, jangan hapus titik
            $clean = str_replace(['Rp', ' ', ','], '', $angsuranInput);
            $bayarAngsuran = intval(floatval($clean));
        }

        $bayarJasa = intval(str_replace(['Rp', '.', ' '], '', $request->jasa ?? '0'));

        $angsuranUnitKonsumsi = AngsuranUnitKonsumsi::findOrFail($id);

        $anggota_id = $angsuranUnitKonsumsi->unit_konsumsi->pengajuan_unit_konsumsi->anggota_id;

        $nama = $angsuranUnitKonsumsi->unit_konsumsi->pengajuan_unit_konsumsi->nama_anggota;

        $tunggakan = $angsuranUnitKonsumsi->tunggakan;

        if ($angsuranUnitKonsumsi->sisa_angsuran == 1 && $angsuranInput == 0) {
            return back()->withErrors(['angsuran' => '* Angsuran harus diisi karena ini adalah pembayaran terakhir!'])->withInput();
        }    

        if ($bayarAngsuran == 0) {
            $angsuranUnitKonsumsi->tunggakan = $angsuranUnitKonsumsi->tunggakan + intval($angsuranUnitKonsumsi->unit_konsumsi->pengajuan_unit_konsumsi->nominal_pokok);
            $angsuranUnitKonsumsi->kurang_jasa = max(0, $angsuranUnitKonsumsi->kurang_jasa - $bayarJasa);
        } else {
            // Potong tunggakan dulu
            $sisaBayarPokok = $bayarAngsuran;

            if ($angsuranUnitKonsumsi->tunggakan > 0) {
                if ($sisaBayarPokok >= $angsuranUnitKonsumsi->tunggakan) {
                    $sisaBayarPokok = $sisaBayarPokok - $angsuranUnitKonsumsi->tunggakan;
                    $angsuranUnitKonsumsi->tunggakan = 0;
                } else {
                    $angsuranUnitKonsumsi->tunggakan = $angsuranUnitKonsumsi->tunggakan - $sisaBayarPokok;
                    $sisaBayarPokok = 0;
                }
            }

            if ($sisaBayarPokok == $angsuranUnitKonsumsi->kurang_angsuran) {
                //Lunas
                $angsuranUnitKonsumsi->kurang_angsuran = 0;
                $angsuranUnitKonsumsi->kurang_jasa = 0;
                $angsuranUnitKonsumsi->sisa_angsuran = 0;
            } else {
                $angsuranUnitKonsumsi->kurang_angsuran = max(0, $angsuranUnitKonsumsi->kurang_angsuran - $sisaBayarPokok);
                $angsuranUnitKonsumsi->kurang_jasa = max(0, $angsuranUnitKonsumsi->kurang_jasa - $bayarJasa);
                $angsuranUnitKonsumsi->sisa_angsuran = max(0, $angsuranUnitKonsumsi->sisa_angsuran - 1);
            }

            $angsuranUnitKonsumsi->angsuran_ke = $angsuranUnitKonsumsi->angsuran_ke + 1;
        }

        $angsuranUnitKonsumsi->save();

        if ($angsuranUnitKonsumsi->sisa_angsuran == 0 && $angsuranUnitKonsumsi->kurang_angsuran == 0 && $angsuranUnitKonsumsi->kurang_jasa == 0) {
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

        return redirect()->route('pengurus.angsuran-unit-konsumsi.index')->with('success', 'Pembayaran Angsuran Unit Konsumsi Berhasil!');
    }
}
