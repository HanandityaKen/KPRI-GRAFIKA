<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AngsuranUnitKonsumsi extends Model
{
    protected $table = 'angsuran_unit_konsumsi';

    protected $fillable = [
        'unit_konsumsi_id',
        'kas_harian_id',
        'kurang_jasa',
        'kurang_angsuran',
        'tunggakan',
        'angsuran_ke',
        'sisa_angsuran',
    ];

    public function unit_konsumsi()
    {
        return $this->belongsTo(UnitKonsumsi::class,'unit_konsumsi_id');
    }
}
