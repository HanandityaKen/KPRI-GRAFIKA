<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'id',
        'nama',
        'email',
        'telepon',
        'foto_profile',
        'posisi',
        'jabatan',
        'password',
    ];

    protected $hidden = [
        'password'
    ];
}
