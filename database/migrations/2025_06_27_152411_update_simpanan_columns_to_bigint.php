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
            $table->bigInteger('pokok')->change();
            $table->bigInteger('wajib')->change();
            $table->bigInteger('manasuka')->change();
            $table->bigInteger('wajib_pinjam')->change();
            $table->bigInteger('qurban')->change();
            $table->bigInteger('total')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simpanan', function (Blueprint $table) {
            $table->integer('pokok')->change();
            $table->integer('wajib')->change();
            $table->integer('manasuka')->change();
            $table->integer('wajib_pinjam')->change();
            $table->integer('qurban')->change();
            $table->integer('total')->change();
        });
    }
};
