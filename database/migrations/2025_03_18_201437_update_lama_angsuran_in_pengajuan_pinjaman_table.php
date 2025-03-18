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
            $table->dropColumn('lama_angsuran');
            $table->string('lama_angsuran')->after('total_pinjaman'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_pinjaman', function (Blueprint $table) {
            $table->dropColumn('lama_angsuran');
            $table->enum('lama_angsuran', ['3 bulan', '6 bulan', '12 bulan', '24 bulan', '36 bulan', '48 bulan', '60 bulan'])->default('3 bulan');
        });
    }
};
