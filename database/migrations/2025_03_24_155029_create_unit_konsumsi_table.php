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
        Schema::create('unit_konsumsi', function (Blueprint $table) {
            $table->id();
            $table->integer('pengajuan_unit_konsumsi_id');
            $table->integer('kas_harian_id');
            $table->enum('status', ['dalam pembayaran', 'lunas'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_konsumsi');
    }
};
