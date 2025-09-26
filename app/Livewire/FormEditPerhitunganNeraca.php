<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\KasHarian;
use App\Models\PerhitunganNeraca;

class FormEditPerhitunganNeraca extends Component
{
    public $perhitunganNeraca;

    public $tahun = '';

    public $tahunNeracaAwal = '';

    // Neraca Awal D
    public $neraca_awal_d_kas = '';
    public $neraca_awal_d_bank = '';
    public $neraca_awal_d_piutang = '';
    public $neraca_awal_d_piutang_tanah = '';
    public $neraca_awal_d_piutang_lain_pada_anggota = '';
    public $neraca_awal_d_penyisihan_piutang = '';
    public $neraca_awal_d_piutang_barang = '';
    public $neraca_awal_d_persediaan_barang = '';
    public $neraca_awal_d_persediaan_peralatan = '';
    public $neraca_awal_d_akumulasi_peny_peralatan = '';
    public $neraca_awal_d_pendapatan_ymh_diterima = '';
    public $neraca_awal_d_simpanan_manasuka_pkpri = '';
    public $neraca_awal_d_tabungan_di_pkpri = '';
    public $neraca_awal_d_simpanan_pokok_pkpri = '';
    public $neraca_awal_d_simpanan_wajib_pkpri = '';
    public $neraca_awal_d_simp_khusus_pkpri = '';
    public $neraca_awal_d_simp_khusus_swp = '';
    public $neraca_awal_d_skpb = '';
    public $neraca_awal_d_penyertaan_di_hotel_pkpri = '';
    public $neraca_awal_d_penyertaan_di_kopen = '';
    public $neraca_awal_d_penyertaan_unit_konsumsi = '';
    public $neraca_awal_d_tanah = '';
    public $neraca_awal_d_kewajiban_titipan = '';
    public $neraca_awal_d_biaya_yang_masih_harus_dibayar = '';
    public $neraca_awal_d_jasa_partisipasi = '';
    public $neraca_awal_d_dana_pengurus = '';
    public $neraca_awal_d_dana_karyawan = '';
    public $neraca_awal_d_dana_pendidikan = '';
    public $neraca_awal_d_dana_sosial = '';
    public $neraca_awal_d_utang_ke_pkpri_atau_bni = '';
    public $neraca_awal_d_tabungan_qurban = '';
    public $neraca_awal_d_simpanan_khusus_swp = '';
    public $neraca_awal_d_simpanan_manasuka = '';
    public $neraca_awal_d_donasi = '';
    public $neraca_awal_d_simpanan_pokok_anggota = '';
    public $neraca_awal_d_simpanan_wajib_anggota = '';
    public $neraca_awal_d_cadangan = '';
    public $neraca_awal_d_shu = '';
    public $neraca_awal_d_jasa_dari_anggota = '';
    public $neraca_awal_d_jasa_administrasi = '';
    public $neraca_awal_d_pembelian = '';
    public $neraca_awal_d_penjualan = '';
    public $neraca_awal_d_hpp_penjualan = '';
    public $neraca_awal_d_beban_organisasi = '';
    public $neraca_awal_d_beban_operasional = '';
    public $neraca_awal_d_beban_umum = '';
    public $neraca_awal_d_beban_lain_lain = '';
    public $neraca_awal_d_jasa_unit_konsumsi = '';
    public $neraca_awal_d_pendapatan_lain_lain = '';
    public $neraca_awal_d_pendapatan_tanah_kavling = '';
    public $neraca_awal_d_piutang_khusus = '';
    public $neraca_awal_d_beban_pajak_belum_dibayar = '';
    public $neraca_awal_d_pajak = '';
    public $neraca_awal_d_jasa_simp_mana_suka = '';
    public $neraca_awal_d = '';
    
