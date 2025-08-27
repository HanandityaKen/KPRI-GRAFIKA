<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shu extends Model
{
    protected $table = 'shu';

    protected $fillable = [
        'id',
        'tahun',
        'jasa_dari_anggota',
        'unit_konsumsi',
        'jasa_skpb',
        'jasa_administrasi',
        'shu_kpri',
        'sewa_rumah',
        'jasa_tanah_kopling',
        'jasa_lain_lain',
        'jumlah_pendapatan',
        'beban_organisasi',
        'beban_operasional',
        'beban_umum',
        'beban_lain_lain',
        'jumlah_beban',
        'shu_sebelum_pajak',
        'pajak',
        'jumlah_shu',
    ];
}
