<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\KasHarian;
use App\Models\Angsuran;

class FormBayarAngsuran extends Component
{
    public $angsuran;
    public $angsuranManual = '';
    public $error_angsuran_manual;
    public $disabled = false;
    public $jasa = 0;


    public function mount($id)
    {
        $this->angsuran = Angsuran::findOrFail($id);
        $this->cekJasa();
    }

    public function updatedAngsuranManual()
    {
        $angsuranManual = (int) str_replace(['Rp', '.', ','], '', $this->angsuranManual);
        $kurangAngsuran = Angsuran::where('id', $this->angsuran->id)->value('kurang_angsuran');
        $tunggakan = Angsuran::where('id', $this->angsuran->id)->value('tunggakan');

        // dd($angsuranManual, $kurangAngsuran, $tunggakan);

        if ($angsuranManual > $kurangAngsuran + $tunggakan) {
            $this->error_angsuran_manual = '* Angsuran manual tidak boleh lebih besar dari kurang angsuran! (Maks: Rp ' . number_format($kurangAngsuran + $tunggakan, 0, ',', '.') . ')';
            $this->disabled = true;
        } else {
            $this->error_angsuran_manual = '';
            $this->disabled = false;
        }
    }

    public function cekJasa()
    {   
        $pinjamanId = $this->angsuran->pinjaman->id;

        $cekKasHarian = KasHarian::where('pinjaman_id', $pinjamanId)
            ->where('jenis_transaksi', 'kas masuk')
            ->where('keterangan', 'Bayar Angsuran Pinjaman')
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->first();
    
        if ($cekKasHarian) {
            // Sudah bayar di bulan ini
            $this->jasa = "Rp " . number_format(0, 0, ',', '.');
        } else {
            // Belum bayar di bulan ini
            $this->jasa = "Rp " . number_format($this->angsuran->pinjaman->pengajuan_pinjaman->nominal_bunga, 0, ',', '.');
        }
    }

    public function render()
    {
        return view('livewire.pengurus.form-bayar-angsuran');
    }
}