    // Neraca Awal K
    public $neraca_awal_k_kas = '';
    public $neraca_awal_k_bank = '';
    public $neraca_awal_k_piutang = '';
    public $neraca_awal_k_piutang_tanah = '';
    public $neraca_awal_k_piutang_lain_pada_anggota = '';
    public $neraca_awal_k_penyisihan_piutang = '';
    public $neraca_awal_k_piutang_barang = '';
    public $neraca_awal_k_persediaan_barang = '';
    public $neraca_awal_k_persediaan_peralatan = '';
    public $neraca_awal_k_akumulasi_peny_peralatan = '';
    public $neraca_awal_k_pendapatan_ymh_diterima = '';
    public $neraca_awal_k_simpanan_manasuka_pkpri = '';
    public $neraca_awal_k_tabungan_di_pkpri = '';
    public $neraca_awal_k_simpanan_pokok_pkpri = '';
    public $neraca_awal_k_simpanan_wajib_pkpri = '';
    public $neraca_awal_k_simp_khusus_pkpri = '';
    public $neraca_awal_k_simp_khusus_swp = '';
    public $neraca_awal_k_skpb = '';
    public $neraca_awal_k_penyertaan_di_hotel_pkpri = '';
    public $neraca_awal_k_penyertaan_di_kopen = '';
    public $neraca_awal_k_penyertaan_unit_konsumsi = '';
    public $neraca_awal_k_tanah = '';
    public $neraca_awal_k_kewajiban_titipan = '';
    public $neraca_awal_k_biaya_yang_masih_harus_dibayar = '';
    public $neraca_awal_k_jasa_partisipasi = '';
    public $neraca_awal_k_dana_pengurus = '';
    public $neraca_awal_k_dana_karyawan = '';
    public $neraca_awal_k_dana_pendidikan = '';
    public $neraca_awal_k_dana_sosial = '';
    public $neraca_awal_k_utang_ke_pkpri_atau_bni = '';
    public $neraca_awal_k_tabungan_qurban = '';
    public $neraca_awal_k_simpanan_khusus_swp = '';
    public $neraca_awal_k_simpanan_manasuka = '';
    public $neraca_awal_k_donasi = '';
    public $neraca_awal_k_simpanan_pokok_anggota = '';
    public $neraca_awal_k_simpanan_wajib_anggota = '';
    public $neraca_awal_k_cadangan = '';
    public $neraca_awal_k_shu = '';
    public $neraca_awal_k_jasa_dari_anggota = '';
    public $neraca_awal_k_jasa_administrasi = '';
    public $neraca_awal_k_pembelian = '';
    public $neraca_awal_k_penjualan = '';
    public $neraca_awal_k_hpp_penjualan = '';
    public $neraca_awal_k_beban_organisasi = '';
    public $neraca_awal_k_beban_operasional = '';
    public $neraca_awal_k_beban_umum = '';
    public $neraca_awal_k_beban_lain_lain = '';
    public $neraca_awal_k_jasa_unit_konsumsi = '';
    public $neraca_awal_k_pendapatan_lain_lain = '';
    public $neraca_awal_k_pendapatan_tanah_kavling = '';
    public $neraca_awal_k_piutang_khusus = '';
    public $neraca_awal_k_beban_pajak_belum_dibayar = '';
    public $neraca_awal_k_pajak = '';
    public $neraca_awal_k_jasa_simp_mana_suka = '';
    public $neraca_awal_k = '';
    
    // N, Perubahan D
    public $n_perubahan_d_kas = '';
    public $n_perubahan_d_bank = '';
    public $n_perubahan_d_piutang = '';
    public $n_perubahan_d_piutang_tanah = '';
    public $n_perubahan_d_piutang_lain_pada_anggota = '';
    public $n_perubahan_d_penyisihan_piutang = '';
    public $n_perubahan_d_piutang_barang = '';
    public $n_perubahan_d_persediaan_barang = '';
    public $n_perubahan_d_persediaan_peralatan = '';
    public $n_perubahan_d_akumulasi_peny_peralatan = '';
    public $n_perubahan_d_pendapatan_ymh_diterima = '';
    public $n_perubahan_d_simpanan_manasuka_pkpri = '';
    public $n_perubahan_d_tabungan_di_pkpri = '';
    public $n_perubahan_d_simpanan_pokok_pkpri = '';
    public $n_perubahan_d_simpanan_wajib_pkpri = '';
    public $n_perubahan_d_simp_khusus_pkpri = '';
    public $n_perubahan_d_simp_khusus_swp = '';
    public $n_perubahan_d_skpb = '';
    public $n_perubahan_d_penyertaan_di_hotel_pkpri = '';
    public $n_perubahan_d_penyertaan_di_kopen = '';
    public $n_perubahan_d_penyertaan_unit_konsumsi = '';
    public $n_perubahan_d_tanah = '';
    public $n_perubahan_d_kewajiban_titipan = '';
    public $n_perubahan_d_biaya_yang_masih_harus_dibayar = '';
    public $n_perubahan_d_jasa_partisipasi = '';
    public $n_perubahan_d_dana_pengurus = '';
    public $n_perubahan_d_dana_karyawan = '';
    public $n_perubahan_d_dana_pendidikan = '';
    public $n_perubahan_d_dana_sosial = '';
    public $n_perubahan_d_utang_ke_pkpri_atau_bni = '';
    public $n_perubahan_d_tabungan_qurban = '';
    public $n_perubahan_d_simpanan_khusus_swp = '';
    public $n_perubahan_d_simpanan_manasuka = '';
    public $n_perubahan_d_donasi = '';
    public $n_perubahan_d_simpanan_pokok_anggota = '';
    public $n_perubahan_d_simpanan_wajib_anggota = '';
    public $n_perubahan_d_cadangan = '';
    public $n_perubahan_d_shu = '';
    public $n_perubahan_d_jasa_dari_anggota = '';
    public $n_perubahan_d_jasa_administrasi = '';
    public $n_perubahan_d_pembelian = '';
    public $n_perubahan_d_penjualan = '';
    public $n_perubahan_d_hpp_penjualan = '';
    public $n_perubahan_d_beban_organisasi = '';
    public $n_perubahan_d_beban_operasional = '';
    public $n_perubahan_d_beban_umum = '';
    public $n_perubahan_d_beban_lain_lain = '';
    public $n_perubahan_d_jasa_unit_konsumsi = '';
    public $n_perubahan_d_pendapatan_lain_lain = '';
    public $n_perubahan_d_pendapatan_tanah_kavling = '';
    public $n_perubahan_d_piutang_khusus = '';
    public $n_perubahan_d_beban_pajak_belum_dibayar = '';
    public $n_perubahan_d_pajak = '';
    public $n_perubahan_d_jasa_simp_mana_suka = '';
    public $n_perubahan_d = '';
    
