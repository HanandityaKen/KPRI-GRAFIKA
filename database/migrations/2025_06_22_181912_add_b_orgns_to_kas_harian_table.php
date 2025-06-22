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
            $table->integer('rkrab')->default(0)->after('iuran_dekopinda');
            $table->integer('pembinaan')->default(0)->after('rkrab');
            $table->integer('harkop')->default(0)->after('pembinaan');
            $table->integer('dandik')->default(0)->after('harkop');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kas_harian', function (Blueprint $table) {
            $table->dropColumn([
                'rkrab',
                'pembinaan',
                'harkop',
                'dandik',
            ]);
        });
    }
};
