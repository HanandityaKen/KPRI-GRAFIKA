<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jkk extends Model
{
    protected $table = 'jkk';

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
