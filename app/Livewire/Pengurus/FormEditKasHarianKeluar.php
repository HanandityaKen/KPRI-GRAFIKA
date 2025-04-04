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

    public $selectedWajib = '';
    public $manasuka = '';
    public $qurban = '';
    public $lain_lain = '';

    public $b_umum = '';
    public $b_orgns = '';
    public $b_oprs = '';
    public $b_lain = '';
    public $tnh_kav = '';

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

        $this->selectedWajib = $this->kasHarian->wajib;
        $this->manasuka = $this->kasHarian->manasuka;
        $this->qurban = $this->kasHarian->qurban;
        $this->lain_lain = $this->kasHarian->lain_lain;

        $this->b_umum = $this->kasHarian->b_umum;
        $this->b_orgns = $this->kasHarian->b_orgns;
        $this->b_oprs = $this->kasHarian->b_oprs;
        $this->b_lain = $this->kasHarian->b_lain;
        $this->tnh_kav = $this->kasHarian->tnh_kav;

        $anggota = Anggota::find($this->anggota_id);
        $this->bendahara = $anggota && $anggota->jabatan === 'bendahara';

        $this->wajibOption = [0, $this->kasHarian->wajib];
        
        $this->checkDisabled();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'anggota_id') {
            $this->getBendahara();
        }

        $this->checkDisabled();
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

    public function updatedSelectedWajib()
    {
        $this->checkDisabled();
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

    public function updatedLainLain() 
    { 
        $this->checkDisabled(); 
    }

    public function updatedBUmum() 
    {
        $this->checkDisabled(); 
    }

    public function updatedBOrgns() 
    { 
        $this->checkDisabled(); 
    }

    public function updatedBOprs() 
    { 
        $this->checkDisabled(); 
    }

    public function updatedBLain() 
    { 
        $this->checkDisabled(); 
    }

    public function updatedTnhKav() 
    { 
        $this->checkDisabled(); 
    }

    public function checkDisabled()
    {
        $qurban     = (int) str_replace(['Rp', '.', ','], '', $this->qurban);
        $manasuka   = (int) str_replace(['Rp', '.', ','], '', $this->manasuka);
        $lain_lain  = (int) str_replace(['Rp', '.', ','], '', $this->lain_lain);
        $wajib      = (int) $this->selectedWajib;

        // Biaya tambahan khusus bendahara
        $b_umum     = (int) str_replace(['Rp', '.', ','], '', $this->b_umum);
        $b_orgns    = (int) str_replace(['Rp', '.', ','], '', $this->b_orgns);
        $b_oprs     = (int) str_replace(['Rp', '.', ','], '', $this->b_oprs);
        $b_lain     = (int) str_replace(['Rp', '.', ','], '', $this->b_lain);
        $tnh_kav    = (int) str_replace(['Rp', '.', ','], '', $this->tnh_kav);

        $hasValidationError = $this->disabled_qurban || $this->disabled_manasuka;

        $isAllZero = $qurban === 0 &&
                    $manasuka === 0 &&
                    $lain_lain === 0 &&
                    $wajib === 0 &&
                    (!$this->bendahara || (
                        $b_umum === 0 &&
                        $b_orgns === 0 &&
                        $b_oprs === 0 &&
                        $b_lain === 0 &&
                        $tnh_kav === 0
                    ));

        $this->disabled = $hasValidationError || $isAllZero;
    }
    
    public function render()
    {
        return view('livewire.pengurus.form-edit-kas-harian-keluar');
    }
}
