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
        Schema::create('rugi_dan_laba_k', function (Blueprint $table) {
            $table->id();
            $table->integer('perhitungan_neraca_id');
            $table->bigInteger('rugi_dan_laba_k_kas');
            $table->bigInteger('rugi_dan_laba_k_bank');
            $table->bigInteger('rugi_dan_laba_k_piutang');
            $table->bigInteger('rugi_dan_laba_k_piutang_tanah');
            $table->bigInteger('rugi_dan_laba_k_piutang_lain_pada_anggota');
            $table->bigInteger('rugi_dan_laba_k_penyisihan_piutang');
            $table->bigInteger('rugi_dan_laba_k_piutang_barang');
            $table->bigInteger('rugi_dan_laba_k_persediaan_barang');
            $table->bigInteger('rugi_dan_laba_k_persediaan_peralatan');
            $table->bigInteger('rugi_dan_laba_k_akumulasi_peny_peralatan');
            $table->bigInteger('rugi_dan_laba_k_pendapatan_ymh_diterima');
            $table->bigInteger('rugi_dan_laba_k_simpanan_manasuka_pkpri');
            $table->bigInteger('rugi_dan_laba_k_tabungan_di_pkpri');
            $table->bigInteger('rugi_dan_laba_k_simpanan_pokok_pkpri');
            $table->bigInteger('rugi_dan_laba_k_simpanan_wajib_pkpri');
            $table->bigInteger('rugi_dan_laba_k_simp_khusus_pkpri');
            $table->bigInteger('rugi_dan_laba_k_simp_khusus_swp');
            $table->bigInteger('rugi_dan_laba_k_skpb');
            $table->bigInteger('rugi_dan_laba_k_penyertaan_di_hotel_pkpri');
            $table->bigInteger('rugi_dan_laba_k_penyertaan_di_kopen');
            $table->bigInteger('rugi_dan_laba_k_penyertaan_unit_konsumsi');
            $table->bigInteger('rugi_dan_laba_k_tanah');
            $table->bigInteger('rugi_dan_laba_k_kewajiban_titipan');
            $table->bigInteger('rugi_dan_laba_k_biaya_yang_masih_harus_dibayar');
            $table->bigInteger('rugi_dan_laba_k_jasa_partisipasi');
            $table->bigInteger('rugi_dan_laba_k_dana_pengurus');
            $table->bigInteger('rugi_dan_laba_k_dana_karyawan');
            $table->bigInteger('rugi_dan_laba_k_dana_pendidikan');
            $table->bigInteger('rugi_dan_laba_k_dana_sosial');
            $table->bigInteger('rugi_dan_laba_k_utang_ke_pkpri_atau_bni');
            $table->bigInteger('rugi_dan_laba_k_tabungan_qurban');
            $table->bigInteger('rugi_dan_laba_k_simpanan_khusus_swp');
            $table->bigInteger('rugi_dan_laba_k_simpanan_manasuka');
            $table->bigInteger('rugi_dan_laba_k_donasi');
            $table->bigInteger('rugi_dan_laba_k_simpanan_pokok_anggota');
            $table->bigInteger('rugi_dan_laba_k_simpanan_wajib_anggota');
            $table->bigInteger('rugi_dan_laba_k_cadangan');
            $table->bigInteger('rugi_dan_laba_k_shu');
            $table->bigInteger('rugi_dan_laba_k_jasa_dari_anggota');
            $table->bigInteger('rugi_dan_laba_k_jasa_administrasi');
            $table->bigInteger('rugi_dan_laba_k_pembelian');
            $table->bigInteger('rugi_dan_laba_k_penjualan');
            $table->bigInteger('rugi_dan_laba_k_hpp_penjualan');
            $table->bigInteger('rugi_dan_laba_k_beban_organisasi');
            $table->bigInteger('rugi_dan_laba_k_beban_umum');
            $table->bigInteger('rugi_dan_laba_k_beban_lain_lain');
            $table->bigInteger('rugi_dan_laba_k_jasa_unit_konsumsi');
            $table->bigInteger('rugi_dan_laba_k_pendapatan_lain_lain');
            $table->bigInteger('rugi_dan_laba_k_pendapatan_tanah_kavling');
            $table->bigInteger('rugi_dan_laba_k_piutang_khusus');
            $table->bigInteger('rugi_dan_laba_k_beban_pajak_belum_dibayar');
            $table->bigInteger('rugi_dan_laba_k_pajak');
            $table->bigInteger('rugi_dan_laba_k_jasa_simp_mana_suka');
            $table->bigInteger('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rugi_dan_laba_k');
    }
};
