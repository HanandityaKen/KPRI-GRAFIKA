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
        Schema::create('a_penyesuaian_d', function (Blueprint $table) {
            $table->id();
            $table->integer('perhitungan_neraca_id');
            $table->bigInteger('a_penyesuaian_d_kas');
            $table->bigInteger('a_penyesuaian_d_bank');
            $table->bigInteger('a_penyesuaian_d_piutang');
            $table->bigInteger('a_penyesuaian_d_piutang_tanah');
            $table->bigInteger('a_penyesuaian_d_piutang_lain_pada_anggota');
            $table->bigInteger('a_penyesuaian_d_penyisihan_piutang');
            $table->bigInteger('a_penyesuaian_d_piutang_barang');
            $table->bigInteger('a_penyesuaian_d_persediaan_barang');
            $table->bigInteger('a_penyesuaian_d_persediaan_peralatan');
            $table->bigInteger('a_penyesuaian_d_akumulasi_peny_peralatan');
            $table->bigInteger('a_penyesuaian_d_pendapatan_ymh_diterima');
            $table->bigInteger('a_penyesuaian_d_simpanan_manasuka_pkpri');
            $table->bigInteger('a_penyesuaian_d_tabungan_di_pkpri');
            $table->bigInteger('a_penyesuaian_d_simpanan_pokok_pkpri');
            $table->bigInteger('a_penyesuaian_d_simpanan_wajib_pkpri');
            $table->bigInteger('a_penyesuaian_d_simp_khusus_pkpri');
            $table->bigInteger('a_penyesuaian_d_simp_khusus_swp');
            $table->bigInteger('a_penyesuaian_d_skpb');
            $table->bigInteger('a_penyesuaian_d_penyertaan_di_hotel_pkpri');
            $table->bigInteger('a_penyesuaian_d_penyertaan_di_kopen');
            $table->bigInteger('a_penyesuaian_d_penyertaan_unit_konsumsi');
            $table->bigInteger('a_penyesuaian_d_tanah');
            $table->bigInteger('a_penyesuaian_d_kewajiban_titipan');
            $table->bigInteger('a_penyesuaian_d_biaya_yang_masih_harus_dibayar');
            $table->bigInteger('a_penyesuaian_d_jasa_partisipasi');
            $table->bigInteger('a_penyesuaian_d_dana_pengurus');
            $table->bigInteger('a_penyesuaian_d_dana_karyawan');
            $table->bigInteger('a_penyesuaian_d_dana_pendidikan');
            $table->bigInteger('a_penyesuaian_d_dana_sosial');
            $table->bigInteger('a_penyesuaian_d_utang_ke_pkpri_atau_bni');
            $table->bigInteger('a_penyesuaian_d_tabungan_qurban');
            $table->bigInteger('a_penyesuaian_d_simpanan_khusus_swp');
            $table->bigInteger('a_penyesuaian_d_simpanan_manasuka');
            $table->bigInteger('a_penyesuaian_d_donasi');
            $table->bigInteger('a_penyesuaian_d_simpanan_pokok_anggota');
            $table->bigInteger('a_penyesuaian_d_simpanan_wajib_anggota');
            $table->bigInteger('a_penyesuaian_d_cadangan');
            $table->bigInteger('a_penyesuaian_d_shu');
            $table->bigInteger('a_penyesuaian_d_jasa_dari_anggota');
            $table->bigInteger('a_penyesuaian_d_jasa_administrasi');
            $table->bigInteger('a_penyesuaian_d_pembelian');
            $table->bigInteger('a_penyesuaian_d_penjualan');
            $table->bigInteger('a_penyesuaian_d_hpp_penjualan');
            $table->bigInteger('a_penyesuaian_d_beban_organisasi');
            $table->bigInteger('a_penyesuaian_d_beban_umum');
            $table->bigInteger('a_penyesuaian_d_beban_lain_lain');
            $table->bigInteger('a_penyesuaian_d_jasa_unit_konsumsi');
            $table->bigInteger('a_penyesuaian_d_pendapatan_lain_lain');
            $table->bigInteger('a_penyesuaian_d_pendapatan_tanah_kavling');
            $table->bigInteger('a_penyesuaian_d_piutang_khusus');
            $table->bigInteger('a_penyesuaian_d_beban_pajak_belum_dibayar');
            $table->bigInteger('a_penyesuaian_d_pajak');
            $table->bigInteger('a_penyesuaian_d_jasa_simp_mana_suka');
            $table->bigInteger('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_penyesuaian_d');
    }
};
