<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasHarian extends Model
{
    protected $table = 'kas_harian';

    protected $fillable = [
        'anggota_id',
        'nama_anggota',
        'pinjaman_id',
        'unit_konsumsi_id',
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
        'hari_lembur',
        'perjalanan_pengawas',
        'thr',
        'admin',
        'iuran_dekopinda',
        'honor_pengurus',
        'rkrab',
        'pembinaan',
        'harkop',
        'dandik',
        'rapat',
        'jasa_manasuka',
        'pajak',
        'tabungan_qurban',
        'dekopinda',
        'wajib_pkpri',
        'dansos',
        'shu',
        'dana_pengurus',
        'dana_kesejahteraan',
        'pembayaran_listrik_dan_air',
        'tnh_kav',
        'keterangan',
        'created_by',
        'updated_by',
        'approved_by',
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
                    ($kasHarian->hari_lembur ?? 0) +
                    ($kasHarian->perjalanan_pengawas ?? 0) +
                    ($kasHarian->thr ?? 0) +
                    ($kasHarian->admin ?? 0) +
                    ($kasHarian->iuran_dekopinda ?? 0) +
                    ($kasHarian->honor_pengurus ?? 0) +
                    ($kasHarian->rkrab ?? 0) +
                    ($kasHarian->pembinaan ?? 0) +
                    ($kasHarian->harkop ?? 0) +
                    ($kasHarian->dandik ?? 0) +
                    ($kasHarian->rapat ?? 0) +
                    ($kasHarian->jasa_manasuka ?? 0) +
                    ($kasHarian->pajak ?? 0) +
                    ($kasHarian->tabungan_qurban ?? 0) +
                    ($kasHarian->dekopinda ?? 0) +
                    ($kasHarian->wajib_pkpri ?? 0) +
                    ($kasHarian->dansos ?? 0) +
                    ($kasHarian->shu ?? 0) +
                    ($kasHarian->dana_pengurus ?? 0) +
                    ($kasHarian->dana_kesejahteraan ?? 0) +
                    ($kasHarian->pembayaran_listrik_dan_air ?? 0) +
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

    // public function pinjaman()
    // {
    //     return $this->hasMany(Pinjaman::class);
    // }

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'pinjaman_id');
    }

    public function angsuran()
    {
        return $this->hasMany(Angsuran::class);
    }

    public function unit_konsumsi()
    {
        return $this->belongsTo(UnitKonsumsi::class, 'unit_konsumsi_id');
    }

    public function riwayat_tabungan_qurban()
    {
        return $this->hasMany(RiwayatTabunganQurban::class);
    }

    // public function unit_konsumsi()
    // {
    //     return $this->hasMany(UnitKonsumsi::class);
    // }

}
