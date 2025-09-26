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
        Schema::table('n_perubahan_k', function (Blueprint $table) {
            $table->bigInteger('n_perubahan_k_beban_operasional')->after('n_perubahan_k_beban_organisasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('n_perubahan_k', function (Blueprint $table) {
            $table->dropColumn('n_perubahan_k_beban_operasional');
        });
    }
};