    // N. Perubahan K
    public $n_perubahan_k_kas = '';
    public $n_perubahan_k_bank = '';
    public $n_perubahan_k_piutang = '';
    public $n_perubahan_k_piutang_tanah = '';
    public $n_perubahan_k_piutang_lain_pada_anggota = '';
    public $n_perubahan_k_penyisihan_piutang = '';
    public $n_perubahan_k_piutang_barang = '';
    public $n_perubahan_k_persediaan_barang = '';
    public $n_perubahan_k_persediaan_peralatan = '';
    public $n_perubahan_k_akumulasi_peny_peralatan = '';
    public $n_perubahan_k_pendapatan_ymh_diterima = '';
    public $n_perubahan_k_simpanan_manasuka_pkpri = '';
    public $n_perubahan_k_tabungan_di_pkpri = '';
    public $n_perubahan_k_simpanan_pokok_pkpri = '';
    public $n_perubahan_k_simpanan_wajib_pkpri = '';
    public $n_perubahan_k_simp_khusus_pkpri = '';
    public $n_perubahan_k_simp_khusus_swp = '';
    public $n_perubahan_k_skpb = '';
    public $n_perubahan_k_penyertaan_di_hotel_pkpri = '';
    public $n_perubahan_k_penyertaan_di_kopen = '';
    public $n_perubahan_k_penyertaan_unit_konsumsi = '';
    public $n_perubahan_k_tanah = '';
    public $n_perubahan_k_kewajiban_titipan = '';
    public $n_perubahan_k_biaya_yang_masih_harus_dibayar = '';
    public $n_perubahan_k_jasa_partisipasi = '';
    public $n_perubahan_k_dana_pengurus = '';
    public $n_perubahan_k_dana_karyawan = '';
    public $n_perubahan_k_dana_pendidikan = '';
    public $n_perubahan_k_dana_sosial = '';
    public $n_perubahan_k_utang_ke_pkpri_atau_bni = '';
    public $n_perubahan_k_tabungan_qurban = '';
    public $n_perubahan_k_simpanan_khusus_swp = '';
    public $n_perubahan_k_simpanan_manasuka = '';
    public $n_perubahan_k_donasi = '';
    public $n_perubahan_k_simpanan_pokok_anggota = '';
    public $n_perubahan_k_simpanan_wajib_anggota = '';
    public $n_perubahan_k_cadangan = '';
    public $n_perubahan_k_shu = '';
    public $n_perubahan_k_jasa_dari_anggota = '';
    public $n_perubahan_k_jasa_administrasi = '';
    public $n_perubahan_k_pembelian = '';
    public $n_perubahan_k_penjualan = '';
    public $n_perubahan_k_hpp_penjualan = '';
    public $n_perubahan_k_beban_organisasi = '';
    public $n_perubahan_k_beban_operasional = '';
    public $n_perubahan_k_beban_umum = '';
    public $n_perubahan_k_beban_lain_lain = '';
    public $n_perubahan_k_jasa_unit_konsumsi = '';
    public $n_perubahan_k_pendapatan_lain_lain = '';
    public $n_perubahan_k_pendapatan_tanah_kavling = '';
    public $n_perubahan_k_piutang_khusus = '';
    public $n_perubahan_k_beban_pajak_belum_dibayar = '';
    public $n_perubahan_k_pajak = '';
    public $n_perubahan_k_jasa_simp_mana_suka = '';
    public $n_perubahan_k = '';
    
