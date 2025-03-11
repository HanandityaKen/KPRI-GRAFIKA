<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasHarian extends Model
{
    protected $table = 'kas_harian';

    protected $fillable = [
        'anggota_id',
        'jenis_transaksi',
        'tanggal',
        'pokok',
        'wajib',
        'manasuka',
        'wajib_pinjam',
        'qurban',
        'angsuran',
        'jasa',
        'js_admin',
        'lain_lain',
        'barang_kons',
        'piutang',
        'hutang',
        'b_umum',
        'b_orgns',
        'b_oprs',
        'b_lain',
        'tnh_kav',
        'keterangan',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($kasHarian) {
            $kasHarian->jkm()->delete();
            $kasHarian->jkk()->delete();
            
            $saldo = Saldo::first();

            if ($saldo) {
                $jumlah = 
                    ($kasHarian->pokok ?? 0) + 
                    ($kasHarian->wajib ?? 0) + 
                    ($kasHarian->manasuka ?? 0) + 
                    ($kasHarian->wajib_pinjam ?? 0) + 
                    ($kasHarian->qurban ?? 0) + 
                    ($kasHarian->angsuran ?? 0) + 
                    ($kasHarian->jasa ?? 0) + 
                    ($kasHarian->js_admin ?? 0) + 
                    ($kasHarian->lain_lain ?? 0) + 
                    ($kasHarian->barang_kons ?? 0) + 
                    ($kasHarian->piutang ?? 0) + 
                    ($kasHarian->hutang ?? 0) + 
                    ($kasHarian->b_umum ?? 0) + 
                    ($kasHarian->b_orgns ?? 0) + 
                    ($kasHarian->b_oprs ?? 0) + 
                    ($kasHarian->b_lain ?? 0) + 
                    ($kasHarian->tnh_kav ?? 0);

                if ($kasHarian->jenis_transaksi === 'kas masuk') {
                    // Pastikan saldo tidak negatif
                    $saldo->update(['saldo' => max(0, $saldo->saldo - $jumlah)]);
                } elseif ($kasHarian->jenis_transaksi === 'kas keluar') {
                    $saldo->increment('saldo', $jumlah);
                }
            }

            
        });

        static::updating(function ($kasHarian) {
            // Opsional: Tambahkan logika jika ingin memperbarui data terkait
        });
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function jkm()
    {
        return $this->hasMany(Jkm::class);
    }

    public function jkk()
    {
        return $this->hasMany(Jkk::class);
    }

    public function simpanan()
    {
        return $this->hasOne(Simpanan::class, 'anggota_id', 'anggota_id');
    }
}
