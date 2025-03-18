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
        Schema::table('angsuran_pinjaman', function (Blueprint $table) {
            $table->integer('kas_harian_id')->nullable()->after('pinjaman_id');
            $table->integer('kurang_jasa')->after('kas_harian_id');

            $table->dropColumn('angsuran_ke');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('angsuran_pinjaman', function (Blueprint $table) {
            $table->dropColumn('kas_harian_id');
            $table->dropColumn('kurang_jasa');
            $table->integer('angsuran_ke')->after('sisa_angsuran');
        });
    }
};
