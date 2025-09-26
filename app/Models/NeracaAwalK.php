<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NeracaAwalK extends Model
{
    protected $table = 'neraca_awal_k';

    protected $fillable = [
        'perhitungan_neraca_id',
        'neraca_awal_k_kas',
        'neraca_awal_k_bank',
        'neraca_awal_k_piutang',
        'neraca_awal_k_piutang_tanah',
        'neraca_awal_k_piutang_lain_pada_anggota',
        'neraca_awal_k_penyisihan_piutang',
        'neraca_awal_k_piutang_barang',
        'neraca_awal_k_persediaan_barang',
        'neraca_awal_k_persediaan_peralatan',
        'neraca_awal_k_akumulasi_peny_peralatan',
        'neraca_awal_k_pendapatan_ymh_diterima',
        'neraca_awal_k_simpanan_manasuka_pkpri',
        'neraca_awal_k_tabungan_di_pkpri',
        'neraca_awal_k_simpanan_pokok_pkpri',
        'neraca_awal_k_simpanan_wajib_pkpri',
        'neraca_awal_k_simp_khusus_pkpri',
        'neraca_awal_k_simp_khusus_swp',
        'neraca_awal_k_skpb',
        'neraca_awal_k_penyertaan_di_hotel_pkpri',
        'neraca_awal_k_penyertaan_di_kopen',
        'neraca_awal_k_penyertaan_unit_konsumsi',
        'neraca_awal_k_tanah',
        'neraca_awal_k_kewajiban_titipan',
        'neraca_awal_k_biaya_yang_masih_harus_dibayar',
        'neraca_awal_k_jasa_partisipasi',
        'neraca_awal_k_dana_pengurus',
        'neraca_awal_k_dana_karyawan',
        'neraca_awal_k_dana_pendidikan',
        'neraca_awal_k_dana_sosial',
        'neraca_awal_k_utang_ke_pkpri_atau_bni',
        'neraca_awal_k_tabungan_qurban',
        'neraca_awal_k_simpanan_khusus_swp',
        'neraca_awal_k_simpanan_manasuka',
        'neraca_awal_k_donasi',
        'neraca_awal_k_simpanan_pokok_anggota',
        'neraca_awal_k_simpanan_wajib_anggota',
        'neraca_awal_k_cadangan',
        'neraca_awal_k_shu',
        'neraca_awal_k_jasa_dari_anggota',
        'neraca_awal_k_jasa_administrasi',
        'neraca_awal_k_pembelian',
        'neraca_awal_k_penjualan',
        'neraca_awal_k_hpp_penjualan',
        'neraca_awal_k_beban_organisasi',
        'neraca_awal_k_beban_operasional',
        'neraca_awal_k_beban_umum',
        'neraca_awal_k_beban_lain_lain',
        'neraca_awal_k_jasa_unit_konsumsi',
        'neraca_awal_k_pendapatan_lain_lain',
        'neraca_awal_k_pendapatan_tanah_kavling',
        'neraca_awal_k_piutang_khusus',
        'neraca_awal_k_beban_pajak_belum_dibayar',
        'neraca_awal_k_pajak',
        'neraca_awal_k_jasa_simp_mana_suka',
        'jumlah',
    ];

    public function perhitunganNeraca()
    {
        return $this->belongsTo(Neraca::class);
    }
}
