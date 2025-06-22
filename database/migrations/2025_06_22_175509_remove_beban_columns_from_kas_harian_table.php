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
        Schema::table('kas_harian', function (Blueprint $table) {
            $table->dropColumn([
                'b_umum',
                'b_oprs',
                'b_orgns',
                'b_lain',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kas_harian', function (Blueprint $table) {
            $table->decimal('b_umum', 15, 2)->nullable();
            $table->decimal('b_oprs', 15, 2)->nullable();
            $table->decimal('b_orgns', 15, 2)->nullable();
            $table->decimal('b_lain', 15, 2)->nullable();
        });
    }
};
