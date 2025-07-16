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
        Schema::table('pengajuan_unit_konsumsi', function (Blueprint $table) {
            $table->date('tanggal')->nullable()->after('anggota_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_unit_konsumsi', function (Blueprint $table) {
            $table->dropColumn('tanggal');
        });
    }
};
