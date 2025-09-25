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
        Schema::create('perhitungan_neraca', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->bigInteger('jumlah_neraca_awal_d');
            $table->bigInteger('jumlah_neraca_awal_k');
            $table->bigInteger('jumlah_n_perubahan_d');
            $table->bigInteger('jumlah_n_perubahan_k');
            $table->bigInteger('jumlah_a_penyesuaian_d');
            $table->bigInteger('jumlah_a_penyesuaian_k');
            $table->bigInteger('jumlah_rugi_dan_laba_d');
            $table->bigInteger('jumlah_rugi_dan_laba_k');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perhitungan_neraca');
    }
};
