<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class APenyesuaianD extends Model
{
    protected $table = 'a_penyesuaian_d';

    protected $fillable = [
        'perhitungan_neraca_id',
        'a_penyesuaian_d_kas',
        'a_penyesuaian_d_bank',
        'a_penyesuaian_d_piutang',
        'a_penyesuaian_d_piutang_tanah',
        'a_penyesuaian_d_piutang_lain_pada_anggota',
        'a_penyesuaian_d_penyisihan_piutang',
        'a_penyesuaian_d_piutang_barang',
        'a_penyesuaian_d_persediaan_barang',
        'a_penyesuaian_d_persediaan_peralatan',
        'a_penyesuaian_d_akumulasi_peny_peralatan',
        'a_penyesuaian_d_pendapatan_ymh_diterima',
        'a_penyesuaian_d_simpanan_manasuka_pkpri',
        'a_penyesuaian_d_tabungan_di_pkpri',
        'a_penyesuaian_d_simpanan_pokok_pkpri',
        'a_penyesuaian_d_simpanan_wajib_pkpri',
        'a_penyesuaian_d_simp_khusus_pkpri',
        'a_penyesuaian_d_simp_khusus_swp',
        'a_penyesuaian_d_skpb',
        'a_penyesuaian_d_penyertaan_di_hotel_pkpri',
        'a_penyesuaian_d_penyertaan_di_kopen',
        'a_penyesuaian_d_penyertaan_unit_konsumsi',
        'a_penyesuaian_d_tanah',
        'a_penyesuaian_d_kewajiban_titipan',
        'a_penyesuaian_d_biaya_yang_masih_harus_dibayar',
        'a_penyesuaian_d_jasa_partisipasi',
        'a_penyesuaian_d_dana_pengurus',
        'a_penyesuaian_d_dana_karyawan',
        'a_penyesuaian_d_dana_pendidikan',
        'a_penyesuaian_d_dana_sosial',
        'a_penyesuaian_d_utang_ke_pkpri_atau_bni',
        'a_penyesuaian_d_tabungan_qurban',
        'a_penyesuaian_d_simpanan_khusus_swp',
        'a_penyesuaian_d_simpanan_manasuka',
        'a_penyesuaian_d_donasi',
        'a_penyesuaian_d_simpanan_pokok_anggota',
        'a_penyesuaian_d_simpanan_wajib_anggota',
        'a_penyesuaian_d_cadangan',
        'a_penyesuaian_d_shu',
        'a_penyesuaian_d_jasa_dari_anggota',
        'a_penyesuaian_d_jasa_administrasi',
        'a_penyesuaian_d_pembelian',
        'a_penyesuaian_d_penjualan',
        'a_penyesuaian_d_hpp_penjualan',
        'a_penyesuaian_d_beban_organisasi',
        'a_penyesuaian_d_beban_umum',
        'a_penyesuaian_d_beban_lain_lain',
        'a_penyesuaian_d_jasa_unit_konsumsi',
        'a_penyesuaian_d_pendapatan_lain_lain',
        'a_penyesuaian_d_pendapatan_tanah_kavling',
        'a_penyesuaian_d_piutang_khusus',
        'a_penyesuaian_d_beban_pajak_belum_dibayar',
        'a_penyesuaian_d_pajak',
        'a_penyesuaian_d_jasa_simp_mana_suka',
        'jumlah',
    ];

    public function perhitunganNeraca()
    {
        return $this->belongsTo(Neraca::class);
    }
}
