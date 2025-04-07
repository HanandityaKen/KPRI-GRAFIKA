<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $table = 'simpanan';

    protected $fillable = [
        'id',
        'anggota_id',
        'no_anggota',
        'nama_anggota',
        'kas_harian_id',
        'pokok',
        'wajib',
        'manasuka',
        'wajib_pinjam',
        'qurban',
        'total',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function kas_harian()
    {
        return $this->belongsTo(KasHarian::class, 'kas_harian_id');
    }
}
