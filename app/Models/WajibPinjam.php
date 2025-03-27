<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WajibPinjam extends Model
{
    protected $table = 'wajib_pinjam';

    protected $fillable = [
        'nominal'
    ];
}
