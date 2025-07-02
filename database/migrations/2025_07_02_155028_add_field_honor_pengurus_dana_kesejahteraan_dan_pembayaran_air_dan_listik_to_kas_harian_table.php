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
            $table->bigInteger('honor_pengurus')->default(0)->after('iuran_dekopinda');
            $table->bigInteger('dana_kesejahteraan')->default(0)->after('dana_pengurus');
            $table->bigInteger('pembayaran_listrik_dan_air')->default(0)->after('dana_kesejahteraan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kas_harian', function (Blueprint $table) {
            $table->dropColumn([
                'honor_pengurus',
                'dana_kesejahteraan',
                'pembayaran_listrik_dan_air',
            ]);
        });
    }
};
