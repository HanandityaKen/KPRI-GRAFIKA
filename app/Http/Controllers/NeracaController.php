<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PerhitunganNeraca;
use App\Models\NeracaAwalD;
use App\Models\NeracaAwalK;
use App\Models\NPerubahanD;
use App\Models\NPerubahanK;
use App\Models\APenyesuaianD;
use App\Models\APenyesuaianK;
use App\Models\RugiDanLabaD;
use App\Models\RugiDanLabaK;
use App\Models\Neraca;

class NeracaController extends Controller
{
    public function indexPerhitunganNeraca() 
    {
        return view('admin.neraca.index-perhitungan-neraca');
    }

    public function createPerhitunganNeraca() 
    {
        return view('admin.neraca.create-perhitungan-neraca');
    }

    public function storePerhitunganNeraca(Request $request)
    {
        $data = $request->all();

        // clean format rupiah
        foreach ($data as $key => $value) {
            if (
                Str::startsWith($key, 'neraca_awal_d_') ||
                Str::startsWith($key, 'neraca_awal_k_') ||
                Str::startsWith($key, 'n_perubahan_d_') ||
                Str::startsWith($key, 'n_perubahan_k_') ||
                Str::startsWith($key, 'a_penyesuaian_d_') ||
                Str::startsWith($key, 'a_penyesuaian_k_') ||
                Str::startsWith($key, 'rugi_dan_laba_d_') ||
                Str::startsWith($key, 'rugi_dan_laba_k_')
            ) {
                $data[$key] = (int) str_replace(['Rp', '.', ','], '', $value);
            }
        }

        // validasi tahun
        $rules = [
            'tahun' => 'required|digits:4|integer|min:2024',
        ];
    
        // validasi semua input
        foreach ($data as $key => $value) {
            if (
                Str::startsWith($key, 'neraca_awal_d_') ||
                Str::startsWith($key, 'neraca_awal_k_') ||
                Str::startsWith($key, 'n_perubahan_d_') ||
                Str::startsWith($key, 'n_perubahan_k_') ||
                Str::startsWith($key, 'a_penyesuaian_d_') ||
                Str::startsWith($key, 'a_penyesuaian_k_') ||
                Str::startsWith($key, 'rugi_dan_laba_d_') ||
                Str::startsWith($key, 'rugi_dan_laba_k_')
            ) {
                $rules[$key] = 'required|integer|min:0';
            }
        }
    
        // validasi setelah input dibersihkan
        $validated = validator($data, $rules)->validate();

        $cleanNeracaAwalD     = [];
        $cleanNeracaAwalK     = [];
        $cleanNPerubahanD     = [];
        $cleanNPerubahanK     = [];
        $cleanAPenyesuaianD  = [];
        $cleanAPenyesuaianK  = [];
        $cleanRugiDanLabaD    = [];
        $cleanRugiDanLabaK    = [];
    
        foreach ($validated as $key => $value) {
            if ($key === 'tahun') {
                continue;
            }
    
            $val = (int) $value;
    
            if (Str::startsWith($key, 'neraca_awal_d_')) {
                $cleanNeracaAwalD[$key] = $val;
            } elseif (Str::startsWith($key, 'neraca_awal_k_')) {
                $cleanNeracaAwalK[$key] = $val;
            } elseif (Str::startsWith($key, 'n_perubahan_d_')) {
                $cleanNPerubahanD[$key] = $val;
            } elseif (Str::startsWith($key, 'n_perubahan_k_')) {
                $cleanNPerubahanK[$key] = $val;
            } elseif (Str::startsWith($key, 'a_penyesuaian_d_')) {
                $cleanAPenyesuaianD[$key] = $val;
            } elseif (Str::startsWith($key, 'a_penyesuaian_k_')) {
                $cleanAPenyesuaianK[$key] = $val;
            } elseif (Str::startsWith($key, 'rugi_dan_laba_d_')) {
                $cleanRugiDanLabaD[$key] = $val;
            } elseif (Str::startsWith($key, 'rugi_dan_laba_k_')) {
                $cleanRugiDanLabaK[$key] = $val;
            }
        }

        // Simpan tahun ke tabel perhitungan neraca
        $perhitunganNeraca = PerhitunganNeraca::create([
            'tahun' => $validated['tahun'],
            'jumlah_neraca_awal_d' => array_sum($cleanNeracaAwalD),
            'jumlah_neraca_awal_k' => array_sum($cleanNeracaAwalK),
            'jumlah_n_perubahan_d' => array_sum($cleanNPerubahanD),
            'jumlah_n_perubahan_k' => array_sum($cleanNPerubahanK),
            'jumlah_a_penyesuaian_d' => array_sum($cleanAPenyesuaianD),
            'jumlah_a_penyesuaian_k' => array_sum($cleanAPenyesuaianK),
            'jumlah_rugi_dan_laba_d' => array_sum($cleanRugiDanLabaD),
            'jumlah_rugi_dan_laba_k' => array_sum($cleanRugiDanLabaK),

            // ambil langsung dari name
            // 'jumlah_neraca_awal_d' =>  $cleanNeracaAwalD['neraca_awal_d'] ?? 0,
            // 'jumlah_neraca_awal_k' =>  $cleanNeracaAwalK['neraca_awal_k'] ?? 0,
            // 'jumlah_n_perubahan_d' =>  $cleanNPerubahanD['n_perubahan_d'] ?? 0,
            // 'jumlah_n_perubahan_k' =>  $cleanNPerubahanK['n_perubahan_k'] ?? 0,
            // 'jumlah_a_penyesuaian_d' =>  $cleanAPenyesuaianD['a_penyesuaian_d'] ?? 0,
            // 'jumlah_a_penyesuaian_k' =>  $cleanAPenyesuaianK['a_penyesuaian_k'] ?? 0,
            // 'jumlah_rugi_dan_laba_d' =>  $cleanRugiDanLabaD['rugi_dan_laba_d'] ?? 0,
            // 'jumlah_rugi_dan_laba_k' =>  $cleanRugiDanLabaK['rugi_dan_laba_k'] ?? 0,
        ]);

        // Simpan neraca_awal_d ke tabel neraca_awal_d
        NeracaAwalD::create(array_merge(
            ['perhitungan_neraca_id' => $perhitunganNeraca->id],
            $cleanNeracaAwalD,
            ['jumlah' => array_sum($cleanNeracaAwalD)]
        ));

        // Simpan neraca_awal_k ke tabel neraca_awal_k
        NeracaAwalK::create(array_merge(
            ['perhitungan_neraca_id' => $perhitunganNeraca->id],
            $cleanNeracaAwalK,
            ['jumlah' => array_sum($cleanNeracaAwalK)]
        ));

        // Simpan n_perubahan_d ke tabel n_perubahan_d
        NPerubahanD::create(array_merge(
            ['perhitungan_neraca_id' => $perhitunganNeraca->id],
            $cleanNPerubahanD,
            ['jumlah' => array_sum($cleanNPerubahanD)]
        ));

        // Simpan n_perubahan_k ke tabel n_perubahan_k
        NPerubahanK::create(array_merge(
            ['perhitungan_neraca_id' => $perhitunganNeraca->id],
            $cleanNPerubahanK,
            ['jumlah' => array_sum($cleanNPerubahanK)]
        ));

        // Simpan a_penyesuaian_d ke tabel a_penyesuaian_d
        APenyesuaianD::create(array_merge(
            ['perhitungan_neraca_id' => $perhitunganNeraca->id],
            $cleanAPenyesuaianD,
            ['jumlah' => array_sum($cleanAPenyesuaianD)]
        ));
        
        // Simpan a_penyesuaian_k ke tabel a_penyesuaian_k
        APenyesuaianK::create(array_merge(
            ['perhitungan_neraca_id' => $perhitunganNeraca->id],
            $cleanAPenyesuaianK,
            ['jumlah' => array_sum($cleanAPenyesuaianK)]
        ));

        // Simpan rugi_dan_laba_d ke tabel rugi_dan_laba_d
        RugiDanLabaD::create(array_merge(
            ['perhitungan_neraca_id' => $perhitunganNeraca->id],
            $cleanRugiDanLabaD,
            ['jumlah' => array_sum($cleanRugiDanLabaD)]
        ));

        // Simpan rugi_dan_laba_k ke tabel rugi_dan_laba_k
        RugiDanLabaK::create(array_merge(
            ['perhitungan_neraca_id' => $perhitunganNeraca->id],
            $cleanRugiDanLabaK,
            ['jumlah' => array_sum($cleanRugiDanLabaK)]
        ));

        // Hitung Neraca
        $fields = [
            'kas', 'bank', 'piutang', 'piutang_tanah', 'piutang_lain_pada_anggota',
            'penyisihan_piutang', 'piutang_barang', 'persediaan_barang',
            'persediaan_peralatan', 'akumulasi_peny_peralatan', 'pendapatan_ymh_diterima',
            'simpanan_manasuka_pkpri', 'tabungan_di_pkpri', 'simpanan_pokok_pkpri',
            'simpanan_wajib_pkpri', 'simp_khusus_pkpri', 'simp_khusus_swp',
            'skpb', 'penyertaan_di_hotel_pkpri', 'penyertaan_di_kopen',
            'penyertaan_unit_konsumsi', 'tanah', 'kewajiban_titipan',
            'biaya_yang_masih_harus_dibayar', 'jasa_partisipasi', 'dana_pengurus',
            'dana_karyawan', 'dana_pendidikan', 'dana_sosial', 'utang_ke_pkpri_atau_bni',
            'tabungan_qurban', 'simpanan_khusus_swp', 'simpanan_manasuka',
            'donasi', 'simpanan_pokok_anggota', 'simpanan_wajib_anggota',
            'cadangan', 'shu', 'jasa_dari_anggota', 'jasa_administrasi',
            'pembelian', 'penjualan', 'hpp_penjualan', 'beban_organisasi','beban_operasional',
            'beban_umum', 'beban_lain_lain', 'jasa_unit_konsumsi',
            'pendapatan_lain_lain', 'pendapatan_tanah_kavling',
            'piutang_khusus', 'beban_pajak_belum_dibayar', 'pajak',
            'jasa_simp_mana_suka',
        ];

        $hasilNeraca = [];

        foreach ($fields as $field) {
            $nPercobaanD = ($cleanNeracaAwalD["neraca_awal_d_$field"] ?? 0)
                        + ($cleanNPerubahanD["n_perubahan_d_$field"] ?? 0);
        
            $nPercobaanK = ($cleanNeracaAwalK["neraca_awal_k_$field"] ?? 0)
                        + ($cleanNPerubahanK["n_perubahan_k_$field"] ?? 0);
        
            $selisih = $nPercobaanD - $nPercobaanK;
        
            if ($selisih > 0) {
                $nSaldoD = $selisih;
                $nSaldoK = 0;
            } else {
                $nSaldoD = 0;
                $nSaldoK = abs($selisih);
            }
        
            $nsDisesuaikanD = $nSaldoD
                            + ($cleanAPenyesuaianD["a_penyesuaian_d_$field"] ?? 0)
                            - $nSaldoK
                            - ($cleanAPenyesuaianK["a_penyesuaian_k_$field"] ?? 0);
        
            $nsDisesuaikanK = $nSaldoK
                            + ($cleanAPenyesuaianK["a_penyesuaian_k_$field"] ?? 0)
                            - $nSaldoD
                            - ($cleanAPenyesuaianD["a_penyesuaian_d_$field"] ?? 0);
        
            $neracaD = $nsDisesuaikanD + ($cleanRugiDanLabaD["rugi_dan_laba_d_$field"] ?? 0);
            $neracaK = $nsDisesuaikanK + ($cleanRugiDanLabaK["rugi_dan_laba_k_$field"] ?? 0);
        
            // ambil sisi yang ada nilainya
            if ($neracaD > 0) {
                $hasilNeraca[$field] = $neracaD;
            } elseif ($neracaK > 0) {
                $hasilNeraca[$field] = $neracaK;
            } else {
                $hasilNeraca[$field] = 0;
            }
        }
        
        Neraca::create(array_merge(
            ['tahun' => $validated['tahun']],
            $hasilNeraca
        ));

        return redirect()->route('admin.neraca.index-perhitungan-neraca')->with('success', 'Data Perhitungan Neraca Berhasil Disimpan.');
    }

