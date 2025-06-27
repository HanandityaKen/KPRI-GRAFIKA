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
        Schema::table('kas_harian', function (Blueprint $table) {
            $table->bigInteger('pokok')->default(0)->change();
            $table->bigInteger('wajib')->default(0)->change();
            $table->bigInteger('manasuka')->default(0)->change();
            $table->bigInteger('wajib_pinjam')->default(0)->change();
            $table->bigInteger('qurban')->default(0)->change();
            $table->bigInteger('angsuran')->default(0)->change();
            $table->bigInteger('jasa')->default(0)->change();
            $table->bigInteger('js_admin')->default(0)->change();
            $table->bigInteger('lain_lain')->default(0)->change();
            $table->bigInteger('barang_kons')->default(0)->change();
            $table->bigInteger('piutang')->default(0)->change();
            $table->bigInteger('hutang')->default(0)->change();
            $table->bigInteger('hari_lembur')->default(0)->change();
            $table->bigInteger('perjalanan_pengawas')->default(0)->change();
            $table->bigInteger('thr')->default(0)->change();
            $table->bigInteger('admin')->default(0)->change();
            $table->bigInteger('iuran_dekopinda')->default(0)->change();
            $table->bigInteger('rkrab')->default(0)->change();
            $table->bigInteger('pembinaan')->default(0)->change();
            $table->bigInteger('harkop')->default(0)->change();
            $table->bigInteger('dandik')->default(0)->change();
            $table->bigInteger('rapat')->default(0)->change();
            $table->bigInteger('jasa_manasuka')->default(0)->change();
            $table->bigInteger('pajak')->default(0)->change();
            $table->bigInteger('tabungan_qurban')->default(0)->change();
            $table->bigInteger('dekopinda')->default(0)->change();
            $table->bigInteger('wajib_pkpri')->default(0)->change();
            $table->bigInteger('dansos')->default(0)->change();
            $table->bigInteger('shu')->default(0)->change();
            $table->bigInteger('dana_pengurus')->default(0)->change();
            $table->bigInteger('tnh_kav')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kas_harian', function (Blueprint $table) {
        $table->integer('pokok')->default(0)->change();
        $table->integer('wajib')->default(0)->change();
        $table->integer('manasuka')->default(0)->change();
        $table->integer('wajib_pinjam')->default(0)->change();
        $table->integer('qurban')->default(0)->change();
        $table->integer('angsuran')->default(0)->change();
        $table->integer('jasa')->default(0)->change();
        $table->integer('js_admin')->default(0)->change();
        $table->integer('lain_lain')->default(0)->change();
        $table->integer('barang_kons')->default(0)->change();
        $table->integer('piutang')->default(0)->change();
        $table->integer('hutang')->default(0)->change();
        $table->integer('hari_lembur')->default(0)->change();
        $table->integer('perjalanan_pengawas')->default(0)->change();
        $table->integer('thr')->default(0)->change();
        $table->integer('admin')->default(0)->change();
        $table->integer('iuran_dekopinda')->default(0)->change();
        $table->integer('rkrab')->default(0)->change();
        $table->integer('pembinaan')->default(0)->change();
        $table->integer('harkop')->default(0)->change();
        $table->integer('dandik')->default(0)->change();
        $table->integer('rapat')->default(0)->change();
        $table->integer('jasa_manasuka')->default(0)->change();
        $table->integer('pajak')->default(0)->change();
        $table->integer('tabungan_qurban')->default(0)->change();
        $table->integer('dekopinda')->default(0)->change();
        $table->integer('wajib_pkpri')->default(0)->change();
        $table->integer('dansos')->default(0)->change();
        $table->integer('shu')->default(0)->change();
        $table->integer('dana_pengurus')->default(0)->change();
        $table->integer('tnh_kav')->default(0)->change();
        });
    }
};
