<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerhitunganNeraca extends Model
{
    protected $table = 'perhitungan_neraca';

    protected $fillable = [
        'tahun',
        'jumlah_neraca_awal_d',
        'jumlah_neraca_awal_k',
        'jumlah_n_perubahan_d',
        'jumlah_n_perubahan_k',
        'jumlah_a_penyesuaian_d',
        'jumlah_a_penyesuaian_k',
        'jumlah_rugi_dan_laba_d',
        'jumlah_rugi_dan_laba_k',
    ];

    public function neracaAwalD()
    {
        return $this->hasOne(NeracaAwalD::class);
    }

    public function neracaAwalK()
    {
        return $this->hasOne(NeracaAwalK::class);
    }

    public function nPerubahanD()
    {
        return $this->hasOne(NPerubahanD::class);
    }

    public function nPerubahanK()
    {
        return $this->hasOne(NPerubahanK::class);
    }

    public function aPenyesuaianD()
    {
        return $this->hasOne(APenyesuaianD::class);
    }

    public function aPenyesuaianK()
    {
        return $this->hasOne(APenyesuaianK::class);
    }

    public function rugiDanLabaD()
    {
        return $this->hasOne(RugiDanLabaD::class);
    }

    public function rugiDanLabaK()
    {
        return $this->hasOne(RugiDanLabaK::class);
    }
}
