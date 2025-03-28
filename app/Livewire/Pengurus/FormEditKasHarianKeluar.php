<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\KasHarian;
use App\Models\Simpanan;
use App\Models\Pokok;
use App\Models\Wajib;

class FormEditKasHarianKeluar extends Component
{
    public $kasHarian;
    public $namaList = [];
    public $anggota_id = '';
    public $bendahara = false;

    public $qurban = '';
    public $manasuka = '';
    public $error_qurban;
    public $error_manasuka;
    public $disabled = false;
    public $disabled_qurban = false;
    public $disabled_manasuka = false;

    public $wajibOption = [];

    public function mount($id)
    {
        $this->kasHarian = KasHarian::findOrFail($id);
        $this->namaList = Anggota::pluck('nama', 'id')->toArray();
        $this->anggota_id = $this->kasHarian->anggota_id;

        $this->manasuka = $this->kasHarian->manasuka;
        $this->qurban = $this->kasHarian->qurban;

        $anggota = Anggota::find($this->anggota_id);
        $this->bendahara = $anggota && $anggota->jabatan === 'bendahara';

        $this->wajibOption = [0, $this->kasHarian->wajib];
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'anggota_id') {
            $this->getBendahara();
        }
    }

    public function getBendahara()
    {
        if ($this->anggota_id) {
            $anggota = Anggota::find($this->anggota_id);

            $this->bendahara = $anggota && $anggota->jabatan === 'bendahara';
        } else {
            $this->bendahara = false;
        }
    }

    public function updatedQurban()
    {
        $qurban = (int) str_replace(['Rp', '.', ','], '', $this->qurban);
        $totalQurban = Simpanan::where('anggota_id', $this->anggota_id)->value('qurban');

        if ($qurban > $totalQurban) {
            $this->error_qurban = '* Simpanan qurban tidak cukup!';
            $this->disabled_qurban = true;
        } else {
            $this->error_qurban = '';
            $this->disabled_qurban = false;
        }

        $this->checkDisabled();
    }

    public function updatedManasuka()
    {
        $manasuka = (int) str_replace(['Rp', '.', ','], '', $this->manasuka);
        $totalManasuka = Simpanan::where('anggota_id', $this->anggota_id)->value('manasuka');

        if ($manasuka > $totalManasuka) {
            $this->error_manasuka = '* Simpanan manasuka tidak cukup!';
            $this->disabled_manasuka = true;
        } else {
            $this->error_manasuka = '';
            $this->disabled_manasuka = false;
        }

        $this->checkDisabled();
    }

    public function checkDisabled()
    {
        if ($this->disabled_qurban || $this->disabled_manasuka) {
            $this->disabled = true;
        } else {
            $this->disabled = false;
        }
    }
    
    public function render()
    {
        return view('livewire.pengurus.form-edit-kas-harian-keluar');
    }
}
