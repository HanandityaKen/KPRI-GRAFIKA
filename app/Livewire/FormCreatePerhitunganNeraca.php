<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\KasHarian;
use App\Models\PerhitunganNeraca;

class FormCreatePerhitunganNeraca extends Component
{
    public $tahun = '';
    public $errorMessageTahun = '';
    public $disabledErrorTahun = false;

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

    // Disable Button Simpan
    public $disabled = false;

    public function mount()
    {
        // Format Rupiah
        $this->formatRupiah();

        $this->tahun = (int) date('Y');

        $this->cekTahun();

        $this->getTahunNeracaAwal();

        // Panggil semua method get
        $this->getNPerubahanKas();
        $this->getNPerubahanPiutang();
        $this->getNPerubahanTabunganQurban();
        $this->getNPerubahanSimpananKhususSWP();
        $this->getNPerubahanSimpananManasuka();
        $this->getNPerubahanSimpananPokokAnggota();
        $this->getNPerubahanSimpananWajibAnggota();
        $this->getNPerubahanJasaDariAnggota();
        $this->getNPerubahanJasaAdministrasi();

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
        if ($propertyName === 'tahun') {
            $this->cekTahun();
            
            $this->getTahunNeracaAwal();

            $this->getNPerubahanKas();
            $this->getNPerubahanPiutang();
            $this->getNPerubahanTabunganQurban();
            $this->getNPerubahanSimpananKhususSWP();
            $this->getNPerubahanSimpananManasuka();
            $this->getNPerubahanSimpananPokokAnggota();
            $this->getNPerubahanSimpananWajibAnggota();
            $this->getNPerubahanJasaDariAnggota();
            $this->getNPerubahanJasaAdministrasi();

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

    private function cekTahun()
    {
        if ($this->tahun < 2024) {
            $this->errorMessageTahun = '* Tahun tidak boleh kurang dari 2024.';
            $this->disabledErrorTahun = true;
        } elseif (PerhitunganNeraca::where('tahun', $this->tahun)->exists()) {
            $this->errorMessageTahun = '* Tahun tersebut sudah tercatat, pilih tahun yang berbeda.';
            $this->disabledErrorTahun = true;
        } else {
            $this->errorMessageTahun = '';
            $this->disabledErrorTahun = false;
        }
        
        $this->checkDisabled();
    }

    private function getTahunNeracaAwal()
    {
        $this->tahunNeracaAwal = $this->tahun - 1;

        $this->getNeracaAwal();
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

    // private function getNeracaAwal()
    // {
    //     // Neraca Awal D dan K
    //     $neraca = Neraca::with(['neracaAwalD', 'neracaAwalK'])
    //         ->where('tahun', $this->tahunNeracaAwal)
    //         ->first();

    //     $fields = [
    //         'kas', 'bank', 'piutang', 'piutang_tanah', 'piutang_lain_pada_anggota',
    //         'penyisihan_piutang', 'piutang_barang', 'persediaan_barang',
    //         'persediaan_peralatan', 'akumulasi_peny_peralatan', 'pendapatan_ymh_diterima',
    //         'simpanan_manasuka_pkpri', 'tabungan_di_pkpri', 'simpanan_pokok_pkpri',
    //         'simpanan_wajib_pkpri', 'simp_khusus_pkpri', 'simp_khusus_swp',
    //         'skpb', 'penyertaan_di_hotel_pkpri', 'penyertaan_di_kopen',
    //         'penyertaan_unit_konsumsi', 'tanah', 'kewajiban_titipan',
    //         'biaya_yang_masih_harus_dibayar', 'jasa_partisipasi', 'dana_pengurus',
    //         'dana_karyawan', 'dana_pendidikan', 'dana_sosial', 'utang_ke_pkpri_atau_bni',
    //         'tabungan_qurban', 'simpanan_khusus_swp', 'simpanan_manasuka',
    //         'donasi', 'simpanan_pokok_anggota', 'simpanan_wajib_anggota',
    //         'cadangan', 'shu', 'jasa_dari_anggota', 'jasa_administrasi',
    //         'pembelian', 'penjualan', 'hpp_penjualan', 'beban_organisasi',
    //         'beban_umum', 'beban_lain_lain', 'jasa_unit_konsumsi',
    //         'pendapatan_lain_lain', 'pendapatan_tanah_kavling',
    //         'piutang_khusus', 'beban_pajak_belum_dibayar', 'pajak',
    //         'jasa_simp_mana_suka',
    //     ];

    //     // Default Rp 0
    //     foreach ($fields as $field) {
    //         $this->{"neraca_awal_d_$field"} = "Rp " . number_format(0, 0, ',', '.');;
    //         $this->{"neraca_awal_k_$field"} = "Rp " . number_format(0, 0, ',', '.');;
    //     }
    
    //     // Neraca Awal D
    //     if ($neraca && $neraca->neracaAwalD) {
    //         foreach ($fields as $field) {
    //             $this->{"neraca_awal_d_$field"} = "Rp " . number_format($neraca->neracaAwalD->$field, 0, ',', '.');
    //         }
    //         $this->hitungNeracaAwalD();
    //     }
    
    //     // Neraca Awal K
    //     if ($neraca && $neraca->neracaAwalK) {
    //         foreach ($fields as $field) {
    //             $this->{"neraca_awal_k_$field"} = "Rp " . number_format($neraca->neracaAwalK->$field, 0, ',', '.');
    //         }
    //         $this->hitungNeracaAwalK();
    //     }
    // }

    private function getNeracaAwal()
    {
        // Neraca Awal
        $neracaAwal = PerhitunganNeraca::with('neracaAwalD', 'neracaAwalK')
            ->where('tahun', $this->tahunNeracaAwal)->first();

        // N. Perubahan
        $nPerubahan = PerhitunganNeraca::with('neracaAwalD', 'neracaAwalK')
            ->where('tahun', $this->tahunNeracaAwal)->first();

        // A. Penyesuaian
        $aPenyesuaian = PerhitunganNeraca::with('aPenyesuaianD', 'aPenyesuaianK')
            ->where('tahun', $this->tahunNeracaAwal)->first();

        // Rugi dan Laba
        $rugiLaba = PerhitunganNeraca::with('rugiDanLabaD', 'rugiDanLabaK')
            ->where('tahun', $this->tahunNeracaAwal)->first();

        // Kas
        // $nPerubahanDKas = $neracaAwal->neracaAwalD->neraca_awal_d_kas + $nPerubahan->nPerubahanD->n_perubahan_d_kas;

        // $nPerubahanKKas = $neracaAwal->neracaAwalK->neraca_awal_k_kas + $nPerubahan->nPerubahanK->n_perubahan_k_kas;

        // $nSaldo = $nPerubahanDKas - $nPerubahanKKas;

        // if ($nSaldo >= 0) {
        //     $nSaldoD = $nSaldo;
        //     $nSaldoK = 0;

        //     $nsPenyesuaianD = $nSaldoD + $aPenyesuaian->aPenyesuaianD->a_penyesuaian_d_kas - $nSaldoK - $aPenyesuaian->aPenyesuaianK->a_penyesuaian_k_kas;
        //     $nsPenyesuaianK = 0;

        //     $rugiDanLabaD = $nsPenyesuaianD;
        //     $rugiDanLabaK = 0;

        //     $neracaD = $nsPenyesuaianD + $rugiDanLabaD;
        //     $neracaK = 0;
        // } elseif ($nSaldo < 0) {
        //     $nSaldoD = 0;
        //     $nSaldoK = abs($nSaldo);

        //     $nsPenyesuaianD = 0;
        //     $nsPenyesuaianK = $nSaldoK + $aPenyesuaian->aPenyesuaianK->a_penyesuaian_k_kas - $nSaldoD - $aPenyesuaian->aPenyesuaianD->a_penyesuaian_d_kas;

        //     $rugiDanLabaD = 0;
        //     $rugiDanLabaK = $nsPenyesuaianK;

        //     $neracaD = 0;
        //     $neracaK = $nsPenyesuaianK + $rugiDanLabaK;
        // }

        // $this->neraca_awal_d_kas = "Rp " . number_format($neracaD, 0, ',', '.');
        // $this->neraca_awal_k_kas = "Rp " . number_format($neracaK, 0, ',', '.');

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
            'pembelian', 'penjualan', 'hpp_penjualan', 'beban_organisasi',
            'beban_umum', 'beban_lain_lain', 'jasa_unit_konsumsi',
            'pendapatan_lain_lain', 'pendapatan_tanah_kavling',
            'piutang_khusus', 'beban_pajak_belum_dibayar', 'pajak',
            'jasa_simp_mana_suka',
        ];

        foreach ($fields as $field) {
            // hitung N. Percobaan D
            // Neraca Awal D + N. Perubahan D
            $nPercobaanD = ($neracaAwal->neracaAwalD->{'neraca_awal_d_'.$field} ?? 0)
                        + ($nPerubahan->nPerubahanD->{'n_perubahan_d_'.$field} ?? 0);
    
            // hitung N. Percobaan K
            // Neraca Awal K + N. Perubahan K
            $nPercobaanK = ($neracaAwal->neracaAwalK->{'neraca_awal_k_'.$field} ?? 0)
                        + ($nPerubahan->nPerubahanK->{'n_perubahan_k_'.$field} ?? 0);
    
            // hitung N. Saldo
            $nSaldo = $nPercobaanD - $nPercobaanK;
    
            if ($nSaldo > 0) {
                // nSaldo > 0 masuk D
                $nSaldoD = $nSaldo;
                $nSaldoK = 0;
    
                // hitung nsPenyesuaianD
                // nSaldoD + A. Penyesuaian D - nSaldoK - A. Penyesuaian K
                $nsPenyesuaianD = $nSaldoD
                                + ($aPenyesuaian->aPenyesuaianD->{'a_penyesuaian_d_'.$field} ?? 0)
                                - $nSaldoK
                                - ($aPenyesuaian->aPenyesuaianK->{'a_penyesuaian_k_'.$field} ?? 0);
    
                $nsPenyesuaianK = 0;

                // Cek ada Rugi dan Laba D > 0 di database
                $rugiDanLabaD = ($rugiLaba->rugiDanLabaD->{'rugi_dan_laba_d_'.$field} ?? 0);

                if ($rugiDanLabaD == 0) {
                    // Rugi dan Laba D = nsPenyesuaianD
                    $rugiDanLabaD = 0;
                    $rugiDanLabaK = 0;
                }
    
                // hitung Neraca D
                // Neraca D = nsPenyesuaianD + Rugi dan Laba D
                $neracaD = $nsPenyesuaianD + $rugiDanLabaD;
                $neracaK = 0;
            } else {
                // nSaldo <= 0 masuk K
                $nSaldoD = 0;
                $nSaldoK = abs($nSaldo);
    
                // hitung nsPenyesuaianK
                // nSaldoK + A. Penyesuaian K - nSaldoD - A
                $nsPenyesuaianD = 0;

                $nsPenyesuaianK = $nSaldoK
                                + ($aPenyesuaian->aPenyesuaianK->{'a_penyesuaian_k_'.$field} ?? 0)
                                - $nSaldoD
                                - ($aPenyesuaian->aPenyesuaianD->{'a_penyesuaian_d_'.$field} ?? 0);

                // Cek ada Rugi dan Laba K > 0 di database
                $rugiDanLabaK = ($rugiLaba->rugiDanLabaK->{'rugi_dan_laba_k_'.$field} ?? 0);
                
                if ($rugiDanLabaK == 0) {
                    // Rugi dan Laba K = nsPenyesuaianK
                    $rugiDanLabaD = 0;
                    $rugiDanLabaK = 0;
                }
    
                // hitung Neraca K
                // Neraca K = nsPenyesuaianK + Rugi dan Laba K
                $neracaD = 0;
                $neracaK = $nsPenyesuaianK + $rugiDanLabaK;
            }
    
            // show di blade
            $this->{'neraca_awal_d_'.$field} = "Rp " . number_format($neracaD, 0, ',', '.');
            $this->{'neraca_awal_k_'.$field} = "Rp " . number_format($neracaK, 0, ',', '.');
        }
    }

    private function getNPerubahanKas()
    {
        // N. Perubahan Kas D
        $kasD = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas masuk')
            ->selectRaw('
                COALESCE(SUM(pokok),0) +
                COALESCE(SUM(wajib),0) +
                COALESCE(SUM(manasuka),0) +
                COALESCE(SUM(wajib_pinjam),0) +
                COALESCE(SUM(qurban),0) +
                COALESCE(SUM(angsuran),0) +
                COALESCE(SUM(jasa),0) +
                COALESCE(SUM(js_admin),0) +
                COALESCE(SUM(lain_lain),0) +
                COALESCE(SUM(barang_kons),0) +
                COALESCE(SUM(piutang),0) +
                COALESCE(SUM(hutang),0) +
                COALESCE(SUM(hari_lembur),0) +
                COALESCE(SUM(perjalanan_pengawas),0) +
                COALESCE(SUM(thr),0) +
                COALESCE(SUM(admin),0) +
                COALESCE(SUM(iuran_dekopinda),0) +
                COALESCE(SUM(honor_pengurus),0) +
                COALESCE(SUM(rkrab),0) +
                COALESCE(SUM(pembinaan),0) +
                COALESCE(SUM(harkop),0) +
                COALESCE(SUM(dandik),0) +
                COALESCE(SUM(rapat),0) +
                COALESCE(SUM(jasa_manasuka),0) +
                COALESCE(SUM(pajak),0) +
                COALESCE(SUM(tabungan_qurban),0) +
                COALESCE(SUM(dekopinda),0) +
                COALESCE(SUM(wajib_pkpri),0) +
                COALESCE(SUM(dansos),0) +
                COALESCE(SUM(shu),0) +
                COALESCE(SUM(dana_pengurus),0) +
                COALESCE(SUM(dana_kesejahteraan),0) +
                COALESCE(SUM(pembayaran_listrik_dan_air),0) +
                COALESCE(SUM(tnh_kav),0)
                as total
            ')
            ->value('total');
            
        $this->n_perubahan_d_kas = "Rp " . number_format($kasD, 0, ',', '.');

        // N. Perubahan Kas K
        $kasK = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas keluar')
            ->selectRaw('
                COALESCE(SUM(pokok),0) +
                COALESCE(SUM(wajib),0) +
                COALESCE(SUM(manasuka),0) +
                COALESCE(SUM(wajib_pinjam),0) +
                COALESCE(SUM(qurban),0) +
                COALESCE(SUM(angsuran),0) +
                COALESCE(SUM(lain_lain),0) +
                COALESCE(SUM(piutang),0) +
                COALESCE(SUM(hutang),0) +
                COALESCE(SUM(hari_lembur),0) +
                COALESCE(SUM(perjalanan_pengawas),0) +
                COALESCE(SUM(thr),0) +
                COALESCE(SUM(admin),0) +
                COALESCE(SUM(iuran_dekopinda),0) +
                COALESCE(SUM(honor_pengurus),0) +
                COALESCE(SUM(rkrab),0) +
                COALESCE(SUM(pembinaan),0) +
                COALESCE(SUM(harkop),0) +
                COALESCE(SUM(dandik),0) +
                COALESCE(SUM(rapat),0) +
                COALESCE(SUM(jasa_manasuka),0) +
                COALESCE(SUM(pajak),0) +
                COALESCE(SUM(tabungan_qurban),0) +
                COALESCE(SUM(dekopinda),0) +
                COALESCE(SUM(wajib_pkpri),0) +
                COALESCE(SUM(dansos),0) +
                COALESCE(SUM(shu),0) +
                COALESCE(SUM(dana_pengurus),0) +
                COALESCE(SUM(dana_kesejahteraan),0) +
                COALESCE(SUM(pembayaran_listrik_dan_air),0) +
                COALESCE(SUM(tnh_kav),0)
                as total
            ')
            ->value('total');
        
        $this->n_perubahan_k_kas = "Rp " . number_format($kasK, 0, ',', '.');
    }

    private function getNPerubahanPiutang()
    {
        // N. Perubahan Piutang D
        $piutangD = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas masuk')
            ->sum('angsuran');

        $this->n_perubahan_d_piutang = "Rp " . number_format($piutangD, 0, ',', '.');

        // N. Perubahan Piutang K
        $piutangK = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas keluar')
            ->sum('hutang');

        $this->n_perubahan_k_piutang = "Rp " . number_format($piutangK, 0, ',', '.');
    }

    private function getNPerubahanTabunganQurban()
    {
        // N. Perubahan Tabungan Qurban K
        $tabunganQurbanD = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas masuk')
            ->sum('qurban');

        $this->n_perubahan_d_tabungan_qurban = "Rp " . number_format($tabunganQurbanD, 0, ',', '.');

        // N. Perubahan Tabungan Qurban K
        $tabunganQurbanK = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas keluar')
            ->sum('qurban');
        
        $this->n_perubahan_k_tabungan_qurban = "Rp " . number_format($tabunganQurbanK, 0, ',', '.');
    }

    private function getNPerubahanSimpananKhususSWP()
    {
        // N. Perubahan Simpanan Khusus SWP D
        $simpananKhususSwpD = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas masuk')
            ->sum('wajib_pinjam');

        $this->n_perubahan_d_simpanan_khusus_swp = "Rp " . number_format($simpananKhususSwpD, 0, ',', '.');

        // N. Perubahan Simpanan Khusus SWP K
        $simpananKhususSwpK = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas keluar')
            ->sum('wajib_pinjam');
        
        $this->n_perubahan_k_simpanan_khusus_swp = "Rp " . number_format($simpananKhususSwpK, 0, ',', '.');
    }

    private function getNPerubahanSimpananManasuka()
    {
        // N. Perubahan Simpanan Manasuka D
        $simpananManasukaD = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas masuk')
            ->sum('manasuka');

        $this->n_perubahan_d_simpanan_manasuka = "Rp " . number_format($simpananManasukaD, 0, ',', '.');

        // N. Perubahan Simpanan Manasuka K
        $simpananManasukaK = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas keluar')
            ->sum('manasuka');

        $this->n_perubahan_k_simpanan_manasuka = "Rp " . number_format($simpananManasukaK, 0, ',', '.');
    }

    private function getNPerubahanSimpananPokokAnggota()
    {
        // N. Perubahan Simpanan Pokok Anggota D
        $simpananPokokD = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas masuk')
            ->sum('pokok');

        $this->n_perubahan_d_simpanan_pokok_anggota = "Rp " . number_format($simpananPokokD, 0, ',', '.');

        // N. Perubahan Simpanan Pokok Anggota K
        $simpananPokokK = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas keluar')
            ->sum('pokok');

        $this->n_perubahan_k_simpanan_pokok_anggota = "Rp " . number_format($simpananPokokK, 0, ',', '.');
    }

    private function getNPerubahanSimpananWajibAnggota()
    {
        // N. Perubahan Simpanan Wajib Anggota D
        $simpananWajibD = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas masuk')
            ->sum('wajib');

        $this->n_perubahan_d_simpanan_wajib_anggota = "Rp " . number_format($simpananWajibD, 0, ',', '.');

        // N. Perubahan Simpanan Wajib Anggota K
        $simpananWajibK = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas keluar')
            ->sum('wajib');

        $this->n_perubahan_k_simpanan_wajib_anggota = "Rp " . number_format($simpananWajibK, 0, ',', '.');
    }

    private function getNPerubahanJasaDariAnggota()
    {
        // N. Perubahan Jasa dari Anggota D
        $jasaDariAnggotaD = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas masuk')
            ->sum('jasa');

        $this->n_perubahan_d_jasa_dari_anggota = "Rp " . number_format($jasaDariAnggotaD, 0, ',', '.');

        // N. Perubahan Jasa dari Anggota K
        // $jasaDariAnggotaK = KasHarian::whereYear('tanggal', $this->tahun)
        //     ->where('jenis_transaksi', 'kas keluar')
        //     ->sum('jasa');

        // $this->n_perubahan_k_jasa_dari_anggota = "Rp " . number_format($jasaDariAnggotaK, 0, ',', '.');
    }

    private function getNPerubahanJasaAdministrasi()
    {
        // N. Perubahan Jasa Administrasi D
        $jasaAdministrasiD = KasHarian::whereYear('tanggal', $this->tahun)
            ->where('jenis_transaksi', 'kas masuk')
            ->sum('js_admin');

        $this->n_perubahan_d_jasa_administrasi = "Rp " . number_format($jasaAdministrasiD, 0, ',', '.');

        // N. Perubahan Jasa Administrasi K
        // $jasaAdministrasiK = KasHarian::whereYear('tanggal', $this->tahun)
        //     ->where('jenis_transaksi', 'kas keluar')
        //     ->sum('js_admin');

        // $this->n_perubahan_k_jasa_administrasi = "Rp " . number_format($jasaAdministrasiK, 0, ',', '.');
    }

    private function hitungNeracaAwalD()
    {
        /*
        $this->neraca_awal_d = 
            $this->neraca_awal_d_kas +
            $this->neraca_awal_d_bank +
            $this->neraca_awal_d_piutang +
            $this->neraca_awal_d_piutang_tanah +
            $this->neraca_awal_d_piutang_lain_pada_anggota +
            $this->neraca_awal_d_piutang_barang +
            $this->neraca_awal_d_persediaan_barang +
            $this->neraca_awal_d_persediaan_peralatan +
            $this->neraca_awal_d_akumulasi_peny_peralatan +
            $this->neraca_awal_d_pendapatan_ymh_diterima +
            $this->neraca_awal_d_simpanan_manasuka_pkpri +
            $this->neraca_awal_d_tabungan_di_pkpri +
            $this->neraca_awal_d_simpanan_pokok_pkpri +
            $this->neraca_awal_d_simpanan_wajib_pkpri +
            $this->neraca_awal_d_simp_khusus_pkpri +
            $this->neraca_awal_d_simp_khusus_swp +
            $this->neraca_awal_d_skpb +
            $this->neraca_awal_d_penyertaan_di_hotel_pkpri +
            $this->neraca_awal_d_penyertaan_di_kopen +
            $this->neraca_awal_d_penyertaan_unit_konsumsi +
            $this->neraca_awal_d_tanah +
            $this->neraca_awal_d_kewajiban_titipan +
            $this->neraca_awal_d_biaya_yang_masih_harus_dibayar +
            $this->neraca_awal_d_jasa_partisipasi +
            $this->neraca_awal_d_dana_pengurus +
            $this->neraca_awal_d_dana_karyawan +
            $this->neraca_awal_d_dana_pendidikan +
            $this->neraca_awal_d_dana_sosial +
            $this->neraca_awal_d_utang_ke_pkpri_atau_bni +
            $this->neraca_awal_d_tabungan_qurban +
            $this->neraca_awal_d_simpanan_khusus_swp +
            $this->neraca_awal_d_simpanan_manasuka +
            $this->neraca_awal_d_donasi +  
            $this->neraca_awal_d_simpanan_pokok_anggota +
            $this->neraca_awal_d_jasa_dari_anggota +
            $this->neraca_awal_d_cadangan +
            $this->neraca_awal_d_shu +
            $this->neraca_awal_d_jasa_dari_anggota +
            $this->neraca_awal_d_jasa_administrasi +
            $this->neraca_awal_d_pembelian +
            $this->neraca_awal_d_penjualan +
            $this->neraca_awal_d_hpp_penjualan +
            $this->neraca_awal_d_beban_organisasi +
            $this->neraca_awal_d_beban_operasional +
            $this->neraca_awal_d_beban_umum +
            $this->neraca_awal_d_beban_lain_lain +
            $this->neraca_awal_d_jasa_unit_konsumsi +
            $this->neraca_awal_d_pendapatan_lain_lain +
            $this->neraca_awal_d_pendapatan_tanah_kavling +
            $this->neraca_awal_d_piutang_khusus +
            $this->neraca_awal_d_beban_pajak_belum_dibayar +
            $this->neraca_awal_d_pajak +
            $this->neraca_awal_d_jasa_simp_mana_suka;
        */

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

    private function checkDisabled()
    {
        if ($this->disabledErrorTahun) {
            $this->disabled = true;
        } else {
            $this->disabled = false;
        }
    }

    public function render()
    {
        return view('livewire.form-create-perhitungan-neraca');
    }
}
