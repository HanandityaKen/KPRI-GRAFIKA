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
        Schema::create('kas_harian', function (Blueprint $table) {
            $table->id();
            $table->integer('anggota_id');
            $table->enum('nama_transaksi', ['pokok', 'wajib', 'manasuka', 'wajib pinjam', 'qurban', 'angsuran', 'jasa', 'jasa admin', 'lain-lain']);
            $table->enum('jenis_transaksi', ['kas masuk', 'kas keluar']);
            $table->timestamp('tanggal');
            $table->integer('jumlah');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas_harian');
    }
};
