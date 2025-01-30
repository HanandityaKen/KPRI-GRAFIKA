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
        Schema::create('pembagian_shu', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->integer('anggota_id');
            $table->decimal('jasa_simpanan', 10, 2);
            $table->decimal('jasa_partisipasi', 10, 2);
            $table->decimal('jumlah_diterima', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembagian_shu');
    }
};