    // A. Penyesuaian D
    public $a_penyesuaian_d_kas = '';
    public $a_penyesuaian_d_bank = '';
    public $a_penyesuaian_d_piutang = '';
    public $a_penyesuaian_d_piutang_tanah = '';
    public $a_penyesuaian_d_piutang_lain_pada_anggota = '';
    public $a_penyesuaian_d_penyisihan_piutang = '';
    public $a_penyesuaian_d_piutang_barang = '';
    public $a_penyesuaian_d_persediaan_barang = '';
    public $a_penyesuaian_d_persediaan_peralatan = '';
    public $a_penyesuaian_d_akumulasi_peny_peralatan = '';
    public $a_penyesuaian_d_pendapatan_ymh_diterima = '';
    public $a_penyesuaian_d_simpanan_manasuka_pkpri = '';
    public $a_penyesuaian_d_tabungan_di_pkpri = '';
    public $a_penyesuaian_d_simpanan_pokok_pkpri = '';
    public $a_penyesuaian_d_simpanan_wajib_pkpri = '';
    public $a_penyesuaian_d_simp_khusus_pkpri = '';
    public $a_penyesuaian_d_simp_khusus_swp = '';
    public $a_penyesuaian_d_skpb = '';
    public $a_penyesuaian_d_penyertaan_di_hotel_pkpri = '';
    public $a_penyesuaian_d_penyertaan_di_kopen = '';
    public $a_penyesuaian_d_penyertaan_unit_konsumsi = '';
    public $a_penyesuaian_d_tanah = '';
    public $a_penyesuaian_d_kewajiban_titipan = '';
    public $a_penyesuaian_d_biaya_yang_masih_harus_dibayar = '';
    public $a_penyesuaian_d_jasa_partisipasi = '';
    public $a_penyesuaian_d_dana_pengurus = '';
    public $a_penyesuaian_d_dana_karyawan = '';
    public $a_penyesuaian_d_dana_pendidikan = '';
    public $a_penyesuaian_d_dana_sosial = '';
    public $a_penyesuaian_d_utang_ke_pkpri_atau_bni = '';
    public $a_penyesuaian_d_tabungan_qurban = '';
    public $a_penyesuaian_d_simpanan_khusus_swp = '';
    public $a_penyesuaian_d_simpanan_manasuka = '';
    public $a_penyesuaian_d_donasi = '';
    public $a_penyesuaian_d_simpanan_pokok_anggota = '';
    public $a_penyesuaian_d_simpanan_wajib_anggota = '';
    public $a_penyesuaian_d_cadangan = '';
    public $a_penyesuaian_d_shu = '';
    public $a_penyesuaian_d_jasa_dari_anggota = '';
    public $a_penyesuaian_d_jasa_administrasi = '';
    public $a_penyesuaian_d_pembelian = '';
    public $a_penyesuaian_d_penjualan = '';
    public $a_penyesuaian_d_hpp_penjualan = '';
    public $a_penyesuaian_d_beban_organisasi = '';
    public $a_penyesuaian_d_beban_operasional = '';
    public $a_penyesuaian_d_beban_umum = '';
    public $a_penyesuaian_d_beban_lain_lain = '';
    public $a_penyesuaian_d_jasa_unit_konsumsi = '';
    public $a_penyesuaian_d_pendapatan_lain_lain = '';
    public $a_penyesuaian_d_pendapatan_tanah_kavling = '';
    public $a_penyesuaian_d_piutang_khusus = '';
    public $a_penyesuaian_d_beban_pajak_belum_dibayar = '';
    public $a_penyesuaian_d_pajak = '';
    public $a_penyesuaian_d_jasa_simp_mana_suka = '';
    public $a_penyesuaian_d = '';
    
    // A. Penyesuaian K
    public $a_penyesuaian_k_kas = '';
    public $a_penyesuaian_k_bank = '';
    public $a_penyesuaian_k_piutang = '';
    public $a_penyesuaian_k_piutang_tanah = '';
    public $a_penyesuaian_k_piutang_lain_pada_anggota = '';
    public $a_penyesuaian_k_penyisihan_piutang = '';
    public $a_penyesuaian_k_piutang_barang = '';
    public $a_penyesuaian_k_persediaan_barang = '';
    public $a_penyesuaian_k_persediaan_peralatan = '';
    public $a_penyesuaian_k_akumulasi_peny_peralatan = '';
    public $a_penyesuaian_k_pendapatan_ymh_diterima = '';
    public $a_penyesuaian_k_simpanan_manasuka_pkpri = '';
    public $a_penyesuaian_k_tabungan_di_pkpri = '';
    public $a_penyesuaian_k_simpanan_pokok_pkpri = '';
    public $a_penyesuaian_k_simpanan_wajib_pkpri = '';
    public $a_penyesuaian_k_simp_khusus_pkpri = '';
    public $a_penyesuaian_k_simp_khusus_swp = '';
    public $a_penyesuaian_k_skpb = '';
    public $a_penyesuaian_k_penyertaan_di_hotel_pkpri = '';
    public $a_penyesuaian_k_penyertaan_di_kopen = '';
    public $a_penyesuaian_k_penyertaan_unit_konsumsi = '';
    public $a_penyesuaian_k_tanah = '';
    public $a_penyesuaian_k_kewajiban_titipan = '';
    public $a_penyesuaian_k_biaya_yang_masih_harus_dibayar = '';
    public $a_penyesuaian_k_jasa_partisipasi = '';
    public $a_penyesuaian_k_dana_pengurus = '';
    public $a_penyesuaian_k_dana_karyawan = '';
    public $a_penyesuaian_k_dana_pendidikan = '';
    public $a_penyesuaian_k_dana_sosial = '';
    public $a_penyesuaian_k_utang_ke_pkpri_atau_bni = '';
    public $a_penyesuaian_k_tabungan_qurban = '';
    public $a_penyesuaian_k_simpanan_khusus_swp = '';
    public $a_penyesuaian_k_simpanan_manasuka = '';
    public $a_penyesuaian_k_donasi = '';
    public $a_penyesuaian_k_simpanan_pokok_anggota = '';
    public $a_penyesuaian_k_simpanan_wajib_anggota = '';
    public $a_penyesuaian_k_cadangan = '';
    public $a_penyesuaian_k_shu = '';
    public $a_penyesuaian_k_jasa_dari_anggota = '';
    public $a_penyesuaian_k_jasa_administrasi = '';
    public $a_penyesuaian_k_pembelian = '';
    public $a_penyesuaian_k_penjualan = '';
    public $a_penyesuaian_k_hpp_penjualan = '';
    public $a_penyesuaian_k_beban_organisasi = '';
    public $a_penyesuaian_k_beban_operasional = '';
    public $a_penyesuaian_k_beban_umum = '';
    public $a_penyesuaian_k_beban_lain_lain = '';
    public $a_penyesuaian_k_jasa_unit_konsumsi = '';
    public $a_penyesuaian_k_pendapatan_lain_lain = '';
    public $a_penyesuaian_k_pendapatan_tanah_kavling = '';
    public $a_penyesuaian_k_piutang_khusus = '';
    public $a_penyesuaian_k_beban_pajak_belum_dibayar = '';
    public $a_penyesuaian_k_pajak = '';
    public $a_penyesuaian_k_jasa_simp_mana_suka = '';
    public $a_penyesuaian_k = '';
    
