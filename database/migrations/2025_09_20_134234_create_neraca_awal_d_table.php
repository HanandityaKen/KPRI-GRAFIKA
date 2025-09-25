<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('neraca_awal_d', function (Blueprint $table) {
            $table->id();
            $table->integer('perhitungan_neraca_id');
            $table->bigInteger('neraca_awal_d_kas');
            $table->bigInteger('neraca_awal_d_bank');
            $table->bigInteger('neraca_awal_d_piutang');
            $table->bigInteger('neraca_awal_d_piutang_tanah');
            $table->bigInteger('neraca_awal_d_piutang_lain_pada_anggota');
            $table->bigInteger('neraca_awal_d_penyisihan_piutang');
            $table->bigInteger('neraca_awal_d_piutang_barang');
            $table->bigInteger('neraca_awal_d_persediaan_barang');
            $table->bigInteger('neraca_awal_d_persediaan_peralatan');
            $table->bigInteger('neraca_awal_d_akumulasi_peny_peralatan');
            $table->bigInteger('neraca_awal_d_pendapatan_ymh_diterima');
            $table->bigInteger('neraca_awal_d_simpanan_manasuka_pkpri');
            $table->bigInteger('neraca_awal_d_tabungan_di_pkpri');
            $table->bigInteger('neraca_awal_d_simpanan_pokok_pkpri');
            $table->bigInteger('neraca_awal_d_simpanan_wajib_pkpri');
            $table->bigInteger('neraca_awal_d_simp_khusus_pkpri');
            $table->bigInteger('neraca_awal_d_simp_khusus_swp');
            $table->bigInteger('neraca_awal_d_skpb');
            $table->bigInteger('neraca_awal_d_penyertaan_di_hotel_pkpri');
            $table->bigInteger('neraca_awal_d_penyertaan_di_kopen');
            $table->bigInteger('neraca_awal_d_penyertaan_unit_konsumsi');
            $table->bigInteger('neraca_awal_d_tanah');
            $table->bigInteger('neraca_awal_d_kewajiban_titipan');
            $table->bigInteger('neraca_awal_d_biaya_yang_masih_harus_dibayar');
            $table->bigInteger('neraca_awal_d_jasa_partisipasi');
            $table->bigInteger('neraca_awal_d_dana_pengurus');
            $table->bigInteger('neraca_awal_d_dana_karyawan');
            $table->bigInteger('neraca_awal_d_dana_pendidikan');
            $table->bigInteger('neraca_awal_d_dana_sosial');
            $table->bigInteger('neraca_awal_d_utang_ke_pkpri_atau_bni');
            $table->bigInteger('neraca_awal_d_tabungan_qurban');
            $table->bigInteger('neraca_awal_d_simpanan_khusus_swp');
            $table->bigInteger('neraca_awal_d_simpanan_manasuka');
            $table->bigInteger('neraca_awal_d_donasi');
            $table->bigInteger('neraca_awal_d_simpanan_pokok_anggota');
            $table->bigInteger('neraca_awal_d_simpanan_wajib_anggota');
            $table->bigInteger('neraca_awal_d_cadangan');
            $table->bigInteger('neraca_awal_d_shu');
            $table->bigInteger('neraca_awal_d_jasa_dari_anggota');
            $table->bigInteger('neraca_awal_d_jasa_administrasi');
            $table->bigInteger('neraca_awal_d_pembelian');
            $table->bigInteger('neraca_awal_d_penjualan');
            $table->bigInteger('neraca_awal_d_hpp_penjualan');
            $table->bigInteger('neraca_awal_d_beban_organisasi');
            $table->bigInteger('neraca_awal_d_beban_umum');
            $table->bigInteger('neraca_awal_d_beban_lain_lain');
            $table->bigInteger('neraca_awal_d_jasa_unit_konsumsi');
            $table->bigInteger('neraca_awal_d_pendapatan_lain_lain');
            $table->bigInteger('neraca_awal_d_pendapatan_tanah_kavling');
            $table->bigInteger('neraca_awal_d_piutang_khusus');
            $table->bigInteger('neraca_awal_d_beban_pajak_belum_dibayar');
            $table->bigInteger('neraca_awal_d_pajak');
            $table->bigInteger('neraca_awal_d_jasa_simp_mana_suka');
            $table->bigInteger('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neraca_awal_d');
    }
};
