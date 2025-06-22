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
            $table->integer('pajak')->default(0)->after('jasa_manasuka');
            $table->integer('tabungan_qurban')->default(0)->after('pajak');
            $table->integer('dekopinda')->default(0)->after('tabungan_qurban');
            $table->integer('wajib_pkpri')->default(0)->after('dekopinda');
            $table->integer('dansos')->default(0)->after('wajib_pkpri');
            $table->integer('shu')->default(0)->after('dansos');
            $table->integer('dana_pengurus')->default(0)->after('shu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kas_harian', function (Blueprint $table) {
            $table->dropColumn([
                'pajak',
                'tabungan_qurban',
                'dekopinda',
                'wajib_pkpri',
                'dansos',
                'shu',
                'dana_pengurus',
            ]);
        });
    }
};
