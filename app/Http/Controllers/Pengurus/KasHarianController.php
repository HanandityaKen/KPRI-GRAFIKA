<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasHarian;
use App\Models\Jkm;
use App\Models\Jkk;
use App\Models\Simpanan;
use App\Models\Saldo;
use App\Models\Anggota;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use App\Models\Angsuran;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KasHarianController extends Controller
{
    public function index()
    {
        return view('pengurus.kas-harian.index-kas-harian');
    }

    public function create()
    {
        $namaList = Anggota::pluck('nama', 'id');

        return view('pengurus.kas-harian.create-kas-harian', compact('namaList'));
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

        if ($request->jenis_transaksi === 'kas masuk') {
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

            Jkm::create([
                'kas_harian_id' => $kasHarian->id,
                'bulan'         => $bulan,
                'tahun'         => $tahun,
                'keterangan'    => $request->keterangan,
            ]);

            $simpanan = Simpanan::updateOrCreate(
                ['anggota_id' => $request->anggota_id],
                [
                    'kas_harian_id' => $kasHarian->id,
                    'pokok'         => DB::raw("pokok + $pokok"),
                    'wajib'         => DB::raw("wajib + $wajib"),
                    'manasuka'      => DB::raw("manasuka + $manasuka"),
                    'wajib_pinjam'  => DB::raw("wajib_pinjam + $wajib_pinjam"),
                    'qurban'        => DB::raw("qurban + $qurban"),
                    'total'         => DB::raw("total + ($pokok + $wajib + $manasuka + $wajib_pinjam + $qurban)"),
                ]
            );

            if ($angsuran > 0 || $jasa > 0) {
                $pengajuanPinjaman = PengajuanPinjaman::where('anggota_id', $request->anggota_id)
                    ->where('status', 'disetujui')
                    ->latest()
                    ->first();
            
                if ($pengajuanPinjaman) {
                    $pinjaman = Pinjaman::where('pengajuan_pinjaman_id', $pengajuanPinjaman->id)
                        ->latest()
                        ->first();
            
                    if ($pinjaman) {
                        $angsuranData = Angsuran::where('pinjaman_id', $pinjaman->id)
                            ->latest()
                            ->first();
            
                        if ($angsuranData) {
                            $angsuranData->update([
                                'kurang_angsuran' => DB::raw("kurang_angsuran - $angsuran"),
                                'kurang_jasa'     => DB::raw("kurang_jasa - $jasa"),
                            ]);
                        }
                    }
                }
            }

            $saldoMasuk = $pokok + $wajib + $manasuka + $wajib_pinjam + $qurban + $angsuran + $jasa + $js_admin + $lain_lain + $barang_kons;

            $saldo = Saldo::first();

            if (!$saldo) {
                Saldo::create(['saldo' => $saldoMasuk]);
            } else {
                $saldo->update(['saldo' => DB::raw("saldo + $saldoMasuk")]);
            }
        }
        
        if ($request->jenis_transaksi === 'kas keluar') {

            $simpanan = Simpanan::where('anggota_id', $request->anggota_id)->first();

            if ($simpanan) {
                if ($simpanan->pokok < $pokok) {
                    return back()->withErrors(['error' => 'Saldo pokok tidak cukup untuk melakukan transaksi ini!']);
                }
                if ($simpanan->wajib < $wajib) {
                    return back()->withErrors(['error' => 'Saldo wajib tidak cukup untuk melakukan transaksi ini!']);
                }
                if ($simpanan->manasuka < $manasuka) {
                    return back()->withErrors(['error' => 'Saldo manasuka tidak cukup untuk melakukan transaksi ini!']);
                }
                if ($simpanan->wajib_pinjam < $wajib_pinjam) {
                    return back()->withErrors(['error' => 'Saldo wajib pinjam tidak cukup untuk melakukan transaksi ini!']);
                }
                if ($simpanan->qurban < $qurban) {
                    return back()->withErrors(['error' => 'Saldo qurban tidak cukup untuk melakukan transaksi ini!']);
                }
            } 

            $saldoKeluar = $pokok + $wajib + $manasuka + $wajib_pinjam + $qurban + $angsuran + $jasa + $js_admin + $lain_lain + $barang_kons + $piutang + $hutang + $b_umum + $b_orgns + $b_oprs + $b_lain + $tnh_kav;
    
            $saldo = Saldo::first();
    
            if (!$saldo || $saldo->saldo < 0 || ($saldo->saldo - $saldoKeluar < 0)) {
                return back()->withErrors(['error' => 'Saldo koperasi tidak cukup!']);
            }
            
            $saldo->update(['saldo' => DB::raw("saldo - $saldoKeluar")]);

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

            Jkk::create([
                'kas_harian_id' => $kasHarian->id,
                'bulan'         => $bulan,
                'tahun'         => $tahun,
                'keterangan'    => $request->keterangan,
            ]);

            $simpanan = Simpanan::where('anggota_id', $request->anggota_id)->first();

            if ($simpanan) {
                $simpanan->update([
                    'pokok'         => DB::raw("GREATEST(0, pokok - $pokok)"),
                    'wajib'         => DB::raw("GREATEST(0, wajib - $wajib)"),
                    'manasuka'      => DB::raw("GREATEST(0, manasuka - $manasuka)"),
                    'wajib_pinjam'  => DB::raw("GREATEST(0, wajib_pinjam - $wajib_pinjam)"),
                    'qurban'        => DB::raw("GREATEST(0, qurban - $qurban)"),
                    'total'         => DB::raw("GREATEST(0, total - ($pokok + $wajib + $manasuka + $wajib_pinjam + $qurban))"),
                ]);
            }
        }

        return redirect()->route('pengurus.kas-harian.index')->with('success', 'Berhasil Menambahkan Kas Harian');
    }

    public function edit(string $id)
    {
        $kasHarian = KasHarian::findOrFail($id);

        $namaList = Anggota::pluck('nama', 'id');

        return view('pengurus.kas-harian.edit-kas-harian', compact('kasHarian', 'namaList'));
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

        $pokok = intval(str_replace(['Rp', '.', ' '], '', $request->pokok ?? '0'));
        $wajib = intval(str_replace(['Rp', '.', ' '], '', $request->wajib ?? '0'));
        $manasuka = intval(str_replace(['Rp', '.', ' '], '', $request->manasuka ?? '0'));
        $wajib_pinjam = intval(str_replace(['Rp', '.', ' '], '', $request->wajib_pinjam ?? '0'));
        $qurban = intval(str_replace(['Rp', '.', ' '], '', $request->qurban ?? '0'));
        $angsuran = intval(str_replace(['Rp', '.', ' '], '', $request->angsuran ?? '0'));
        $jasa = intval(str_replace(['Rp', '.', ' '], '', $request->jasa ?? '0'));
        $js_admin = intval(str_replace(['Rp', '.', ' '], '', $request->js_admin ?? '0'));
        $lain_lain = intval(str_replace(['Rp', '.', ' '], '', $request->lain_lain ?? '0'));
        $barang_kons = intval(str_replace(['Rp', '.', ' '], '', $request->barang_kons ?? '0'));
        $piutang = intval(str_replace(['Rp', '.', ' '], '', $request->piutang ?? '0'));
        $hutang = intval(str_replace(['Rp', '.', ' '], '', $request->hutang ?? '0'));
        $b_umum = intval(str_replace(['Rp', '.', ' '], '', $request->b_umum ?? '0'));
        $b_orgns = intval(str_replace(['Rp', '.', ' '], '', $request->b_orgns ?? '0'));
        $b_oprs = intval(str_replace(['Rp', '.', ' '], '', $request->b_oprs ?? '0'));
        $b_lain = intval(str_replace(['Rp', '.', ' '], '', $request->b_lain ?? '0'));
        $tnh_kav = intval(str_replace(['Rp', '.', ' '], '', $request->tnh_kav ?? '0'));

        $kasHarian = KasHarian::findOrFail($id);

        $totalSebelumUpdate = $kasHarian->pokok + $kasHarian->wajib + $kasHarian->manasuka + 
                        $kasHarian->wajib_pinjam + $kasHarian->qurban + 
                        $kasHarian->angsuran + $kasHarian->jasa + $kasHarian->js_admin + 
                        $kasHarian->lain_lain + $kasHarian->barang_kons;


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

            // Ambil semua kas harian milik anggota ini
            $kasHarianAnggota = KasHarian::where('anggota_id', $request->anggota_id)->get();

            // Hitung total masing-masing kategori dari semua kas harian
            $totalPokok        = $kasHarianAnggota->sum('pokok');
            $totalWajib        = $kasHarianAnggota->sum('wajib');
            $totalManasuka     = $kasHarianAnggota->sum('manasuka');
            $totalWajibPinjam  = $kasHarianAnggota->sum('wajib_pinjam');
            $totalQurban       = $kasHarianAnggota->sum('qurban');

            // Hitung total keseluruhan simpanan
            $totalSimpanan = $totalPokok + $totalWajib + $totalManasuka + $totalWajibPinjam + $totalQurban;

            // Update atau buat simpanan untuk anggota ini
            Simpanan::updateOrCreate(
                ['anggota_id' => $request->anggota_id], // Pastikan hanya satu entri per anggota_id
                [
                    'pokok'         => $totalPokok,
                    'wajib'         => $totalWajib,
                    'manasuka'      => $totalManasuka,
                    'wajib_pinjam'  => $totalWajibPinjam,
                    'qurban'        => $totalQurban,
                    'total'         => $totalSimpanan,
                ]
            );

            $totalSesudahUpdate = $pokok + $wajib + $manasuka + $wajib_pinjam + $qurban + 
                                $angsuran + $jasa + $js_admin + $lain_lain + $barang_kons;

            $selisihSaldo = $totalSesudahUpdate - $totalSebelumUpdate;

            $saldo = Saldo::first();
            $saldo->update(['saldo' => $saldo->saldo + $selisihSaldo]);

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

                $kasHarianAnggotaMasuk = KasHarian::where('anggota_id', $request->anggota_id)
                    ->where('jenis_transaksi', 'kas masuk')
                    ->get();

                $kasHarianAnggotaKeluar = KasHarian::where('anggota_id', $request->anggota_id)
                    ->where('jenis_transaksi', 'kas keluar')
                    ->get();

                $totalPokokMasuk = $kasHarianAnggotaMasuk->sum('pokok');
                $totalWajibMasuk = $kasHarianAnggotaMasuk->sum('wajib');
                $totalManasukaMasuk = $kasHarianAnggotaMasuk->sum('manasuka');
                $totalWajibPinjamMasuk = $kasHarianAnggotaMasuk->sum('wajib_pinjam');
                $totalQurbanMasuk = $kasHarianAnggotaMasuk->sum('qurban');
            
                $totalPokokKeluar = $kasHarianAnggotaKeluar->sum('pokok');
                $totalWajibKeluar = $kasHarianAnggotaKeluar->sum('wajib');
                $totalManasukaKeluar = $kasHarianAnggotaKeluar->sum('manasuka');
                $totalWajibPinjamKeluar = $kasHarianAnggotaKeluar->sum('wajib_pinjam');
                $totalQurbanKeluar = $kasHarianAnggotaKeluar->sum('qurban');

                $totalPokok = max(0, $totalPokokMasuk - $totalPokokKeluar);
                $totalWajib = max(0, $totalWajibMasuk - $totalWajibKeluar);
                $totalManasuka = max(0, $totalManasukaMasuk - $totalManasukaKeluar);
                $totalWajibPinjam = max(0, $totalWajibPinjamMasuk - $totalWajibPinjamKeluar);
                $totalQurban = max(0, $totalQurbanMasuk - $totalQurbanKeluar);

                $totalSimpanan = $totalPokok + $totalWajib + $totalManasuka + $totalWajibPinjam + $totalQurban;
                Simpanan::updateOrCreate(
                    ['anggota_id' => $request->anggota_id],
                    [
                        'pokok'         => $totalPokok,
                        'wajib'         => $totalWajib,
                        'manasuka'      => $totalManasuka,
                        'wajib_pinjam'  => $totalWajibPinjam,
                        'qurban'        => $totalQurban,
                        'total'         => $totalSimpanan,
                    ]
                );

                $totalSesudahUpdate = $pokok + $wajib + $manasuka + $wajib_pinjam + $qurban + 
                                    $angsuran + $jasa + $js_admin + $lain_lain + $barang_kons;

                $selisihSaldo = $totalSesudahUpdate - $totalSebelumUpdate;

                $saldo = Saldo::first();
                $saldo->update(['saldo' => $saldo->saldo - $selisihSaldo]);
        }

        return redirect()->route('pengurus.kas-harian.index')->with('success', 'Berhasil Mengubah Kas Harian');
    }

    public function destroy($id)
    {
        $kasHarian = KasHarian::findOrFail($id);

        if ($kasHarian->jenis_transaksi === 'kas masuk') {

            $kasHarianAnggota = KasHarian::where('anggota_id', $kasHarian->anggota_id)
                ->where('jenis_transaksi', 'kas masuk')
                ->get();

            $totalPokok       = max(0, $kasHarianAnggota->sum('pokok') - $kasHarian->pokok);
            $totalWajib       = max(0, $kasHarianAnggota->sum('wajib') - $kasHarian->wajib);
            $totalManasuka    = max(0, $kasHarianAnggota->sum('manasuka') - $kasHarian->manasuka);
            $totalWajibPinjam = max(0, $kasHarianAnggota->sum('wajib_pinjam') - $kasHarian->wajib_pinjam);
            $totalQurban      = max(0, $kasHarianAnggota->sum('qurban') - $kasHarian->qurban);
        }
        elseif ($kasHarian->jenis_transaksi === 'kas keluar') {

            // Ambil total terakhir dari tabel Simpanan sebelum perubahan
            $simpanan = Simpanan::where('anggota_id', $kasHarian->anggota_id)->first();

            $totalPokok       = $simpanan->pokok + $kasHarian->pokok;
            $totalWajib       = $simpanan->wajib + $kasHarian->wajib;
            $totalManasuka    = $simpanan->manasuka + $kasHarian->manasuka;
            $totalWajibPinjam = $simpanan->wajib_pinjam + $kasHarian->wajib_pinjam;
            $totalQurban      = $simpanan->qurban + $kasHarian->qurban;
        }

        // Hitung ulang total simpanan
        $totalSimpanan = $totalPokok + $totalWajib + $totalManasuka + $totalWajibPinjam + $totalQurban;

        // Update simpanan setelah perhitungan ulang
        Simpanan::updateOrCreate(
            ['anggota_id' => $kasHarian->anggota_id],
            [
                'pokok'        => $totalPokok,
                'wajib'        => $totalWajib,
                'manasuka'     => $totalManasuka,
                'wajib_pinjam' => $totalWajibPinjam,
                'qurban'       => $totalQurban,
                'total'        => $totalSimpanan,
            ]
        );


        $kasHarian->delete();

        return redirect()->route('pengurus.kas-harian.index')->with('success', 'Berhasil Menghapus Kas Harian');
    }

}
