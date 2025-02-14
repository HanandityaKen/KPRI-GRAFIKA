<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasHarian;
use App\Models\Jkm;
use App\Models\Jkk;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KasHarianController extends Controller
{
    public function index()
    {
        // $kasHarian = KasHarian::all();

        return view('admin.kas-harian.index-kas-harian');
    }

    public function create()
    {
        $namaList = Anggota::pluck('nama', 'id');

        return view('admin.kas-harian.create-kas-harian', compact('namaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_transaksi'   => 'required|in:kas masuk,kas keluar',
            'tanggal'           => 'required|date_format:d-m-Y',
            'anggota_id'        => 'required|string',
            'pokok'             => 'nullable|string',
            'wajib'             => 'nullable|string',
            'manasuka'          => 'nullable|string',
            'wajib_pinjam'      => 'nullable|string',
            'qurban'            => 'nullable|string',
            'angsuran'          => 'nullable|string',
            'jasa'              => 'nullable|string',
            'js_admin'          => 'nullable|string',
            'lain_lain'         => 'nullable|string',
            'barang_kons'       => 'nullable|string',
            'piutang'           => 'nullable|string',
            'hutang'            => 'nullable|string',
            'b_umum'            => 'nullable|string',
            'b_orgns'           => 'nullable|string',
            'b_oprs'            => 'nullable|string',
            'b_lain'            => 'nullable|string',
            'tnh_kav'           => 'nullable|string',
            'keterangan'        => 'nullable|string',
        ]);

        $tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');

        $pokok = intval(str_replace(['Rp', '.', ' '], '', $request->pokok));
        $wajib = intval(str_replace(['Rp', '.', ' '], '', $request->wajib));
        $manasuka = intval(str_replace(['Rp', '.', ' '], '', $request->manasuka));
        $wajib_pinjam = intval(str_replace(['Rp', '.', ' '], '', $request->wajib_pinjam));
        $qurban = intval(str_replace(['Rp', '.', ' '], '', $request->qurban));
        $angsuran = intval(str_replace(['Rp', '.', ' '], '', $request->angsuran));
        $jasa = intval(str_replace(['Rp', '.', ' '], '', $request->jasa));
        $js_admin = intval(str_replace(['Rp', '.', ' '], '', $request->js_admin));
        $lain_lain = intval(str_replace(['Rp', '.', ' '], '', $request->lain_lain));
        $barang_kons = intval(str_replace(['Rp', '.', ' '], '', $request->barang_kons));
        $piutang = intval(str_replace(['Rp', '.', ' '], '', $request->piutang));
        $hutang = intval(str_replace(['Rp', '.', ' '], '', $request->hutang));
        $b_umum = intval(str_replace(['Rp', '.', ' '], '', $request->b_umum));
        $b_orgns = intval(str_replace(['Rp', '.', ' '], '', $request->b_orgns));
        $b_oprs = intval(str_replace(['Rp', '.', ' '], '', $request->b_oprs));
        $b_lain = intval(str_replace(['Rp', '.', ' '], '', $request->b_lain));
        $tnh_kav = intval(str_replace(['Rp', '.', ' '], '', $request->tnh_kav));



        $kasHarian = KasHarian::create([
            'anggota_id'        => $request->anggota_id,
            'jenis_transaksi'   => $request->jenis_transaksi,
            'tanggal'           => $tanggal,
            'pokok'             => $pokok ?? 0,
            'wajib'             => $wajib ?? 0,
            'manasuka'          => $manasuka ?? 0,
            'wajib_pinjam'      => $wajib_pinjam ?? 0,
            'qurban'            => $qurban ?? 0,
            'angsuran'          => $angsuran ?? 0,
            'jasa'              => $jasa ?? 0,
            'js_admin'          => $js_admin ?? 0,
            'lain_lain'         => $lain_lain ?? 0,
            'barang_kons'       => $barang_kons ?? 0,
            'piutang'           => $piutang ?? 0,
            'hutang'            => $hutang ?? 0,
            'b_umum'            => $b_umum ?? 0,
            'b_orgns'           => $b_orgns ?? 0,
            'b_oprs'            => $b_oprs ?? 0,
            'b_lain'            => $b_lain ?? 0,
            'tnh_kav'           => $tnh_kav ?? 0,
            'keterangan'        => $request->keterangan ?? null,
        ]);

        $bulan = strtolower(Carbon::createFromFormat('Y-m-d', $tanggal)->translatedFormat('F'));
        $tahun = Carbon::createFromFormat('Y-m-d', $tanggal)->format('Y');

        if ($request->jenis_transaksi === 'kas masuk') {
            Jkm::create([
                'kas_harian_id' => $kasHarian->id,
                'bulan'         => $bulan,
                'tahun'         => $tahun,
                'keterangan'    => $request->keterangan,
            ]);
        }
        if ($request->jenis_transaksi === 'kas keluar') {
            Jkk::create([
                'kas_harian_id' => $kasHarian->id,
                'bulan'         => $bulan,
                'tahun'         => $tahun,
                'keterangan'    => $request->keterangan,
            ]);
        }

        return redirect()->route('admin.kas-harian.index')->with('success', 'Berhasil Menambahkan Kas Harian');
    }

    public function edit(string $id)
    {
        $kasHarian = KasHarian::findOrFail($id);

        $namaList = Anggota::pluck('nama', 'id');

        return view('admin.kas-harian.edit-kas-harian', compact('kasHarian', 'namaList'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'jenis_transaksi'   => 'required|in:kas masuk,kas keluar',
            'tanggal'           => 'required|date_format:d-m-Y',
            'anggota_id'        => 'required|string',
            'pokok'             => 'nullable|string',
            'wajib'             => 'nullable|string',
            'manasuka'          => 'nullable|string',
            'wajib_pinjam'      => 'nullable|string',
            'qurban'            => 'nullable|string',
            'angsuran'          => 'nullable|string',
            'jasa'              => 'nullable|string',
            'js_admin'          => 'nullable|string',
            'lain_lain'         => 'nullable|string',
            'barang_kons'       => 'nullable|string',
            'piutang'           => 'nullable|string',
            'hutang'            => 'nullable|string',
            'b_umum'            => 'nullable|string',
            'b_orgns'           => 'nullable|string',
            'b_oprs'            => 'nullable|string',
            'b_lain'            => 'nullable|string',
            'tnh_kav'           => 'nullable|string',
            'keterangan'        => 'nullable|string',
        ]);


        $tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');

        $tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');

        $pokok = intval(str_replace(['Rp', '.', ' '], '', $request->pokok));
        $wajib = intval(str_replace(['Rp', '.', ' '], '', $request->wajib));
        $manasuka = intval(str_replace(['Rp', '.', ' '], '', $request->manasuka));
        $wajib_pinjam = intval(str_replace(['Rp', '.', ' '], '', $request->wajib_pinjam));
        $qurban = intval(str_replace(['Rp', '.', ' '], '', $request->qurban));
        $angsuran = intval(str_replace(['Rp', '.', ' '], '', $request->angsuran));
        $jasa = intval(str_replace(['Rp', '.', ' '], '', $request->jasa));
        $js_admin = intval(str_replace(['Rp', '.', ' '], '', $request->js_admin));
        $lain_lain = intval(str_replace(['Rp', '.', ' '], '', $request->lain_lain));
        $barang_kons = intval(str_replace(['Rp', '.', ' '], '', $request->barang_kons));
        $piutang = intval(str_replace(['Rp', '.', ' '], '', $request->piutang));
        $hutang = intval(str_replace(['Rp', '.', ' '], '', $request->hutang));
        $b_umum = intval(str_replace(['Rp', '.', ' '], '', $request->b_umum));
        $b_orgns = intval(str_replace(['Rp', '.', ' '], '', $request->b_orgns));
        $b_oprs = intval(str_replace(['Rp', '.', ' '], '', $request->b_oprs));
        $b_lain = intval(str_replace(['Rp', '.', ' '], '', $request->b_lain));
        $tnh_kav = intval(str_replace(['Rp', '.', ' '], '', $request->tnh_kav));

        $kasHarian = KasHarian::findOrFail($id);

        $kasHarian->update([
            'anggota_id'        => $request->anggota_id,
            'jenis_transaksi'   => $request->jenis_transaksi,
            'tanggal'           => $tanggal,
            'pokok'             => $pokok ?? 0,
            'wajib'             => $wajib ?? 0,
            'manasuka'          => $manasuka ?? 0,
            'wajib_pinjam'      => $wajib_pinjam ?? 0,
            'qurban'            => $qurban ?? 0,
            'angsuran'          => $angsuran ?? 0,
            'jasa'              => $jasa ?? 0,
            'js_admin'          => $js_admin ?? 0,
            'lain_lain'         => $lain_lain ?? 0,
            'barang_kons'       => $barang_kons ?? 0,
            'piutang'           => $piutang ?? 0,
            'hutang'            => $hutang ?? 0,
            'b_umum'            => $b_umum ?? 0,
            'b_orgns'           => $b_orgns ?? 0,
            'b_oprs'            => $b_oprs ?? 0,
            'b_lain'            => $b_lain ?? 0,
            'tnh_kav'           => $tnh_kav ?? 0,
            'keterangan'        => $request->keterangan ?? null,
        ]);

        $bulan = strtolower(Carbon::createFromFormat('Y-m-d', $tanggal)->translatedFormat('F'));
        $tahun = Carbon::createFromFormat('Y-m-d', $tanggal)->format('Y');

        if ($request->jenis_transaksi === 'kas masuk') {

            $jkm = Jkm::where('kas_harian_id', $kasHarian->id)->first();

            if ($jkm) {
                $jkm->update([
                    'bulan'         => $bulan,
                    'tahun'         => $tahun,
                    'keterangan'    => $request->keterangan,
                ]);
            }

        }
        if ($request->jenis_transaksi === 'kas keluar') {

                $jkk = Jkk::where('kas_harian_id', $kasHarian->id)->first();

                if ($jkk) {
                    $jkk->update([
                        'bulan'         => $bulan,
                        'tahun'         => $tahun,
                        'keterangan'    => $request->keterangan,
                    ]);
                }

        }

        return redirect()->route('admin.kas-harian.index')->with('success', 'Berhasil Mengubah Kas Harian');

        //lebih simple
        // $kasHarian->update([
        //     'anggota_id'        => $request->anggota_id,
        //     'nama_transaksi'    => $request->nama_transaksi,
        //     'jenis_transaksi'   => $request->jenis_transaksi,
        //     'tanggal'           => $tanggal,
        //     'jumlah'            => $jumlah,
        //     'keterangan'        => $request->keterangan,
        // ]);

        // $kasHarian->anggota_id = $request->input('anggota_id');
        // $kasHarian->nama_transaksi = $request->input('nama_transaksi');
        // $kasHarian->jenis_transaksi = $request->input('jenis_transaksi');
        // $kasHarian->tanggal = $tanggal;
        // $kasHarian->jumlah = $jumlah;
        // $kasHarian->keterangan = $request->input('keterangan');

        // $kasHarian->save();

    }

    public function destroy($id)
    {
        $kasHarian = KasHarian::findOrFail($id);

        $kasHarian->delete();

        return redirect()->route('admin.kas-harian.index')->with('success', 'Berhasil Menghapus Kas Harian');
    }

    public function filterKasHarian(Request $request)
    {
        $query = KasHarian::query();

        if ($request->filled('year')) {
            $query->whereYear('tanggal', $request->year);
        }

        if ($request->filled('month')) {
            $query->whereMonth('tanggal', $request->month);
        }

        $kasHarian = $query->get();

        return response()->json($kasHarian); // Kirim data JSON ke JavaScript
    }
}
