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

    public function render()
    {
        return view('livewire.form-create-kas-harian');
    }
}
