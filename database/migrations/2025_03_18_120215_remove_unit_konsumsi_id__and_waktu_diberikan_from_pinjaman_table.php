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
        Schema::table('pinjaman', function (Blueprint $table) {
            $table->dropColumn(['unit_konsumsi_id', 'waktu_diberikan']);
            $table->enum('status', ['dalam pembayaran', 'lunas'])->nullable()->change();

            $table->integer('kas_harian_id')->nullable()->after('pengajuan_pinjaman_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pinjaman', function (Blueprint $table) {
            $table->integer('unit_konsumsi_id');
            $table->date('waktu_diberikan');
            $table->enum('status', ['disetujui', 'ditolak', 'lunas'])->nullable()->change();
            $table->dropColumn('kas_harian_id');
        });
    }
};