    public function editPerhitunganNeraca(string $id)
    {
        $perhitunganNeraca = PerhitunganNeraca::findOrFail($id);

        return view('admin.neraca.edit-perhitungan-neraca', compact('perhitunganNeraca'));
    }

    public function updatePerhitunganNeraca(Request $request, string $id)
    {
        $perhitunganNeraca = PerhitunganNeraca::findOrFail($id);

        $data = $request->all();

        // clean format rupiah
        foreach ($data as $key => $value) {
            if (
                Str::startsWith($key, 'neraca_awal_d_') ||
                Str::startsWith($key, 'neraca_awal_k_') ||
                Str::startsWith($key, 'n_perubahan_d_') ||
                Str::startsWith($key, 'n_perubahan_k_') ||
                Str::startsWith($key, 'a_penyesuaian_d_') ||
                Str::startsWith($key, 'a_penyesuaian_k_') ||
                Str::startsWith($key, 'rugi_dan_laba_d_') ||
                Str::startsWith($key, 'rugi_dan_laba_k_')
            ) {
                $data[$key] = (int) str_replace(['Rp', '.', ','], '', $value);
            }
        }

        // validasi semua input
        $rules = [
            'tahun' => 'required|digits:4|integer|min:2024'
        ];
        foreach ($data as $key => $value) {
            if (
                Str::startsWith($key, 'neraca_awal_d_') ||
                Str::startsWith($key, 'neraca_awal_k_') ||
                Str::startsWith($key, 'n_perubahan_d_') ||
                Str::startsWith($key, 'n_perubahan_k_') ||
                Str::startsWith($key, 'a_penyesuaian_d_') ||
                Str::startsWith($key, 'a_penyesuaian_k_') ||
                Str::startsWith($key, 'rugi_dan_laba_d_') ||
                Str::startsWith($key, 'rugi_dan_laba_k_')
            ) {
                $rules[$key] = 'required|integer|min:0';
            }
        }

        // validasi setelah input dibersihkan
        $validated = validator($data, $rules)->validate();

        $cleanNeracaAwalD     = [];
        $cleanNeracaAwalK     = [];
        $cleanNPerubahanD     = [];
        $cleanNPerubahanK     = [];
        $cleanAPenyesuaianD  = [];
        $cleanAPenyesuaianK  = [];
        $cleanRugiDanLabaD    = [];
        $cleanRugiDanLabaK    = [];

        foreach ($validated as $key => $value) {
            $val = (int) $value;

            if (Str::startsWith($key, 'neraca_awal_d_')) {
                $cleanNeracaAwalD[$key] = $val;
            } elseif (Str::startsWith($key, 'neraca_awal_k_')) {
                $cleanNeracaAwalK[$key] = $val;
            } elseif (Str::startsWith($key, 'n_perubahan_d_')) {
                $cleanNPerubahanD[$key] = $val;
            } elseif (Str::startsWith($key, 'n_perubahan_k_')) {
                $cleanNPerubahanK[$key] = $val;
            } elseif (Str::startsWith($key, 'a_penyesuaian_d_')) {
                $cleanAPenyesuaianD[$key] = $val;
            } elseif (Str::startsWith($key, 'a_penyesuaian_k_')) {
                $cleanAPenyesuaianK[$key] = $val;
            } elseif (Str::startsWith($key, 'rugi_dan_laba_d_')) {
                $cleanRugiDanLabaD[$key] = $val;
            } elseif (Str::startsWith($key, 'rugi_dan_laba_k_')) {
                $cleanRugiDanLabaK[$key] = $val;
            }
        }
        // Update tabel perhitungan_neraca
        $perhitunganNeraca->update([
            'jumlah_neraca_awal_d' => array_sum($cleanNeracaAwalD),
            'jumlah_neraca_awal_k' => array_sum($cleanNeracaAwalK),
            'jumlah_n_perubahan_d' => array_sum($cleanNPerubahanD),
            'jumlah_n_perubahan_k' => array_sum($cleanNPerubahanK),
            'jumlah_a_penyesuaian_d' => array_sum($cleanAPenyesuaianD),
            'jumlah_a_penyesuaian_k' => array_sum($cleanAPenyesuaianK),
            'jumlah_rugi_dan_laba_d' => array_sum($cleanRugiDanLabaD),
            'jumlah_rugi_dan_laba_k' => array_sum($cleanRugiDanLabaK),
        ]);

        // Update tabel neraca_awal_d
        $perhitunganNeraca->neracaAwalD->update([
            ...$cleanNeracaAwalD,
            'jumlah' => array_sum($cleanNeracaAwalD),
        ]);
        
        // update neraca_awal_k
        $perhitunganNeraca->neracaAwalK->update([
            ...$cleanNeracaAwalK,
            'jumlah' => array_sum($cleanNeracaAwalK),
        ]);
        
        // update n_perubahan_d
        $perhitunganNeraca->nPerubahanD->update([
            ...$cleanNPerubahanD,
            'jumlah' => array_sum($cleanNPerubahanD),
        ]);
        
        // update n_perubahan_k
        $perhitunganNeraca->nPerubahanK->update([
            ...$cleanNPerubahanK,
            'jumlah' => array_sum($cleanNPerubahanK),
        ]);

        // update a_penyesuaian_d
        $perhitunganNeraca->aPenyesuaianD->update([
            ...$cleanAPenyesuaianD,
            'jumlah' => array_sum($cleanAPenyesuaianD),
        ]);

        // update a_penyesuaian_k
        $perhitunganNeraca->aPenyesuaianK->update([
            ...$cleanAPenyesuaianK,
            'jumlah' => array_sum($cleanAPenyesuaianK),
        ]);
        
        // update rugi_dan_laba_d
        $perhitunganNeraca->rugiDanLabaD->update([
            ...$cleanRugiDanLabaD,
            'jumlah' => array_sum($cleanRugiDanLabaD),
        ]);
        
        // update rugi_dan_laba_k
        $perhitunganNeraca->rugiDanLabaK->update([
            ...$cleanRugiDanLabaK,
            'jumlah' => array_sum($cleanRugiDanLabaK),
        ]);

        // Hitung Neraca
        $fields = [
            'kas', 'bank', 'piutang', 'piutang_tanah', 'piutang_lain_pada_anggota',
            'penyisihan_piutang', 'piutang_barang', 'persediaan_barang',
            'persediaan_peralatan', 'akumulasi_peny_peralatan', 'pendapatan_ymh_diterima',
            'simpanan_manasuka_pkpri', 'tabungan_di_pkpri', 'simpanan_pokok_pkpri',
            'simpanan_wajib_pkpri', 'simp_khusus_pkpri', 'simp_khusus_swp',
            'skpb', 'penyertaan_di_hotel_pkpri', 'penyertaan_di_kopen',
            'penyertaan_unit_konsumsi', 'tanah', 'kewajiban_titipan',
            'biaya_yang_masih_harus_dibayar', 'jasa_partisipasi', 'dana_pengurus',
            'dana_karyawan', 'dana_pendidikan', 'dana_sosial', 'utang_ke_pkpri_atau_bni',
            'tabungan_qurban', 'simpanan_khusus_swp', 'simpanan_manasuka',
            'donasi', 'simpanan_pokok_anggota', 'simpanan_wajib_anggota',
            'cadangan', 'shu', 'jasa_dari_anggota', 'jasa_administrasi',
            'pembelian', 'penjualan', 'hpp_penjualan', 'beban_organisasi','beban_operasional',
            'beban_umum', 'beban_lain_lain', 'jasa_unit_konsumsi',
            'pendapatan_lain_lain', 'pendapatan_tanah_kavling',
            'piutang_khusus', 'beban_pajak_belum_dibayar', 'pajak',
            'jasa_simp_mana_suka',
        ];

        $hasilNeraca = [];

        foreach ($fields as $field) {
            $nPercobaanD = ($cleanNeracaAwalD["neraca_awal_d_$field"] ?? 0)
                        + ($cleanNPerubahanD["n_perubahan_d_$field"] ?? 0);
        
            $nPercobaanK = ($cleanNeracaAwalK["neraca_awal_k_$field"] ?? 0)
                        + ($cleanNPerubahanK["n_perubahan_k_$field"] ?? 0);
        
            $selisih = $nPercobaanD - $nPercobaanK;
        
            if ($selisih > 0) {
                $nSaldoD = $selisih;
                $nSaldoK = 0;
            } else {
                $nSaldoD = 0;
                $nSaldoK = abs($selisih);
            }
        
            $nsDisesuaikanD = $nSaldoD
                            + ($cleanAPenyesuaianD["a_penyesuaian_d_$field"] ?? 0)
                            - $nSaldoK
                            - ($cleanAPenyesuaianK["a_penyesuaian_k_$field"] ?? 0);
        
            $nsDisesuaikanK = $nSaldoK
                            + ($cleanAPenyesuaianK["a_penyesuaian_k_$field"] ?? 0)
                            - $nSaldoD
                            - ($cleanAPenyesuaianD["a_penyesuaian_d_$field"] ?? 0);
        
            $neracaD = $nsDisesuaikanD + ($cleanRugiDanLabaD["rugi_dan_laba_d_$field"] ?? 0);
            $neracaK = $nsDisesuaikanK + ($cleanRugiDanLabaK["rugi_dan_laba_k_$field"] ?? 0);
        
            // ambil sisi yang ada nilainya
            if ($neracaD > 0) {
                $hasilNeraca[$field] = $neracaD;
            } elseif ($neracaK > 0) {
                $hasilNeraca[$field] = $neracaK;
            } else {
                $hasilNeraca[$field] = 0;
            }
        }

        // update atau create di tabel neraca
        $tahun = $validated['tahun'];

        $neraca = Neraca::where('tahun', $tahun)->first();

        if ($neraca) {
            $neraca->update(array_merge(['tahun' => $tahun], $hasilNeraca));
        } else {
            Neraca::create(array_merge(['tahun' => $tahun], $hasilNeraca));
        }

        return redirect()->route('admin.neraca.index-perhitungan-neraca')->with('success', 'Data Perhitungan Neraca Berhasil Diperbarui.');
    }

