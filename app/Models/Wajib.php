<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wajib extends Model
{
    protected $table = "wajib";

    protected $fillable = [
        'id',
        'jenis_pegawai',
        'nominal'
    ];
}
