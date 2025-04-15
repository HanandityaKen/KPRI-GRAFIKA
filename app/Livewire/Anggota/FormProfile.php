<?php

namespace App\Livewire\Anggota;

use Livewire\Component;
use App\Models\Anggota;

/**
 * Komponen Livewire untuk mengelola profil anggota.
 * Komponen ini menangani input nama, telepon, email, dan password anggota,
 * serta melakukan validasi pada setiap perubahan data
 */
class FormProfile extends Component
{
    /**
     * Anggota yang sedang diedit
     *
     * @var Anggota
     */
    public $anggota;

    /**
     * Data anggota
     *
     * @var string
     */
    public $nama = '';
    public $telepon = '';
    public $email = '';
    public $password = '';

    /**
     * Pesan kesalahan untuk setiap field
     *
     * @var string
     */
    public $error_nama;
    public $error_telepon;
    public $error_email;
    public $error_password;

    /**
     * Status disabled untuk setiap field
     *
     * @var bool
     */
    public $disabled_nama = false;
    public $disabled_telepon = false;
    public $disabled_email = false;
    public $disabled_password = false;
    /**
     * Status disabled untuk tombol simpan
     *
     * @var bool
     */
    public $disabled = false;

    /**
     * Inisialisasi komponen dengan ID anggota
     *
     * @param int $id ID anggota yang akan diedit
     * @return void
     */
    public function mount($id)
    {
        $this->anggota = Anggota::findOrFail($id);
        $this->nama = $this->anggota->nama;
        $this->telepon = $this->anggota->telepon;
        $this->email = $this->anggota->email;
    }

    /**
     * Validasi apakah nama sudah diperbarui
     * Jika nama sudah terdaftar, tampilkan pesan kesalahan
     */
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

    /**
     * Validasi apakah telepon sudah diperbarui
     * Jika telepon sudah terdaftar, tampilkan pesan kesalahan
     */
    public function updatedTelepon()
    {
        if (empty($this->telepon)) {
            $this->error_telepon = '';
            $this->disabled_telepon = false;
        } elseif (!str_starts_with($this->telepon, '08')) {
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

    /**
     * Validasi apakah email sudah diperbarui
     * Jika email sudah terdaftar, tampilkan pesan kesalahan
     */
    public function updatedEmail()
    {
        if (empty($this->email)) {
            $this->error_email = '';
            $this->disabled_email = false;
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->error_email = '* Format email tidak valid.';
            $this->disabled_email = true;
        } elseif (Anggota::where('email', $this->email)->where('id', '!=', $this->anggota->id)->exists()) {
            $this->error_email = '* Email sudah digunakan.';
            $this->disabled_email = true;
        } else {
            $this->error_email = '';
            $this->disabled_email = false;
        }

        $this->checkDisabled();
    }

    /**
     * Validasi apakah password sudah diperbarui
     * Jika password kurang dari 8 karakter, tampilkan pesan kesalahan
     */
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

    /**
     * Simpan perubahan profil anggota
     * Jika ada kesalahan, tampilkan pesan kesalahan
     */
    public function checkDisabled()
    {
        if ($this->disabled_nama || $this->disabled_telepon || $this->disabled_email || $this->disabled_password ) {
            $this->disabled = true;
        } else {
            $this->disabled = false;
        }
    }

    /**
     * Merender halaman profil anggota
     */
    public function render()
    {
        return view('livewire.anggota.form-profile');
    }
}