    // Rugi dan Laba D
    public $rugi_dan_laba_d_kas = '';
    public $rugi_dan_laba_d_bank = '';
    public $rugi_dan_laba_d_piutang = '';
    public $rugi_dan_laba_d_piutang_tanah = '';
    public $rugi_dan_laba_d_piutang_lain_pada_anggota = '';
    public $rugi_dan_laba_d_penyisihan_piutang = '';
    public $rugi_dan_laba_d_piutang_barang = '';
    public $rugi_dan_laba_d_persediaan_barang = '';
    public $rugi_dan_laba_d_persediaan_peralatan = '';
    public $rugi_dan_laba_d_akumulasi_peny_peralatan = '';
    public $rugi_dan_laba_d_pendapatan_ymh_diterima = '';
    public $rugi_dan_laba_d_simpanan_manasuka_pkpri = '';
    public $rugi_dan_laba_d_tabungan_di_pkpri = '';
    public $rugi_dan_laba_d_simpanan_pokok_pkpri = '';
    public $rugi_dan_laba_d_simpanan_wajib_pkpri = '';
    public $rugi_dan_laba_d_simp_khusus_pkpri = '';
    public $rugi_dan_laba_d_simp_khusus_swp = '';
    public $rugi_dan_laba_d_skpb = '';
    public $rugi_dan_laba_d_penyertaan_di_hotel_pkpri = '';
    public $rugi_dan_laba_d_penyertaan_di_kopen = '';
    public $rugi_dan_laba_d_penyertaan_unit_konsumsi = '';
    public $rugi_dan_laba_d_tanah = '';
    public $rugi_dan_laba_d_kewajiban_titipan = '';
    public $rugi_dan_laba_d_biaya_yang_masih_harus_dibayar = '';
    public $rugi_dan_laba_d_jasa_partisipasi = '';
    public $rugi_dan_laba_d_dana_pengurus = '';
    public $rugi_dan_laba_d_dana_karyawan = '';
    public $rugi_dan_laba_d_dana_pendidikan = '';
    public $rugi_dan_laba_d_dana_sosial = '';
    public $rugi_dan_laba_d_utang_ke_pkpri_atau_bni = '';
    public $rugi_dan_laba_d_tabungan_qurban = '';
    public $rugi_dan_laba_d_simpanan_khusus_swp = '';
    public $rugi_dan_laba_d_simpanan_manasuka = '';
    public $rugi_dan_laba_d_donasi = '';
    public $rugi_dan_laba_d_simpanan_pokok_anggota = '';
    public $rugi_dan_laba_d_simpanan_wajib_anggota = '';
    public $rugi_dan_laba_d_cadangan = '';
    public $rugi_dan_laba_d_shu = '';
    public $rugi_dan_laba_d_jasa_dari_anggota = '';
    public $rugi_dan_laba_d_jasa_administrasi = '';
    public $rugi_dan_laba_d_pembelian = '';
    public $rugi_dan_laba_d_penjualan = '';
    public $rugi_dan_laba_d_hpp_penjualan = '';
    public $rugi_dan_laba_d_beban_organisasi = '';
    public $rugi_dan_laba_d_beban_operasional = '';
    public $rugi_dan_laba_d_beban_umum = '';
    public $rugi_dan_laba_d_beban_lain_lain = '';
    public $rugi_dan_laba_d_jasa_unit_konsumsi = '';
    public $rugi_dan_laba_d_pendapatan_lain_lain = '';
    public $rugi_dan_laba_d_pendapatan_tanah_kavling = '';
    public $rugi_dan_laba_d_piutang_khusus = '';
    public $rugi_dan_laba_d_beban_pajak_belum_dibayar = '';
    public $rugi_dan_laba_d_pajak = '';
    public $rugi_dan_laba_d_jasa_simp_mana_suka = '';
    public $rugi_dan_laba_d = '';
    
