<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Anggota extends Authenticatable
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
        'jenis_pegawai',
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

    public function pengajuan_pinjaman()
    {
        return $this->hasMany(PengajuanPinjaman::class);
    }

    public function pengajuan_unit_konsumsi()
    {
        return $this->hasMany(PengajuanUnitKonsumsi::class);
    }

}
