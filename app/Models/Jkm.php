<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jkm extends Model
{
    protected $table = 'jkm';

    protected $fillable = [
        'id',
        'kas_harian_id',
        'bulan',
        'tahun',
    ];

    public function kas_harian()
    {
        return $this->belongsTo(KasHarian::class, 'kas_harian_id');
    }
}
