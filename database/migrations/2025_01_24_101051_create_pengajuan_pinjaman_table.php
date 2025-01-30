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
        Schema::create('pengajuan_pinjaman', function (Blueprint $table) {
            $table->id();
            $table->integer('anggota_id');
            $table->integer('pengurus_id');
            $table->integer('persentase_id');
            $table->decimal('jumlah_pinjaman', 10, 2);
            $table->decimal('biaya_admin', 10, 2);
            $table->decimal('total_pinjaman', 10, 2);
            $table->enum('lama_angsuran', ['3 bulan', '6 bulan', '12 bulan', '24 bulan', '36 bulan', '48 bulan', '60 bulan'])->default('3 bulan');;
            $table->decimal('nominal_pokok', 10, 2);
            $table->decimal('nominal_bunga', 10, 2);
            $table->decimal('nominal_angsuran', 10, 2);
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_pinjaman');
    }
};
