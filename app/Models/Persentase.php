<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persentase extends Model
{
    protected $table = 'persentase';

    protected $fillable = [
        'id',
        'nama',
        'persentase',
        'created_at',
        'updated_at',
    ];
}
