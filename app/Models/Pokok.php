<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokok extends Model
{
    protected $table = 'pokok';

    protected $fillable = [
        'nominal',
    ];
}
