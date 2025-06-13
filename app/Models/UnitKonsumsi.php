<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitKonsumsi extends Model
{
    protected $table = "unit_konsumsi";

    protected $fillable = [
        'pengajuan_unit_konsumsi_id',
        'kas_harian_id',
        'status',
    ];

    public function pengajuan_unit_konsumsi()
    {
        return $this->belongsTo(PengajuanUnitKonsumsi::class, 'pengajuan_unit_konsumsi_id');
    }

    // public function kas_harian()
    // {
    //     return $this->belongsTo(KasHarian::class, 'kas_harian_id');
    // }

    public function kas_harian()
    {
        return $this->hasOne(KasHarian::class, 'unit_konsumsi_id');
    }

    public function angsuran_unit_konsumsi()
    {
        return $this->hasMany(AngsuranUnitKonsumsi::class);
    }
}