    // Rugi dan Laba K
    public $rugi_dan_laba_k_kas = '';
    public $rugi_dan_laba_k_bank = '';
    public $rugi_dan_laba_k_piutang = '';
    public $rugi_dan_laba_k_piutang_tanah = '';
    public $rugi_dan_laba_k_piutang_lain_pada_anggota = '';
    public $rugi_dan_laba_k_penyisihan_piutang = '';
    public $rugi_dan_laba_k_piutang_barang = '';
    public $rugi_dan_laba_k_persediaan_barang = '';
    public $rugi_dan_laba_k_persediaan_peralatan = '';
    public $rugi_dan_laba_k_akumulasi_peny_peralatan = '';
    public $rugi_dan_laba_k_pendapatan_ymh_diterima = '';
    public $rugi_dan_laba_k_simpanan_manasuka_pkpri = '';
    public $rugi_dan_laba_k_tabungan_di_pkpri = '';
    public $rugi_dan_laba_k_simpanan_pokok_pkpri = '';
    public $rugi_dan_laba_k_simpanan_wajib_pkpri = '';
    public $rugi_dan_laba_k_simp_khusus_pkpri = '';
    public $rugi_dan_laba_k_simp_khusus_swp = '';
    public $rugi_dan_laba_k_skpb = '';
    public $rugi_dan_laba_k_penyertaan_di_hotel_pkpri = '';
    public $rugi_dan_laba_k_penyertaan_di_kopen = '';
    public $rugi_dan_laba_k_penyertaan_unit_konsumsi = '';
    public $rugi_dan_laba_k_tanah = '';
    public $rugi_dan_laba_k_kewajiban_titipan = '';
    public $rugi_dan_laba_k_biaya_yang_masih_harus_dibayar = '';
    public $rugi_dan_laba_k_jasa_partisipasi = '';
    public $rugi_dan_laba_k_dana_pengurus = '';
    public $rugi_dan_laba_k_dana_karyawan = '';
    public $rugi_dan_laba_k_dana_pendidikan = '';
    public $rugi_dan_laba_k_dana_sosial = '';
    public $rugi_dan_laba_k_utang_ke_pkpri_atau_bni = '';
    public $rugi_dan_laba_k_tabungan_qurban = '';
    public $rugi_dan_laba_k_simpanan_khusus_swp = '';
    public $rugi_dan_laba_k_simpanan_manasuka = '';
    public $rugi_dan_laba_k_donasi = '';
    public $rugi_dan_laba_k_simpanan_pokok_anggota = '';
    public $rugi_dan_laba_k_simpanan_wajib_anggota = '';
    public $rugi_dan_laba_k_cadangan = '';
    public $rugi_dan_laba_k_shu = '';
    public $rugi_dan_laba_k_jasa_dari_anggota = '';
    public $rugi_dan_laba_k_jasa_administrasi = '';
    public $rugi_dan_laba_k_pembelian = '';
    public $rugi_dan_laba_k_penjualan = '';
    public $rugi_dan_laba_k_hpp_penjualan = '';
    public $rugi_dan_laba_k_beban_organisasi = '';
    public $rugi_dan_laba_k_beban_operasional = '';
    public $rugi_dan_laba_k_beban_umum = '';
    public $rugi_dan_laba_k_beban_lain_lain = '';
    public $rugi_dan_laba_k_jasa_unit_konsumsi = '';
    public $rugi_dan_laba_k_pendapatan_lain_lain = '';
    public $rugi_dan_laba_k_pendapatan_tanah_kavling = '';
    public $rugi_dan_laba_k_piutang_khusus = '';
    public $rugi_dan_laba_k_beban_pajak_belum_dibayar = '';
    public $rugi_dan_laba_k_pajak = '';
    public $rugi_dan_laba_k_jasa_simp_mana_suka = '';
    public $rugi_dan_laba_k = '';

    public function mount($id)
    {
        $this->formatRupiah();

        $this->perhitunganNeraca = PerhitunganNeraca::find($id);

        $this->tahun = $this->perhitunganNeraca->tahun;

        $this->getTahunNeracaAwal();

        $this->getDataPerhitunganNeraca();

        // Hitung Total
        $this->hitungNeracaAwalD();
        $this->hitungNeracaAwalK();
        $this->hitungNPerubahanD();
        $this->hitungNPerubahanK();
        $this->hitungAPenyesuaianD();
        $this->hitungAPenyesuaianK();
        $this->hitungRugiDanLabaD();
        $this->hitungRugiDanLabaK();
    }

    public function updated($propertyName)
    {
        // hitung total neraca awal d
        if (Str::startsWith($propertyName, 'neraca_awal_d_')) {
            $this->hitungNeracaAwalD();
        }

        // hitung total neraca awal k
        if (Str::startsWith($propertyName, 'neraca_awal_k_')) {
            $this->hitungNeracaAwalK();
        }

        // hitung total n perubahan d
        if (Str::startsWith($propertyName, 'n_perubahan_d_')) {
            $this->hitungNPerubahanD();
        }

        // hitung total n perubahan k
        if (Str::startsWith($propertyName, 'n_perubahan_k_')) {
            $this->hitungNPerubahanK();
        }

        // hitung total a penyesuaian d
        if (Str::startsWith($propertyName, 'a_penyesuaian_d_')) {
            $this->hitungAPenyesuaianD();
        }

        // hitung total a penyesuaian k
        if (Str::startsWith($propertyName, 'a_penyesuaian_k_')) {
            $this->hitungAPenyesuaianK();
        }

        // hitung total rugi dan laba d
        if (Str::startsWith($propertyName, 'rugi_dan_laba_d_')) {
            $this->hitungRugiDanLabaD();
        }

        // hitung total rugi dan laba k
        if (Str::startsWith($propertyName, 'rugi_dan_laba_k_')) {
            $this->hitungRugiDanLabaK();
        }
    }

