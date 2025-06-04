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

    public function pengajuan_pinjaman()
    {
        return $this->belongsTo(PengajuanPinjaman::class, 'pengajuan_pinjaman_id');
    }

    // public function kas_harian()
    // {
    //     return $this->belongsTo(KasHarian::class, 'kas_harian_id');
    // }

    public function kas_harian()
    {
        return $this->hasOne(KasHarian::class, 'pinjaman_id');
    }

    public function angsuran()
    {
        return $this->hasMany(Angsuran::class);
    }
}
