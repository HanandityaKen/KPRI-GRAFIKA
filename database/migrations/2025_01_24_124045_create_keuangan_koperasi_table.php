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
        Schema::create('keuangan_koperasi', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->decimal('total_simpanan', 10, 2);
            $table->decimal('total_pinjaman', 10, 2);
            $table->decimal('total_shu', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan_koperasi');
    }
};
