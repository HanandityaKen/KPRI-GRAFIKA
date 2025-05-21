<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NamaKoperasi extends Model
{
    protected $table = 'nama_koperasi';

    protected $fillable = [
        'nama',
    ];
}
