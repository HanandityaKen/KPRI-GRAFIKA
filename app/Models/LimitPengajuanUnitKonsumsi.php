<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LimitPengajuanUnitKonsumsi extends Model
{
    protected $table = 'limit_pengajuan_unit_konsumsi';

    protected $fillable = [
        'id',
        'limit',
    ];
}
