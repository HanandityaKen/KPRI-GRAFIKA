<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Wajib;

class FormCreateWajib extends Component
{
    public $jenis_pegawai = '';
    public $disabled = false;
    public $error_jenis_pegawai = '';

    public function updatedJenisPegawai()
    {
        $jenis_pegawai = $this->jenis_pegawai;

        if (Wajib::where('jenis_pegawai', $jenis_pegawai)->exists()) {
            $this->error_jenis_pegawai = '* Jenis pegawai sudah ada';
            $this->disabled = true;
            return;
        }

        $this->error_jenis_pegawai = '';
        $this->disabled = false;
    }

    public function render()
    {
        return view('livewire.form-create-wajib');
    }
}
