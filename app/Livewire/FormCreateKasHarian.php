<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\Pokok;
use App\Models\Wajib;
use App\Models\WajibPinjam;

class FormCreateKasHarian extends Component
{
    public $namaList = [];
    public $anggota_id = '';
    public $pokok = '';
    public $wajibOptions = [];
    public $wajibPinjamList = [];
    public $manasuka = '';
    public $qurban = '';
    public $wajibPinjam = '';
    public $wajib = '';
    public $lain_lain = '';

    public $disabled = false;
    public $disabled_pokok = false;
    public $disabled_wajib = false;
    public $disabled_manasuka = false;
    public $disabled_wajibPinjam = false;
    public $disabled_qurban = false;
    public $disabled_lain_lain = false;

    public function mount()
    {
        $this->namaList = Anggota::pluck('nama', 'id');
        $this->wajibPinjamList = WajibPinjam::orderBy('nominal', 'asc')->pluck('nominal', 'id');
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
    

    public function updatedPokok()
    {
        $pokok = (int) str_replace(['Rp', '.', ','], '', $this->pokok);

        if ($pokok === 0) {
            $this->disabled_pokok = true;
        } else {
            $this->disabled_pokok = false;
        }

        $this->disabled();
    }

    public function updatedWajib()
    {
        $wajib = (int) str_replace(['Rp', '.', ','], '', $this->wajib);

        if ($wajib === 0) {
            $this->disabled_wajib = true;
        } else {
            $this->disabled_wajib = false;
        }

        $this->disabled();
    }

    public function updatedManasuka()
    {
        $manasuka = (int) str_replace(['Rp', '.', ','], '', $this->manasuka);

        if ($manasuka === 0) {
            $this->disabled_manasuka = true;
        } else {
            $this->disabled_manasuka = false;
        }

        $this->disabled();
    }

    public function updatedWajibPinjam()
    {
        $wajibPinjam = (int) str_replace(['Rp', '.', ','], '', $this->wajibPinjam);

        if ($wajibPinjam === 0) {
            $this->disabled_wajibPinjam = true;
        } else {
            $this->disabled_wajibPinjam = false;
        }

        $this->disabled();
    }

    public function updatedQurban()
    {
        $qurban = (int) str_replace(['Rp', '.', ','], '', $this->qurban);

        if ($qurban === 0) {
            $this->disabled_qurban = true;
        } else {
            $this->disabled_qurban = false;
        }

        $this->disabled();
    }

    public function updatedLainLain()
    {
        $lain_lain = (int) str_replace(['Rp', '.', ','], '', $this->lain_lain);

        if ($lain_lain === 0) {
            $this->disabled_lain_lain = true;
        } else {
            $this->disabled_lain_lain = false;
        }

        $this->disabled();
    }

    public function disabled()
    {
        $pokok = (int) str_replace(['Rp', '.', ','], '', $this->pokok);
        $wajib = (int) str_replace(['Rp', '.', ','], '', $this->wajib);
        $manasuka = (int) str_replace(['Rp', '.', ','], '', $this->manasuka);
        $wajibPinjam = (int) str_replace(['Rp', '.', ','], '', $this->wajibPinjam);
        $qurban = (int) str_replace(['Rp', '.', ','], '', $this->qurban);
        $lain_lain = (int) str_replace(['Rp', '.', ','], '', $this->lain_lain);

        // dd($pokok, $manasuka, $wajib, $wajibPinjam, $qurban, $lain_lain);

        if ($pokok === 0 && $manasuka === 0 && $wajib === 0 && $wajibPinjam === 0 && $qurban === 0 && $lain_lain === 0) {
            $this->disabled = true;
        } else {
            $this->disabled = false;
        }
    }

    public function render()
    {
        return view('livewire.form-create-kas-harian');
    }
}