    private function formatRupiah()
    {
        // Format Neraca Awal D
        foreach (get_object_vars($this) as $key => $value) {
            if (str_starts_with($key, 'neraca_awal_d_')) {
                $this->$key = "Rp " . number_format(0, 0, ',', '.'); // default angka 0
            }
        }

        // Format Neraca Awal K
        foreach (get_object_vars($this) as $key => $value) {
            if (str_starts_with($key, 'neraca_awal_k_')) {
                $this->$key = "Rp " . number_format(0, 0, ',', '.'); // default angka 0
            }
        }

        // Format N. Perubahan D
        foreach (get_object_vars($this) as $key => $value) {
            if (str_starts_with($key, 'n_perubahan_d_')) {
                $this->$key = "Rp " . number_format(0, 0, ',', '.'); // default angka 0
            }
        }

        // Format N. Perubahan K
        foreach (get_object_vars($this) as $key => $value) {
            if (str_starts_with($key, 'n_perubahan_k_')) {
                $this->$key = "Rp " . number_format(0, 0, ',', '.'); // default angka 0
            }
        }

        // Format A. Penyesuaian D
        foreach (get_object_vars($this) as $key => $value) {
            if (str_starts_with($key, 'a_penyesuaian_d_')) {
                $this->$key = "Rp " . number_format(0, 0, ',', '.'); // default angka 0
            }
        }

        // Format A. Penyesuaian K
        foreach (get_object_vars($this) as $key => $value) {
            if (str_starts_with($key, 'a_penyesuaian_k_')) {
                $this->$key = "Rp " . number_format(0, 0, ',', '.'); // default angka 0
            }
        }

        // Format Rugi dan Laba D
        foreach (get_object_vars($this) as $key => $value) {
            if (str_starts_with($key, 'rugi_dan_laba_d_')) {
                $this->$key = "Rp " . number_format(0, 0, ',', '.'); // default angka 0
            }
        }

        // Format Rugi dan Laba K
        foreach (get_object_vars($this) as $key => $value) {
            if (str_starts_with($key, 'rugi_dan_laba_k_')) {
                $this->$key = "Rp " . number_format(0, 0, ',', '.'); // default angka 0
            }
        }
    }

    private function getTahunNeracaAwal()
    {
        $this->tahunNeracaAwal = $this->tahun - 1;
    }

    private function getDataPerhitunganNeraca()
    {
        $data = PerhitunganNeraca::with([
            'neracaAwalD',
            'neracaAwalK',
            'nPerubahanD',
            'nPerubahanK',
            'aPenyesuaianD',
            'aPenyesuaianK',
            'rugiDanLabaD',
            'rugiDanLabaK',
        ])->where('tahun', $this->tahun)->first();
    
        if (! $data) {
            $this->resetFields();
            return;
        }

        // Neraca Awal D
        foreach ($data->neracaAwalD?->getAttributes() ?? [] as $key => $value) {
            if ($key !== 'id' && $key !== 'perhitungan_neraca_id') {
                $this->{$key} = 'Rp ' . number_format((int) $value, 0, ',', '.');
            }
        }

        // Neraca Awal K
        foreach ($data->neracaAwalK?->getAttributes() ?? [] as $key => $value) {
            if ($key !== 'id' && $key !== 'perhitungan_neraca_id') {
                $this->{$key} = 'Rp ' . number_format((int) $value, 0, ',', '.');
            }
        }

        // N. Perubahan D
        foreach ($data->nPerubahanD?->getAttributes() ?? [] as $key => $value) {
            if ($key !== 'id' && $key !== 'perhitungan_neraca_id') {
                $this->{$key} = 'Rp ' . number_format((int) $value, 0, ',', '.');
            }
        }

        // N. Perubahan K
        foreach ($data->nPerubahanK?->getAttributes() ?? [] as $key => $value) {
            if ($key !== 'id' && $key !== 'perhitungan_neraca_id') {
                $this->{$key} = 'Rp ' . number_format((int) $value, 0, ',', '.');
            }
        }   

        // A. Penyesuaian D
        foreach ($data->aPenyesuaianD?->getAttributes() ?? [] as $key => $value) {
            if ($key !== 'id' && $key !== 'perhitungan_neraca_id') {
                $this->{$key} = 'Rp ' . number_format((int) $value, 0, ',', '.');
            }
        }

        // A. Penyesuaian K
        foreach ($data->aPenyesuaianK?->getAttributes() ?? [] as $key => $value) {
            if ($key !== 'id' && $key !== 'perhitungan_neraca_id') {
                $this->{$key} = 'Rp ' . number_format((int) $value, 0, ',', '.');
            }
        }

        // Rugi dan Laba D
        foreach ($data->rugiDanLabaD?->getAttributes() ?? [] as $key => $value) {
            if ($key !== 'id' && $key !== 'perhitungan_neraca_id') {
                $this->{$key} = 'Rp ' . number_format((int) $value, 0, ',', '.');
            }
        }   

        // Rugi dan Laba K
        foreach ($data->rugiDanLabaK?->getAttributes() ?? [] as $key => $value) {
            if ($key !== 'id' && $key !== 'perhitungan_neraca_id') {
                $this->{$key} = 'Rp ' . number_format((int) $value, 0, ',', '.');
            }
        }
    }

