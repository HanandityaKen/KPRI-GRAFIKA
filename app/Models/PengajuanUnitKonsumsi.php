<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanUnitKonsumsi extends Model
{
    protected $table = 'pengajuan_unit_konsumsi';

    protected $fillable = [
        'anggota_id',
        'tanggal',
        'nama_anggota',
        'nama_barang',
        'nominal',
        'lama_angsuran',
        'nominal_bunga',
        'nominal_pokok',
        'jumlah_nominal',
        'requested_by',
        'status',
        'reviewed_by',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function unit_konsumsi()
    {
        return $this->hasMany(UnitKonsumsi::class);
    }
}
