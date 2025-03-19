<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanPinjaman extends Model
{
    protected $table = 'pengajuan_pinjaman';

    protected $fillable = [
        'anggota_id',
        'pengurus_id',
        'jumlah_pinjaman',
        'biaya_admin',
        'total_pinjaman',
        'lama_angsuran',
        'nominal_pokok',
        'nominal_bunga',
        'nominal_angsuran',
        'status',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class);
    }
}
