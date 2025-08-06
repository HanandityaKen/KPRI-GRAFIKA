<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatTabunganQurban extends Model
{
    protected $table = 'riwayat_tabungan_qurban';

    protected $fillable = [
        'anggota_id',
        'kas_harian_id',
        'jumlah',
        'tanggal',
    ];

    public function kas_harian()
    {
        return $this->belongsTo(KasHarian::class);
    }
}
