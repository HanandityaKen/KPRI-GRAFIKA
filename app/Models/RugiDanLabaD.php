<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RugiDanLabaD extends Model
{
    protected $table = 'rugi_dan_laba_d';

    protected $fillable = [
        'perhitungan_neraca_id',
        'rugi_dan_laba_d_kas',
        'rugi_dan_laba_d_bank',
        'rugi_dan_laba_d_piutang',
        'rugi_dan_laba_d_piutang_tanah',
        'rugi_dan_laba_d_piutang_lain_pada_anggota',
        'rugi_dan_laba_d_penyisihan_piutang',
        'rugi_dan_laba_d_piutang_barang',
        'rugi_dan_laba_d_persediaan_barang',
        'rugi_dan_laba_d_persediaan_peralatan',
        'rugi_dan_laba_d_akumulasi_peny_peralatan',
        'rugi_dan_laba_d_pendapatan_ymh_diterima',
        'rugi_dan_laba_d_simpanan_manasuka_pkpri',
        'rugi_dan_laba_d_tabungan_di_pkpri',
        'rugi_dan_laba_d_simpanan_pokok_pkpri',
        'rugi_dan_laba_d_simpanan_wajib_pkpri',
        'rugi_dan_laba_d_simp_khusus_pkpri',
        'rugi_dan_laba_d_simp_khusus_swp',
        'rugi_dan_laba_d_skpb',
        'rugi_dan_laba_d_penyertaan_di_hotel_pkpri',
        'rugi_dan_laba_d_penyertaan_di_kopen',
        'rugi_dan_laba_d_penyertaan_unit_konsumsi',
        'rugi_dan_laba_d_tanah',
        'rugi_dan_laba_d_kewajiban_titipan',
        'rugi_dan_laba_d_biaya_yang_masih_harus_dibayar',
        'rugi_dan_laba_d_jasa_partisipasi',
        'rugi_dan_laba_d_dana_pengurus',
        'rugi_dan_laba_d_dana_karyawan',
        'rugi_dan_laba_d_dana_pendidikan',
        'rugi_dan_laba_d_dana_sosial',
        'rugi_dan_laba_d_utang_ke_pkpri_atau_bni',
        'rugi_dan_laba_d_tabungan_qurban',
        'rugi_dan_laba_d_simpanan_khusus_swp',
        'rugi_dan_laba_d_simpanan_manasuka',
        'rugi_dan_laba_d_donasi',
        'rugi_dan_laba_d_simpanan_pokok_anggota',
        'rugi_dan_laba_d_simpanan_wajib_anggota',
        'rugi_dan_laba_d_cadangan',
        'rugi_dan_laba_d_shu',
        'rugi_dan_laba_d_jasa_dari_anggota',
        'rugi_dan_laba_d_jasa_administrasi',
        'rugi_dan_laba_d_pembelian',
        'rugi_dan_laba_d_penjualan',
        'rugi_dan_laba_d_hpp_penjualan',
        'rugi_dan_laba_d_beban_organisasi',
        'rugi_dan_laba_d_beban_umum',
        'rugi_dan_laba_d_beban_lain_lain',
        'rugi_dan_laba_d_jasa_unit_konsumsi',
        'rugi_dan_laba_d_pendapatan_lain_lain',
        'rugi_dan_laba_d_pendapatan_tanah_kavling',
        'rugi_dan_laba_d_piutang_khusus',
        'rugi_dan_laba_d_beban_pajak_belum_dibayar',
        'rugi_dan_laba_d_pajak',
        'rugi_dan_laba_d_jasa_simp_mana_suka',
        'jumlah',
    ];

    public function perhitunganNeraca()
    {
        return $this->belongsTo(Neraca::class);
    }
}
