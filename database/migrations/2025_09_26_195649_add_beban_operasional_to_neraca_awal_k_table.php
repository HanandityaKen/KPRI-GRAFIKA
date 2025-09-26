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
        Schema::table('neraca_awal_k', function (Blueprint $table) {
            $table->bigInteger('neraca_awal_k_beban_operasional')->after('neraca_awal_k_beban_organisasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('neraca_awal_k', function (Blueprint $table) {
            $table->dropColumn('neraca_awal_k_beban_operasional');
        });
    }
};
