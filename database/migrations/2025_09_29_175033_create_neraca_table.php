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
        Schema::create('neraca', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->bigInteger('kas');
            $table->bigInteger('bank');
            $table->bigInteger('piutang');
            $table->bigInteger('piutang_tanah');
            $table->bigInteger('piutang_lain_pada_anggota');
            $table->bigInteger('penyisihan_piutang');
            $table->bigInteger('piutang_barang');
            $table->bigInteger('persediaan_barang');
            $table->bigInteger('persediaan_peralatan');
            $table->bigInteger('akumulasi_peny_peralatan');
            $table->bigInteger('pendapatan_ymh_diterima');
            $table->bigInteger('simpanan_manasuka_pkpri');
            $table->bigInteger('tabungan_di_pkpri');
            $table->bigInteger('simpanan_pokok_pkpri');
            $table->bigInteger('simpanan_wajib_pkpri');
            $table->bigInteger('simp_khusus_pkpri');
            $table->bigInteger('simp_khusus_swp');
            $table->bigInteger('skpb');
            $table->bigInteger('penyertaan_di_hotel_pkpri');
            $table->bigInteger('penyertaan_di_kopen');
            $table->bigInteger('penyertaan_unit_konsumsi');
            $table->bigInteger('tanah');
            $table->bigInteger('kewajiban_titipan');
            $table->bigInteger('biaya_yang_masih_harus_dibayar');
            $table->bigInteger('jasa_partisipasi');
            $table->bigInteger('dana_pengurus');
            $table->bigInteger('dana_karyawan');
            $table->bigInteger('dana_pendidikan');
            $table->bigInteger('dana_sosial');
            $table->bigInteger('utang_ke_pkpri_atau_bni');
            $table->bigInteger('tabungan_qurban');
            $table->bigInteger('simpanan_khusus_swp');
            $table->bigInteger('simpanan_manasuka');
            $table->bigInteger('donasi');
            $table->bigInteger('simpanan_pokok_anggota');
            $table->bigInteger('simpanan_wajib_anggota');
            $table->bigInteger('cadangan');
            $table->bigInteger('shu');
            $table->bigInteger('jasa_dari_anggota');
            $table->bigInteger('jasa_administrasi');
            $table->bigInteger('pembelian');
            $table->bigInteger('penjualan');
            $table->bigInteger('hpp_penjualan');
            $table->bigInteger('beban_organisasi');
            $table->bigInteger('beban_operasional');
            $table->bigInteger('beban_umum');
            $table->bigInteger('beban_lain_lain');
            $table->bigInteger('jasa_unit_konsumsi');
            $table->bigInteger('pendapatan_lain_lain');
            $table->bigInteger('pendapatan_tanah_kavling');
            $table->bigInteger('piutang_khusus');
            $table->bigInteger('beban_pajak_belum_dibayar');
            $table->bigInteger('pajak');
            $table->bigInteger('jasa_simp_mana_suka');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neraca');
    }
};
