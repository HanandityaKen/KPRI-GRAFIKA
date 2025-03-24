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
        Schema::create('angsuran_unit_konsumsi', function (Blueprint $table) {
            $table->id();
            $table->integer('unit_konsumsi_id');
            $table->integer('kas_harian_id')->nullable();
            $table->integer('kurang_jasa');
            $table->integer('kurang_angsuran');
            $table->integer('tunggakan')->default(0);
            $table->integer('angsuran_ke')->default(0);
            $table->integer('sisa_angsuran')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angsuran_unit_konsumsi');
    }
};
