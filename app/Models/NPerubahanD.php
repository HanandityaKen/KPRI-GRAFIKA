<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NPerubahanD extends Model
{
    protected $table = 'n_perubahan_d';

    protected $fillable = [
        'perhitungan_neraca_id',
        'n_perubahan_d_kas',
        'n_perubahan_d_bank',
        'n_perubahan_d_piutang',
        'n_perubahan_d_piutang_tanah',
        'n_perubahan_d_piutang_lain_pada_anggota',
        'n_perubahan_d_penyisihan_piutang',
        'n_perubahan_d_piutang_barang',
        'n_perubahan_d_persediaan_barang',
        'n_perubahan_d_persediaan_peralatan',
        'n_perubahan_d_akumulasi_peny_peralatan',
        'n_perubahan_d_pendapatan_ymh_diterima',
        'n_perubahan_d_simpanan_manasuka_pkpri',
        'n_perubahan_d_tabungan_di_pkpri',
        'n_perubahan_d_simpanan_pokok_pkpri',
        'n_perubahan_d_simpanan_wajib_pkpri',
        'n_perubahan_d_simp_khusus_pkpri',
        'n_perubahan_d_simp_khusus_swp',
        'n_perubahan_d_skpb',
        'n_perubahan_d_penyertaan_di_hotel_pkpri',
        'n_perubahan_d_penyertaan_di_kopen',
        'n_perubahan_d_penyertaan_unit_konsumsi',
        'n_perubahan_d_tanah',
        'n_perubahan_d_kewajiban_titipan',
        'n_perubahan_d_biaya_yang_masih_harus_dibayar',
        'n_perubahan_d_jasa_partisipasi',
        'n_perubahan_d_dana_pengurus',
        'n_perubahan_d_dana_karyawan',
        'n_perubahan_d_dana_pendidikan',
        'n_perubahan_d_dana_sosial',
        'n_perubahan_d_utang_ke_pkpri_atau_bni',
        'n_perubahan_d_tabungan_qurban',
        'n_perubahan_d_simpanan_khusus_swp',
        'n_perubahan_d_simpanan_manasuka',
        'n_perubahan_d_donasi',
        'n_perubahan_d_simpanan_pokok_anggota',
        'n_perubahan_d_simpanan_wajib_anggota',
        'n_perubahan_d_cadangan',
        'n_perubahan_d_shu',
        'n_perubahan_d_jasa_dari_anggota',
        'n_perubahan_d_jasa_administrasi',
        'n_perubahan_d_pembelian',
        'n_perubahan_d_penjualan',
        'n_perubahan_d_hpp_penjualan',
        'n_perubahan_d_beban_organisasi',
        'n_perubahan_d_beban_umum',
        'n_perubahan_d_beban_lain_lain',
        'n_perubahan_d_jasa_unit_konsumsi',
        'n_perubahan_d_pendapatan_lain_lain',
        'n_perubahan_d_pendapatan_tanah_kavling',
        'n_perubahan_d_piutang_khusus',
        'n_perubahan_d_beban_pajak_belum_dibayar',
        'n_perubahan_d_pajak',
        'n_perubahan_d_jasa_simp_mana_suka',
        'jumlah',
    ];

    public function perhitunganNeraca()
    {
        return $this->belongsTo(Neraca::class);
    }
}
