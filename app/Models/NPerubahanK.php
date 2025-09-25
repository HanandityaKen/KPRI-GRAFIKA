<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NPerubahanK extends Model
{
    protected $table = 'n_perubahan_k';

    protected $fillable = [
        'perhitungan_neraca_id',
        'n_perubahan_k_kas',
        'n_perubahan_k_bank',
        'n_perubahan_k_piutang',
        'n_perubahan_k_piutang_tanah',
        'n_perubahan_k_piutang_lain_pada_anggota',
        'n_perubahan_k_penyisihan_piutang',
        'n_perubahan_k_piutang_barang',
        'n_perubahan_k_persediaan_barang',
        'n_perubahan_k_persediaan_peralatan',
        'n_perubahan_k_akumulasi_peny_peralatan',
        'n_perubahan_k_pendapatan_ymh_diterima',
        'n_perubahan_k_simpanan_manasuka_pkpri',
        'n_perubahan_k_tabungan_di_pkpri',
        'n_perubahan_k_simpanan_pokok_pkpri',
        'n_perubahan_k_simpanan_wajib_pkpri',
        'n_perubahan_k_simp_khusus_pkpri',
        'n_perubahan_k_simp_khusus_swp',
        'n_perubahan_k_skpb',
        'n_perubahan_k_penyertaan_di_hotel_pkpri',
        'n_perubahan_k_penyertaan_di_kopen',
        'n_perubahan_k_penyertaan_unit_konsumsi',
        'n_perubahan_k_tanah',
        'n_perubahan_k_kewajiban_titipan',
        'n_perubahan_k_biaya_yang_masih_harus_dibayar',
        'n_perubahan_k_jasa_partisipasi',
        'n_perubahan_k_dana_pengurus',
        'n_perubahan_k_dana_karyawan',
        'n_perubahan_k_dana_pendidikan',
        'n_perubahan_k_dana_sosial',
        'n_perubahan_k_utang_ke_pkpri_atau_bni',
        'n_perubahan_k_tabungan_qurban',
        'n_perubahan_k_simpanan_khusus_swp',
        'n_perubahan_k_simpanan_manasuka',
        'n_perubahan_k_donasi',
        'n_perubahan_k_simpanan_pokok_anggota',
        'n_perubahan_k_simpanan_wajib_anggota',
        'n_perubahan_k_cadangan',
        'n_perubahan_k_shu',
        'n_perubahan_k_jasa_dari_anggota',
        'n_perubahan_k_jasa_administrasi',
        'n_perubahan_k_pembelian',
        'n_perubahan_k_penjualan',
        'n_perubahan_k_hpp_penjualan',
        'n_perubahan_k_beban_organisasi',
        'n_perubahan_k_beban_umum',
        'n_perubahan_k_beban_lain_lain',
        'n_perubahan_k_jasa_unit_konsumsi',
        'n_perubahan_k_pendapatan_lain_lain',
        'n_perubahan_k_pendapatan_tanah_kavling',
        'n_perubahan_k_piutang_khusus',
        'n_perubahan_k_beban_pajak_belum_dibayar',
        'n_perubahan_k_pajak',
        'n_perubahan_k_jasa_simp_mana_suka',
        'jumlah',
    ];

    public function perhitunganNeraca()
    {
        return $this->belongsTo(Neraca::class);
    }
}
