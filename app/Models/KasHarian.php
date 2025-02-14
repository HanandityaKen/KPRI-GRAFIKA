<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasHarian extends Model
{
    protected $table = 'kas_harian';

    protected $fillable = [
        'anggota_id',
        'jenis_transaksi',
        'tanggal',
        'pokok',
        'wajib',
        'manasuka',
        'wajib_pinjam',
        'qurban',
        'angsuran',
        'jasa',
        'js_admin',
        'lain_lain',
        'barang_kons',
        'piutang',
        'hutang',
        'b_umum',
        'b_orgns',
        'b_oprs',
        'b_lain',
        'tnh_kav',
        'keterangan',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($kasHarian) {
            // Menghapus data terkait di jkm dan jkk
            $kasHarian->jkm()->delete();
            $kasHarian->jkk()->delete();
        });

        static::updating(function ($kasHarian) {
            // Opsional: Tambahkan logika jika ingin memperbarui data terkait
        });
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function jkm()
    {
        return $this->hasMany(Jkm::class);
    }

    public function jkk()
    {
        return $this->hasMany(Jkk::class);
    }
}
