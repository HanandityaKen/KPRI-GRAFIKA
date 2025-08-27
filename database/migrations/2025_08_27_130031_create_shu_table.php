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
        Schema::create('shu', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->bigInteger('jasa_dari_anggota');
            $table->bigInteger('unit_konsumsi');
            $table->bigInteger('jasa_skpb');
            $table->bigInteger('jasa_administrasi');
            $table->bigInteger('shu_kpri');
            $table->bigInteger('sewa_rumah');
            $table->bigInteger('jasa_tanah_kopling');
            $table->bigInteger('jasa_lain_lain');
            $table->bigInteger('jumlah_pendapatan');
            $table->bigInteger('beban_organisasi');
            $table->bigInteger('beban_operasional');
            $table->bigInteger('beban_umum');
            $table->bigInteger('beban_lain_lain');
            $table->bigInteger('jumlah_beban');
            $table->bigInteger('shu_sebelum_pajak');
            $table->bigInteger('pajak');
            $table->bigInteger('jumlah_shu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shu');
    }
};
