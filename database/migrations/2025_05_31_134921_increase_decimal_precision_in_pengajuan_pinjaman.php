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
        Schema::table('pengajuan_pinjaman', function (Blueprint $table) {
            $table->decimal('jumlah_pinjaman', 15, 2)->change();
            $table->decimal('biaya_admin', 15, 2)->change();
            $table->decimal('total_pinjaman', 15, 2)->change();
            $table->decimal('nominal_pokok', 15, 2)->change();
            $table->decimal('nominal_bunga', 15, 2)->change();
            $table->decimal('nominal_angsuran', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_pinjaman', function (Blueprint $table) {
            $table->decimal('jumlah_pinjaman', 10, 2)->change();
            $table->decimal('biaya_admin', 10, 2)->change();
            $table->decimal('total_pinjaman', 10, 2)->change();
            $table->decimal('nominal_pokok', 10, 2)->change();
            $table->decimal('nominal_bunga', 10, 2)->change();
            $table->decimal('nominal_angsuran', 10, 2)->change();
        });
    }
};
