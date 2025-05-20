<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\Wajib;

/**
 * Komponen Livewire untuk form edit anggota.
 * 
 * Fitur:
 * - Validasi interaktif untuk setiap field input (nomor anggota, nama, telepon, email, password)
 * - Penanganan error dan status disable untuk tombol submit
 */
class FormEditAnggota extends Component
{
    /**
     * Komponen untuk form edit anggota.
     *
     * Properti:
     * - $user: Model anggota yang sedang diedit.
     * - $no_anggota, $nama, $telepon, $email, $password: Inputan dari user.
     * - $error_*: Menyimpan pesan error untuk setiap input.
     * - $disabled_*: Untuk menandakan apakah inputan dalam keadaan disabled.
     * - $disabled: Menandakan apakah tombol submit dalam keadaan disabled.
     */
    public $user;
    public $no_anggota = '';
    public $nama = '';
    public $telepon = '';
    public $email = '';
    public $password = '';

    public $error_no_anggota;
    public $error_nama;
    public $error_telepon;
    public $error_email;
    public $error_password;

    public $disabled = false;
    public $disabled_no_anggota = false;
    public $disabled_nama = false;
    public $disabled_telepon = false;
    public $disabled_email = false;
    public $disabled_password = false;

    public $jenisPegawaiOptions = [];
    public $jenisPegawai = '';

    /**
     * Lifecycle hook untuk inisialisasi data awal.
     * 
     * @param int $id ID anggota yang akan diedit.
     */
    public function mount($id)
    {
        $this->user = Anggota::findOrFail($id);

        $this->no_anggota = $this->user->no_anggota;
        $this->nama = $this->user->nama;
        $this->jenisPegawai = $this->user->jenis_pegawai;
        $this->jenisPegawaiOptions = Wajib::orderBy('id', 'asc')->pluck('jenis_pegawai');
        $this->telepon = $this->user->telepon;
        $this->email = $this->user->email;
    }

    /**
     * Validasi real-time saat nomor anggota diubah.
     * Mengecek apakah nomor sudah terdaftar.
     */
    public function updatedNoAnggota()
    {
        if (Anggota::where('no_anggota', $this->no_anggota)->where('id', '!=', $this->user->id)->exists()) {
            $this->error_no_anggota = '* Nomor Anggota sudah terdaftar.';
            $this->disabled_no_anggota = true;
        } else {
            $this->error_no_anggota = '';
            $this->disabled_no_anggota = false;
        }

        $this->checkDisabled();
    }

    /**
     * Validasi real-time saat nama diubah.
     * Mengecek apakah nama sudah terdaftar.
     */
    public function updatedNama()
    {
        if (Anggota::where('nama', $this->nama)->where('id', '!=', $this->user->id)->exists()) {
            $this->error_nama = '* Nama sudah terdaftar.';
            $this->disabled_nama = true;
        } else {
            $this->error_nama = '';
            $this->disabled_nama = false;
        }

        $this->checkDisabled();
    }

    /**
     * Validasi real-time saat telepon diubah.
     * Cek format dan panjang nomor, serta cek apakah nomor sudah terdaftar.
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
        } elseif (Anggota::where('telepon', $this->telepon)->where('id', '!=', $this->user->id)->exists()) {
            $this->error_telepon = '* Nomor telepon sudah digunakan.';
            $this->disabled_telepon = true;
        } else {
            $this->error_telepon = '';
            $this->disabled_telepon = false;
        }

        $this->checkDisabled();
    }

    /**
     * Validasi real-time saat email diubah.
     * Cek format email, dan apakah email sudah terdaftar.
     */
    public function updatedEmail()
    {
        if (empty($this->email)) {
            $this->error_email = '';
            $this->disabled_email = false;
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->error_email = '* Format email tidak valid.';
            $this->disabled_email = true;
        } elseif (Anggota::where('email', $this->email)->where('id', '!=', $this->user->id)->exists()) {
            $this->error_email = '* Email sudah digunakan.';
            $this->disabled_email = true;
        } else {
            $this->error_email = '';
            $this->disabled_email = false;
        }

        $this->checkDisabled();
    }

    /**
     * Validasi real-time saat password diubah.
     * Mengecek panjang password.
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
     * Cek apakah semua inputan valid.
     * Jika ada yang invalid, set disabled ke true.
     */
    public function checkDisabled()
    {
        if ($this->disabled_no_anggota || $this->disabled_nama || $this->disabled_telepon || $this->disabled_email || $this->disabled_password ) {
            $this->disabled = true;
        } else {
            $this->disabled = false;
        }
    }

    /**
     * Merender tampilan form.
     */
    public function render()
    {
        return view('livewire.form-edit-anggota');
    }
}
