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
        Schema::create('simpanan', function (Blueprint $table) {
            $table->id();
            $table->integer('anggota_id');
            $table->integer('kas_harian_id')->nullable(); 
            $table->integer('pokok');
            $table->integer('wajib');
            $table->integer('manasuka');
            $table->integer('wajib_pinjam');
            $table->integer('qurban');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simpanan');
    }
};
