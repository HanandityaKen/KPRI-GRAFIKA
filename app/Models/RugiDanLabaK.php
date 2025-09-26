<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RugiDanLabaK extends Model
{
    protected $table = 'rugi_dan_laba_k';

    protected $fillable = [
        'perhitungan_neraca_id',
        'rugi_dan_laba_k_kas',
        'rugi_dan_laba_k_bank',
        'rugi_dan_laba_k_piutang',
        'rugi_dan_laba_k_piutang_tanah',
        'rugi_dan_laba_k_piutang_lain_pada_anggota',
        'rugi_dan_laba_k_penyisihan_piutang',
        'rugi_dan_laba_k_piutang_barang',
        'rugi_dan_laba_k_persediaan_barang',
        'rugi_dan_laba_k_persediaan_peralatan',
        'rugi_dan_laba_k_akumulasi_peny_peralatan',
        'rugi_dan_laba_k_pendapatan_ymh_diterima',
        'rugi_dan_laba_k_simpanan_manasuka_pkpri',
        'rugi_dan_laba_k_tabungan_di_pkpri',
        'rugi_dan_laba_k_simpanan_pokok_pkpri',
        'rugi_dan_laba_k_simpanan_wajib_pkpri',
        'rugi_dan_laba_k_simp_khusus_pkpri',
        'rugi_dan_laba_k_simp_khusus_swp',
        'rugi_dan_laba_k_skpb',
        'rugi_dan_laba_k_penyertaan_di_hotel_pkpri',
        'rugi_dan_laba_k_penyertaan_di_kopen',
        'rugi_dan_laba_k_penyertaan_unit_konsumsi',
        'rugi_dan_laba_k_tanah',
        'rugi_dan_laba_k_kewajiban_titipan',
        'rugi_dan_laba_k_biaya_yang_masih_harus_dibayar',
        'rugi_dan_laba_k_jasa_partisipasi',
        'rugi_dan_laba_k_dana_pengurus',
        'rugi_dan_laba_k_dana_karyawan',
        'rugi_dan_laba_k_dana_pendidikan',
        'rugi_dan_laba_k_dana_sosial',
        'rugi_dan_laba_k_utang_ke_pkpri_atau_bni',
        'rugi_dan_laba_k_tabungan_qurban',
        'rugi_dan_laba_k_simpanan_khusus_swp',
        'rugi_dan_laba_k_simpanan_manasuka',
        'rugi_dan_laba_k_donasi',
        'rugi_dan_laba_k_simpanan_pokok_anggota',
        'rugi_dan_laba_k_simpanan_wajib_anggota',
        'rugi_dan_laba_k_cadangan',
        'rugi_dan_laba_k_shu',
        'rugi_dan_laba_k_jasa_dari_anggota',
        'rugi_dan_laba_k_jasa_administrasi',
        'rugi_dan_laba_k_pembelian',
        'rugi_dan_laba_k_penjualan',
        'rugi_dan_laba_k_hpp_penjualan',
        'rugi_dan_laba_k_beban_organisasi',
        'rugi_dan_laba_k_beban_operasional',
        'rugi_dan_laba_k_beban_umum',
        'rugi_dan_laba_k_beban_lain_lain',
        'rugi_dan_laba_k_jasa_unit_konsumsi',
        'rugi_dan_laba_k_pendapatan_lain_lain',
        'rugi_dan_laba_k_pendapatan_tanah_kavling',
        'rugi_dan_laba_k_piutang_khusus',
        'rugi_dan_laba_k_beban_pajak_belum_dibayar',
        'rugi_dan_laba_k_pajak',
        'rugi_dan_laba_k_jasa_simp_mana_suka',
        'jumlah',
    ];

    public function perhitunganNeraca()
    {
        return $this->belongsTo(Neraca::class);
    }
}
