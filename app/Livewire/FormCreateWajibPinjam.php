<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\WajibPinjam;

class FormCreateWajibPinjam extends Component
{
    public $nominal = '';
    public $disabled = false;
    public $error_nominal = '';


    public function updatedNominal()
    {
        $nominal = (int) str_replace(['Rp', '.', ','], '', $this->nominal);

        if (WajibPinjam::where('nominal', $nominal)->exists()) {
            $this->error_nominal = '* Nominal sudah ada';
            $this->disabled = true;
            return;
        }

        $this->error_nominal = '';
        $this->disabled = false;
    }

    public function render()
    {
        return view('livewire.form-create-wajib-pinjam');
    }
}
