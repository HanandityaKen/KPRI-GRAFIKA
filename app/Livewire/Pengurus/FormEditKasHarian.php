<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\KasHarian;
use App\Models\Simpanan;

class FormEditKasHarian extends Component
{
    public $kasHarian;
    public $namaList = [];
    public $anggota_id = '';

    public function mount($id)
    {
        $this->kasHarian = KasHarian::findOrFail($id);
        $this->namaList = Anggota::pluck('nama', 'id')->toArray();
        $this->anggota_id = $this->kasHarian->anggota_id;
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
        return view('livewire.pengurus.form-edit-kas-harian');
    }
}
