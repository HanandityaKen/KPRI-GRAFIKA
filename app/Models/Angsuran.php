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
    ];
}
