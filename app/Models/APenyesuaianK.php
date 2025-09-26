<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class APenyesuaianK extends Model
{
    protected $table = 'a_penyesuaian_k';

    protected $fillable = [
        'perhitungan_neraca_id',
        'a_penyesuaian_k_kas',
        'a_penyesuaian_k_bank',
        'a_penyesuaian_k_piutang',
        'a_penyesuaian_k_piutang_tanah',
        'a_penyesuaian_k_piutang_lain_pada_anggota',
        'a_penyesuaian_k_penyisihan_piutang',
        'a_penyesuaian_k_piutang_barang',
        'a_penyesuaian_k_persediaan_barang',
        'a_penyesuaian_k_persediaan_peralatan',
        'a_penyesuaian_k_akumulasi_peny_peralatan',
        'a_penyesuaian_k_pendapatan_ymh_diterima',
        'a_penyesuaian_k_simpanan_manasuka_pkpri',
        'a_penyesuaian_k_tabungan_di_pkpri',
        'a_penyesuaian_k_simpanan_pokok_pkpri',
        'a_penyesuaian_k_simpanan_wajib_pkpri',
        'a_penyesuaian_k_simp_khusus_pkpri',
        'a_penyesuaian_k_simp_khusus_swp',
        'a_penyesuaian_k_skpb',
        'a_penyesuaian_k_penyertaan_di_hotel_pkpri',
        'a_penyesuaian_k_penyertaan_di_kopen',
        'a_penyesuaian_k_penyertaan_unit_konsumsi',
        'a_penyesuaian_k_tanah',
        'a_penyesuaian_k_kewajiban_titipan',
        'a_penyesuaian_k_biaya_yang_masih_harus_dibayar',
        'a_penyesuaian_k_jasa_partisipasi',
        'a_penyesuaian_k_dana_pengurus',
        'a_penyesuaian_k_dana_karyawan',
        'a_penyesuaian_k_dana_pendidikan',
        'a_penyesuaian_k_dana_sosial',
        'a_penyesuaian_k_utang_ke_pkpri_atau_bni',
        'a_penyesuaian_k_tabungan_qurban',
        'a_penyesuaian_k_simpanan_khusus_swp',
        'a_penyesuaian_k_simpanan_manasuka',
        'a_penyesuaian_k_donasi',
        'a_penyesuaian_k_simpanan_pokok_anggota',
        'a_penyesuaian_k_simpanan_wajib_anggota',
        'a_penyesuaian_k_cadangan',
        'a_penyesuaian_k_shu',
        'a_penyesuaian_k_jasa_dari_anggota',
        'a_penyesuaian_k_jasa_administrasi',
        'a_penyesuaian_k_pembelian',
        'a_penyesuaian_k_penjualan',
        'a_penyesuaian_k_hpp_penjualan',
        'a_penyesuaian_k_beban_organisasi',
        'a_penyesuaian_k_beban_operasional',
        'a_penyesuaian_k_beban_umum',
        'a_penyesuaian_k_beban_lain_lain',
        'a_penyesuaian_k_jasa_unit_konsumsi',
        'a_penyesuaian_k_pendapatan_lain_lain',
        'a_penyesuaian_k_pendapatan_tanah_kavling',
        'a_penyesuaian_k_piutang_khusus',
        'a_penyesuaian_k_beban_pajak_belum_dibayar',
        'a_penyesuaian_k_pajak',
        'a_penyesuaian_k_jasa_simp_mana_suka',
        'jumlah',
    ];

    public function perhitunganNeraca()
    {
        return $this->belongsTo(Neraca::class);
    }
}
