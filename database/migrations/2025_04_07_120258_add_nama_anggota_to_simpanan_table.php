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
        Schema::table('simpanan', function (Blueprint $table) {
            $table->integer('no_anggota')->nullable()->after('anggota_id');
            $table->string('nama_anggota')->nullable()->after('no_anggota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simpanan', function (Blueprint $table) {
            $table->dropColumn('no_anggota');
            $table->dropColumn('nama_anggota');
        });
    }
};
