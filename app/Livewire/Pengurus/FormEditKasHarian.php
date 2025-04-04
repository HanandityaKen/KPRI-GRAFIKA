<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\KasHarian;
use App\Models\Simpanan;
use App\Models\Pokok;
use App\Models\Wajib;
use App\Models\WajibPinjam;

class FormEditKasHarian extends Component
{
    public $kasHarian;
    public $namaList = [];
    public $anggota_id = '';
    public $pokok = '';
    public $wajibOptions = [];
    public $wajibPinjamList = [];
    public $selectedWajib = '';
    public $selectedWajibPinjam = '';
    public $qurban = '';
    public $manasuka = '';
    public $lain_lain = '';

    public $disabled = false;

    public function mount($id)
    {
        $this->kasHarian = KasHarian::findOrFail($id);
        $this->namaList = Anggota::pluck('nama', 'id')->toArray();
        $this->anggota_id = $this->kasHarian->anggota_id;

        $this->pokok = $this->kasHarian->pokok;
        $this->selectedWajib = $this->kasHarian->wajib;
        $this->selectedWajibPinjam = $this->kasHarian->wajib_pinjam;
        $this->qurban = $this->kasHarian->qurban;
        $this->manasuka = $this->kasHarian->manasuka;
        $this->lain_lain = $this->kasHarian->lain_lain;

        $this->wajibPinjamList = WajibPinjam::orderBy('nominal', 'asc')->pluck('nominal', 'id')->toArray();

        $this->getWajib();

        $this->disabled();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'anggota_id') {
            $this->getWajib();
            $this->getPokok();
        }

        $this->disabled();
    }

    public function getWajib()
    {
        $anggota = Anggota::find($this->anggota_id);

        if ($anggota) {
            $this->wajibOptions = Wajib::where('jenis_pegawai', $anggota->jenis_pegawai)
                ->orderBy('nominal', 'desc')
                ->pluck('nominal')
                ->toArray();
        } else {
            $this->wajibOptions = [];
        }
    }

    public function getPokok()
    {
        if ($this->anggota_id) {
            $kasHarian = Simpanan::where('anggota_id', $this->anggota_id)->latest()->first();
            $pokok = Pokok::first();
    
            if ($kasHarian && $kasHarian->pokok > 0) {
                $this->pokok = 'Rp 0';
            } else {
                $this->pokok = 'Rp ' . number_format($pokok->nominal, 0, ',', '.');
            }
    
            return;
        }
    
        $this->pokok = 'Rp ' . number_format($pokok->nominal, 0, ',', '.');
    }

    public function disabled()
    {
        $wajib = (int) str_replace(['Rp', '.', ','], '', $this->selectedWajib);
        $manasuka = (int) str_replace(['Rp', '.', ','], '', $this->manasuka);
        $wajibPinjam = (int) str_replace(['Rp', '.', ','], '', $this->selectedWajibPinjam);
        $qurban = (int) str_replace(['Rp', '.', ','], '', $this->qurban);
        $lain_lain = (int) str_replace(['Rp', '.', ','], '', $this->lain_lain);

        // dd($pokok, $manasuka, $wajib, $wajibPinjam, $qurban, $lain_lain);

        if ($manasuka === 0 && $wajib === 0 && $wajibPinjam === 0 && $qurban === 0 && $lain_lain === 0) {
            $this->disabled = true;
        } else {
            $this->disabled = false;
        }
    }

    public function render()
    {
        return view('livewire.pengurus.form-edit-kas-harian');
    }
}
