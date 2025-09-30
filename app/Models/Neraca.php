<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Neraca extends Model
{
    protected $table = 'neraca';

    protected $fillable = [
        'tahun',
        'kas',
        'bank',
        'piutang',
        'piutang_tanah',
        'piutang_lain_pada_anggota',
        'penyisihan_piutang',
        'piutang_barang',
        'persediaan_barang',
        'persediaan_peralatan',
        'akumulasi_peny_peralatan',
        'pendapatan_ymh_diterima',
        'simpanan_manasuka_pkpri',
        'tabungan_di_pkpri',
        'simpanan_pokok_pkpri',
        'simpanan_wajib_pkpri',
        'simp_khusus_pkpri',
        'simp_khusus_swp',
        'skpb',
        'penyertaan_di_hotel_pkpri',
        'penyertaan_di_kopen',
        'penyertaan_unit_konsumsi',
        'tanah',
        'kewajiban_titipan',
        'biaya_yang_masih_harus_dibayar',
        'jasa_partisipasi',
        'dana_pengurus',
        'dana_karyawan',
        'dana_pendidikan',
        'dana_sosial',
        'utang_ke_pkpri_atau_bni',
        'tabungan_qurban',
        'simpanan_khusus_swp',
        'simpanan_manasuka',
        'donasi',
        'simpanan_pokok_anggota',
        'simpanan_wajib_anggota',
        'cadangan',
        'shu',
        'jasa_dari_anggota',
        'jasa_administrasi',
        'pembelian',
        'penjualan',
        'hpp_penjualan',
        'beban_organisasi',
        'beban_operasional',
        'beban_umum',
        'beban_lain_lain',
        'jasa_unit_konsumsi',
        'pendapatan_lain_lain',
        'pendapatan_tanah_kavling',
        'piutang_khusus',
        'beban_pajak_belum_dibayar',
        'pajak',
        'jasa_simp_mana_suka',
    ];
}
