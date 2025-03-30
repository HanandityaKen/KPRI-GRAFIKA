<?php

namespace App\Livewire\Anggota;

use Livewire\Component;
use App\Models\Anggota;

class FormProfile extends Component
{
    public $anggota;
    public $nama = '';
    public $telepon = '';
    public $password = '';

    public $error_nama;
    public $error_telepon;
    public $error_password;

    public $disabled = false;
    public $disabled_nama = false;
    public $disabled_telepon = false;
    public $disabled_password = false;

    public function mount($id)
    {
        $this->anggota = Anggota::findOrFail($id);
        $this->nama = $this->anggota->nama;
        $this->telepon = $this->anggota->telepon;
    }

    public function updatedNama()
    {
        if (Anggota::where('nama', $this->nama)->where('id', '!=', $this->anggota->id)->exists()) {
            $this->error_nama = '* Nama sudah terdaftar.';
            $this->disabled_nama = true;
        } else {
            $this->error_nama = '';
            $this->disabled_nama = false;
        }

        $this->checkDisabled();
    }

    public function updatedTelepon()
    {
        if (!str_starts_with($this->telepon, '08')) {
            $this->error_telepon = '* Nomor telepon harus diawali dengan "08".';
            $this->disabled_telepon = true;
        } elseif (!preg_match('/^\d{10,13}$/', $this->telepon)) {
            $this->error_telepon = '* Nomor telepon harus memiliki 10 hingga 13 digit.';
            $this->disabled_telepon = true;
        } elseif (Anggota::where('telepon', $this->telepon)->where('id', '!=', $this->anggota->id)->exists()) {
            $this->error_telepon = '* Nomor telepon sudah digunakan.';
            $this->disabled_telepon = true;
        } else {
            $this->error_telepon = '';
            $this->disabled_telepon = false;
        }

        $this->checkDisabled();
    }

    public function updatedPassword()
    {
        if ($this->password === '') {
            $this->error_password = '';
            $this->disabled_password = false;
        } elseif (strlen($this->password) < 8) {
            $this->error_password = '* Password harus memiliki minimal 8 karakter.';
            $this->disabled_password = true;
        } else {
            $this->error_password = '';
            $this->disabled_password = false;
        }
    
        $this->checkDisabled();
    }

    public function checkDisabled()
    {
        if ($this->disabled_nama || $this->disabled_telepon || $this->disabled_password ) {
            $this->disabled = true;
        } else {
            $this->disabled = false;
        }
    }

    public function render()
    {
        return view('livewire.anggota.form-profile');
    }
}
