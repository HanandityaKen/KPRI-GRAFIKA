<?php

namespace App\Livewire;

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
    public $wajibList = [];
    public $wajibPinjamList = [];

    public function mount($id)
    {
        $this->kasHarian = KasHarian::findOrFail($id);
        $this->namaList = Anggota::pluck('nama', 'id')->toArray();
        $this->anggota_id = $this->kasHarian->anggota_id;

        $this->wajibList = Wajib::orderBy('nominal', 'desc')->pluck('nominal', 'id')->toArray();
        $this->wajibPinjamList = WajibPinjam::orderBy('nominal', 'asc')->pluck('nominal', 'id')->toArray();
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
        return view('livewire.form-edit-kas-harian');
    }
}
