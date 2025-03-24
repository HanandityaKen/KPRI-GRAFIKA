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
        Schema::create('pengajuan_unit_konsumsi', function (Blueprint $table) {
            $table->id();
            $table->integer('anggota_id');
            $table->integer('pengurus_id');
            $table->string('nama_barang');
            $table->integer('nominal');
            $table->string('lama_angsuran');
            $table->integer('nominal_bunga');
            $table->integer('nominal_pokok');
            $table->integer('jumlah_nominal');
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_unit_konsumsi');
    }
};
