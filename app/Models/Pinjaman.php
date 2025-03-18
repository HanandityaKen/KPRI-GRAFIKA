<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';

    protected $fillable = [
        'pengajuan_pinjaman_id',
        'kas_harian_id',
        'status',
    ];
}
