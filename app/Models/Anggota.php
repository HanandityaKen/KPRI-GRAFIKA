<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'id',
        'no_anggota',
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

    public function kas_harian()
    {
        return $this->hasMany(KasHarian::class);
    }

    public function simpanan()
    {
        return $this->hasOne(Simpanan::class, 'anggota_id');
    }
}
