<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\Simpanan;

class FormCreateKasHarian extends Component
{
    public $namaList = [];
    public $anggota_id = '';
    public $pokok = '';

    public function mount()
    {
        $this->namaList = Anggota::pluck('nama', 'id');
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'anggota_id') {
            $this->getPokok();
        }
    }

    public function getPokok()
    {
        if ($this->anggota_id) {
            $kasHarian = Simpanan::where('anggota_id', $this->anggota_id)->latest()->first();
    
            if ($kasHarian && $kasHarian->pokok > 0) {
                $this->pokok = 'Rp 0';
            } else {
                $this->pokok = 'Rp ' . number_format(300000, 0, ',', '.');
            }
    
            return;
        }
    
        $this->pokok = 'Rp ' . number_format(300000, 0, ',', '.');
    }

    public function render()
    {
        return view('livewire.form-create-kas-harian');
    }
}
