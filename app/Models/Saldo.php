<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    protected $table = 'saldo';

    protected $fillable = [
        'id',
        'saldo',
        'created_at',
        'updated_at',
    ];
}