    public function destroyPerhitunganNeraca($id)
    {
        $perhitunganNeraca = PerhitunganNeraca::findOrFail($id);

        // Hapus data terkait di tabel lain
        $perhitunganNeraca->neracaAwalD()->delete();
        $perhitunganNeraca->neracaAwalK()->delete();
        $perhitunganNeraca->nPerubahanD()->delete();
        $perhitunganNeraca->nPerubahanK()->delete();
        $perhitunganNeraca->aPenyesuaianD()->delete();
        $perhitunganNeraca->aPenyesuaianK()->delete();
        $perhitunganNeraca->rugiDanLabaD()->delete();
        $perhitunganNeraca->rugiDanLabaK()->delete();

        Neraca::where('tahun', $perhitunganNeraca->tahun)->delete();

        // Hapus data di tabel perhitungan_neraca
        $perhitunganNeraca->delete();

        return redirect()->route('admin.neraca.index-perhitungan-neraca')->with('success', 'Data Perhitungan Neraca Berhasil Dihapus.');
    }

    //Tabel Neraca
    public function indexTabelNeraca() 
    {
        return view('admin.neraca.index-tabel-neraca');
    }
    
    // Perbandingan Neraca
    public function indexPerbandinganNeraca()
    {
        return view('admin.neraca.index-perbandingan-neraca');
        
    }
}
