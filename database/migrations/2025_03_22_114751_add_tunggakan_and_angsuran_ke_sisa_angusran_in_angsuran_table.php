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
            $table->integer('tunggakan')->default(0)->after('kurang_angsuran'); 
            $table->integer('angsuran_ke')->default(0)->after('tunggakan'); 
            $table->integer('sisa_angsuran')->default(0)->after('angsuran_ke'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('angsuran_pinjaman', function (Blueprint $table) {
            $table->dropColumn(['tunggakan', 'angsuran_ke', 'sisa_angsuran']);
        });
    }
};
