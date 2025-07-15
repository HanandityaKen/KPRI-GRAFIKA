<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Angsuran;
use App\Models\KasHarian;
use App\Models\Jkm;
use App\Models\Saldo;
use Carbon\Carbon;

class AngsuranController extends Controller
{
    /**
     * Menampilkan halaman index angsuran di admin
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.angsuran.index-angsuran');
    }

    /**
     * Menampilan halaman pembayaran angsuran pinjaman di admin
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $angsuran  = Angsuran::findOrFail($id);

        return view('admin.angsuran.bayar-angsuran', compact('angsuran'));
    }

    /**
     * Proses pembayaran angsuran pinjaman
     * 
     * Fungsi ini menangani proses pembayaran angsuran pinjaman anggota dengan:
     * - Validasi input angsuran dan jasa
     * - Perhitungan tunggakan, kurang angsuran, kurang jasa, angsuran ke, dan sisa angsuran
     * - Pembaruan status pinjaman menjadi lunas jika sisa angsuran menjadi 0
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
            'tanggal' => 'required|date_format:d-m-Y',
            'angsuran' => 'nullable|string',
            'angsuran_manual' => 'nullable|string',
            'jasa' => 'required|string',
        ]);

        $tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');

        // $angsuranInput = $request->angsuran ?? $request->angsuran_manual ?? '0';
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

        if ($bayarAngsuran === 0 && $bayarJasa === 0) {
            return back()->withErrors(['error' => 'Angsuran dan jasa tidak boleh 0!'])->withInput();
        }

        $angsuran = Angsuran::findOrFail($id);

        $anggota_id = $angsuran->pinjaman->pengajuan_pinjaman->anggota_id;

        $nama = $angsuran->pinjaman->pengajuan_pinjaman->nama_anggota;

        $pinjaman_id = $angsuran->pinjaman->id;

        $tunggakan = $angsuran->tunggakan;

        if ($angsuran->sisa_angsuran == 1 && $angsuranInput == 0) {
            return back()->withErrors(['angsuran' => '* Angsuran harus diisi karena ini adalah pembayaran terakhir!'])->withInput();
        }        

        if ($bayarAngsuran == 0) {
            $angsuran->tunggakan = $angsuran->tunggakan + intval($angsuran->pinjaman->pengajuan_pinjaman->nominal_pokok);
            $angsuran->kurang_jasa = max(0, $angsuran->kurang_jasa - $bayarJasa);
        } else {
            // Potong tunggakan dulu
            $sisaBayarPokok = $bayarAngsuran;

            if ($angsuran->tunggakan > 0) {
                if ($sisaBayarPokok >= $angsuran->tunggakan) {
                    $sisaBayarPokok = $sisaBayarPokok - $angsuran->tunggakan;
                    $angsuran->tunggakan = 0;
                } else {
                    $angsuran->tunggakan = $angsuran->tunggakan - $sisaBayarPokok;
                    $sisaBayarPokok = 0;
                }
            }

            if ($sisaBayarPokok == $angsuran->kurang_angsuran) {
                // Lunas
                $angsuran->kurang_angsuran = 0;
                $angsuran->kurang_jasa = 0;
                $angsuran->sisa_angsuran = 0;
            } else {
                $angsuran->kurang_angsuran = max(0, $angsuran->kurang_angsuran - $sisaBayarPokok);
                $angsuran->kurang_jasa = max(0, $angsuran->kurang_jasa - $bayarJasa);
                $angsuran->sisa_angsuran = max(0, $angsuran->sisa_angsuran - 1);
            }

            // Bayar pokok → hitung sebagai 1 angsuran
            $angsuran->angsuran_ke = $angsuran->angsuran_ke + 1;
        }

        $angsuran->save();

        if ($angsuran->kurang_angsuran == 0) {
            $pinjaman = $angsuran->pinjaman;
            $pinjaman->update([
                'status' => 'lunas'
            ]);

            $angsuran->update([
                'kurang_angsuran' => 0,
                'kurang_jasa' => 0,
                'sisa_angsuran' => 0
            ]);
        }

        $kasHarian = KasHarian::create([
            'anggota_id' => $anggota_id,
            'nama_anggota' => $nama,
            'pinjaman_id' => $pinjaman_id,
            'jenis_transaksi' => 'kas masuk',
            'tanggal' => $tanggal,
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
            'keterangan'        => 'Bayar Angsuran Pinjaman'
        ]);

        $bulan = strtolower(Carbon::createFromFormat('Y-m-d', $tanggal)->translatedFormat('F'));
        $tahun = Carbon::createFromFormat('Y-m-d', $tanggal)->format('Y');

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
