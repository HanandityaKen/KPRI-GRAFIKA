<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;

/**
 * Komponen Livewire untuk form profil anggota.
 *
 * Fitur:
 * - Menampilkan dan mengedit informasi profil anggota
 * - Validasi inputan untuk memastikan tidak ada yang kosong di setiap field
 * - Menangani status disabled untuk tombol submit
 */
class FormProfile extends Component
{
    /**
     * Komponen untuk form profil anggota.
     *
     * Properti:
     * - $pengurus: Model anggota yang sedang diedit
     * - $nama: Nama anggota
     * - $telepon: Nomor telepon anggota
     * - $email: Alamat email anggota
     * - $password: Password anggota
     *
     * - $error_nama: Pesan error untuk nama
     * - $error_telepon: Pesan error untuk telepon
     * - $error_email: Pesan error untuk email
     * - $error_password: Pesan error untuk password
     *
     * - $disabled: Status disabled untuk tombol submit
     * - $disabled_*: Status disabled untuk setiap inputan
     */
    public $pengurus;
    public $nama = '';
    public $telepon = '';
    public $email = '';
    public $password = '';

    public $error_nama;
    public $error_telepon;
    public $error_email;
    public $error_password;

    public $disabled = false;
    public $disabled_nama = false;
    public $disabled_telepon = false;
    public $disabled_email = false;
    public $disabled_password = false;

    /**
     * Lifecycle hook untuk inisialisasi data awal.
     *
     * @param int $id ID anggota yang akan diedit
     */
    public function mount($id)
    {
        $this->pengurus = Anggota::findOrFail($id);
        $this->nama = $this->pengurus->nama;
        $this->telepon = $this->pengurus->telepon;
        $this->email = $this->pengurus->email;
    }

    /**\
     * Cek apakah ada perubahan pada inputan nama
     * dan validasi apakah nama sudah terdaftar
     */
    public function updatedNama()
    {
        if (Anggota::where('nama', $this->nama)->where('id', '!=', $this->pengurus->id)->exists()) {
            $this->error_nama = '* Nama sudah terdaftar.';
            $this->disabled_nama = true;
        } else {
            $this->error_nama = '';
            $this->disabled_nama = false;
        }

        $this->checkDisabled();
    }

    /**
     * Cek apakah ada perubahan pada inputan telepon
     * dan validasi apakah telepon sudah terdaftar
     * atau tidak sesuai format
     */
    public function updatedTelepon()
    {
        if (!str_starts_with($this->telepon, '08')) {
            $this->error_telepon = '* Nomor telepon harus diawali dengan "08".';
            $this->disabled_telepon = true;
        } elseif (!preg_match('/^\d{10,13}$/', $this->telepon)) {
            $this->error_telepon = '* Nomor telepon harus memiliki 10 hingga 13 digit.';
            $this->disabled_telepon = true;
        } elseif (Anggota::where('telepon', $this->telepon)->where('id', '!=', $this->pengurus->id)->exists()) {
            $this->error_telepon = '* Nomor telepon sudah digunakan.';
            $this->disabled_telepon = true;
        } else {
            $this->error_telepon = '';
            $this->disabled_telepon = false;
        }

        $this->checkDisabled();
    }

    /**
     * Cek apakah ada perubahan pada inputan email
     * dan validasi apakah email sudah terdaftar
     * atau tidak sesuai format
     */
    public function updatedEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->error_email = '* Format email tidak valid.';
            $this->disabled_email = true;
        } elseif (Anggota::where('email', $this->email)->where('id', '!=', $this->pengurus->id)->exists()) {
            $this->error_email = '* Email sudah digunakan.';
            $this->disabled_email = true;
        } else {
            $this->error_email = '';
            $this->disabled_email = false;
        }

        $this->checkDisabled();
    }

    /**
     * Cek apakah ada perubahan pada inputan password
     * dan validasi apakah password sudah sesuai
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
     * Cek apakah semua inputan sudah diisi dan tidak ada yang kosong.
     * Jika ada yang kosong, set $disabled ke true.
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
     * Merender view untuk form profil anggota.
     */
    public function render()
    {
        return view('livewire.pengurus.form-profile');
    }
}
