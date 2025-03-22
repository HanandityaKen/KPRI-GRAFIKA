<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    protected $table = 'angsuran_pinjaman';

    protected $fillable = [
        'pinjaman_id',
        'kas_harian_id',
        'kurang_jasa',
        'kurang_angsuran',
        'tunggakan',
        'angsuran_ke',
        'sisa_angsuran',
    ];

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class,'pinjaman_id');
    }

    public function kas_harian()
    {
        return $this->belongsTo(KasHarian::class,'kas_harian_id');
    }
}
