<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\KasHarian;

class FormEditKasHarian extends Component
{
    public $kasHarian;
    public $namaList = [];

    public function mount($id)
    {
        $this->kasHarian = KasHarian::findOrFail($id);
        $this->namaList = Anggota::pluck('nama', 'id')->toArray();
    }

    public function render()
    {
        return view('livewire.pengurus.form-edit-kas-harian');
    }
}