    private function hitungNeracaAwalD()
    {
        $total = 0;

        foreach (get_object_vars($this) as $key => $value) {
            // hanya ambil property dengan prefix "neraca_awal_d_" kecuali totalnya sendiri
            if (Str::startsWith($key, 'neraca_awal_d_') && $key !== 'neraca_awal_d') {
                $total += (int) str_replace(['Rp', '.', ','], '', $value);
            }
        }
    
        $this->neraca_awal_d = "Rp " . number_format($total, 0, ',', '.');
    }

    private function hitungNeracaAwalK()
    {
        $total = 0;

        foreach (get_object_vars($this) as $key => $value) {
            // hanya ambil property dengan prefix "neraca_awal_k_" kecuali totalnya sendiri
            if (Str::startsWith($key, 'neraca_awal_k_') && $key !== 'neraca_awal_k') {
                $total += (int) str_replace(['Rp', '.', ','], '', $value);
            }
        }
    
        $this->neraca_awal_k = "Rp " . number_format($total, 0, ',', '.');
    }

    private function hitungNPerubahanD()
    {
        $total = 0;

        foreach (get_object_vars($this) as $key => $value) {
            // hanya ambil property dengan prefix "n_perubahan_d_" kecuali totalnya sendiri
            if (Str::startsWith($key, 'n_perubahan_d_') && $key !== 'n_perubahan_d') {
                $total += (int) str_replace(['Rp', '.', ','], '', $value);
            }
        }
    
        $this->n_perubahan_d = "Rp " . number_format($total, 0, ',', '.');
    }

    private function hitungNPerubahanK()
    {
        $total = 0;

        foreach (get_object_vars($this) as $key => $value) {
            // hanya ambil property dengan prefix "n_perubahan_k_" kecuali totalnya sendiri
            if (Str::startsWith($key, 'n_perubahan_k_') && $key !== 'n_perubahan_k') {
                $total += (int) str_replace(['Rp', '.', ','], '', $value);
            }
        }
    
        $this->n_perubahan_k = "Rp " . number_format($total, 0, ',', '.');
    }

    private function hitungAPenyesuaianD()
    {
        $total = 0;

        foreach (get_object_vars($this) as $key => $value) {
            // hanya ambil property dengan prefix "a_penyesuaian_d_" kecuali totalnya sendiri
            if (Str::startsWith($key, 'a_penyesuaian_d_') && $key !== 'a_penyesuaian_d') {
                $total += (int) str_replace(['Rp', '.', ','], '', $value);
            }
        }
    
        $this->a_penyesuaian_d = "Rp " . number_format($total, 0, ',', '.');
    }

    private function hitungAPenyesuaianK()
    {
        $total = 0;

        foreach (get_object_vars($this) as $key => $value) {
            // hanya ambil property dengan prefix "a_penyesuaian_k_" kecuali totalnya sendiri
            if (Str::startsWith($key, 'a_penyesuaian_k_') && $key !== 'a_penyesuaian_k') {
                $total += (int) str_replace(['Rp', '.', ','], '', $value);
            }
        }
    
        $this->a_penyesuaian_k = "Rp " . number_format($total, 0, ',', '.');
    }

    private function hitungRugiDanLabaD()
    {
        $total = 0;

        foreach (get_object_vars($this) as $key => $value) {
            // hanya ambil property dengan prefix "rugi_dan_laba_d_" kecuali totalnya sendiri
            if (Str::startsWith($key, 'rugi_dan_laba_d_') && $key !== 'rugi_dan_laba_d') {
                $total += (int) str_replace(['Rp', '.', ','], '', $value);
            }
        }
    
        $this->rugi_dan_laba_d = "Rp " . number_format($total, 0, ',', '.');
    }

    private function hitungRugiDanLabaK()
    {
        $total = 0;

        foreach (get_object_vars($this) as $key => $value) {
            // hanya ambil property dengan prefix "rugi_dan_laba_k_" kecuali totalnya sendiri
            if (Str::startsWith($key, 'rugi_dan_laba_k_') && $key !== 'rugi_dan_laba_k') {
                $total += (int) str_replace(['Rp', '.', ','], '', $value);
            }
        }
    
        $this->rugi_dan_laba_k = "Rp " . number_format($total, 0, ',', '.');
    }

    public function render()
    {
        return view('livewire.form-edit-perhitungan-neraca');
    }
}
