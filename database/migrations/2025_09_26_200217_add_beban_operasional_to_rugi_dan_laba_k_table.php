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
        Schema::table('rugi_dan_laba_k', function (Blueprint $table) {
            $table->bigInteger('rugi_dan_laba_k_beban_operasional')->after('rugi_dan_laba_k_beban_organisasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rugi_dan_laba_k', function (Blueprint $table) {
            $table->dropColumn('rugi_dan_laba_k_beban_operasional');
        });
    }
};
