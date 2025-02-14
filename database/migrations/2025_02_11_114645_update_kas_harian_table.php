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
            $table->dropColumn('nama_transaksi');
            $table->dropColumn('jumlah');
            
            $table->integer('pokok')->default(0)->after('tanggal');
            $table->integer('wajib')->default(0)->after('pokok');
            $table->integer('manasuka')->default(0)->after('wajib');
            $table->integer('wajib_pinjam')->default(0)->after('manasuka');
            $table->integer('qurban')->default(0)->after('wajib_pinjam');
            $table->integer('angsuran')->default(0)->after('qurban');
            $table->integer('jasa')->default(0)->after('angsuran');
            $table->integer('js_admin')->default(0)->after('jasa');
            $table->integer('lain_lain')->default(0)->after('js_admin');
            $table->integer('barang_kons')->default(0)->after('lain_lain');
            $table->integer('piutang')->default(0)->after('barang_kons');
            $table->integer('hutang')->default(0)->after('piutang');
            $table->integer('b_umum')->default(0)->after('hutang');
            $table->integer('b_orgns')->default(0)->after('b_umum');
            $table->integer('b_oprs')->default(0)->after('b_orgns');
            $table->integer('b_lain')->default(0)->after('b_oprs');
            $table->integer('tnh_kav')->default(0)->after('b_lain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kas_harian', function (Blueprint $table) {
            $table->dropColumn([
                'pokok', 'wajib', 'manasuka', 'wajib_pinjam', 'qurban', 'angsuran',
                'jasa', 'js_admin', 'lain_lain', 'barang_kons', 'piutang', 'hutang',
                'b_umum', 'b_orgns', 'b_oprs', 'b_lain', 'tnh_kav'
            ]);

            // Tambahkan kembali kolom nama_transaksi
            $table->enum('nama_transaksi', ['pokok', 'wajib', 'manasuka', 'wajib pinjam', 'qurban', 'angsuran', 'jasa', 'jasa admin', 'lain-lain']);
        });
    }
};
