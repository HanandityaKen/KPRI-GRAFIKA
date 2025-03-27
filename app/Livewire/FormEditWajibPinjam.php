<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\WajibPinjam;

class FormEditWajibPinjam extends Component
{
    public $wajibPinjam;
    public $nominal;
    public $disabled = false;
    public $error_nominal = '';

    public function mount($id)
    {
        $this->wajibPinjam = WajibPinjam::findOrFail($id);
        $this->nominal = $this->wajibPinjam->nominal;
    }

    public function updatedNominal()
    {
        $nominal = (int) str_replace(['Rp', '.', ','], '', $this->nominal);

        if (WajibPinjam::where('nominal', $nominal)
            ->where('id', '!=', $this->wajibPinjam->id)
            ->exists()) {
            $this->error_nominal = '* Nominal sudah digunakan';
            $this->disabled = true;
            return;
        }

        $this->error_nominal = '';
        $this->disabled = false;
    }

    public function render()
    {
        return view('livewire.form-edit-wajib-pinjam');
    }
}
