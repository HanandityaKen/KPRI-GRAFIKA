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
            $table->integer('hari_lembur')->default(0)->after('hutang');
            $table->integer('perjalanan_pengawas')->default(0)->after('hari_lembur');
            $table->integer('thr')->default(0)->after('perjalanan_pengawas');
            $table->integer('admin')->default(0)->after('thr');
            $table->integer('iuran_dekopinda')->default(0)->after('admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kas_harian', function (Blueprint $table) {
            $table->dropColumn([
                'hari_lembur',
                'perjalanan_pengawas',
                'thr',
                'admin',
                'iuran_dekopinda',
            ]);
        });
    }
};
