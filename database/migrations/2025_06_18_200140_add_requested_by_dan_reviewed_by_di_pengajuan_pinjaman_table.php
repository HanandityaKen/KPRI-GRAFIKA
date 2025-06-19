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
        Schema::table('pengajuan_pinjaman', function (Blueprint $table) {
            $table->dropColumn('pengurus_id'); // Hapus kolom lama
            $table->string('requested_by')->nullable()->after('nominal_angsuran'); // Tambah kolom baru
            $table->string('reviewed_by')->nullable()->after('status'); // Kolom untuk reviewer
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_pinjaman', function (Blueprint $table) {
            $table->integer('pengurus_id')->nullable()->after('nama_anggota');
            $table->dropColumn(['requested_by', 'reviewed_by']);
        });
    }
};
