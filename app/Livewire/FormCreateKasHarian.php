<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\Pokok;
use App\Models\Wajib;
use App\Models\WajibPinjam;

/**
 * Komponen Livewire untuk form pembuatan kas harian masuk.
 * 
 * Fitur:
 * - Menampilkan dropdown anggota dengan nama dan ID
 * - Mengambil data wajib berdasarkan jenis pegawai anggota yang dipilih
 * - Mengambil data pokok berdasarkan anggota yang dipilih
 * - Validasi inputan untuk memastikan tidak ada yang kosong disetiap field
 * - Menangani status disabled untuk tombol submit
 */
class FormCreateKasHarian extends Component
{
    /**
     * Komponen untuk form kas harian masuk.
     * 
     * Properti:
     * - $namaList: Daftar nama anggota untuk dropdown
     * - $anggota_id: ID anggota yang dipilih
     * - $pokok: Nominal pokok
     * - $wajibOptions: Daftar nominal wajib berdasarkan jenis pegawai
     * - $wajibPinjamList: Daftar nominal wajib pinjam
     * - $manasuka: Nominal manasuka
     * - $qurban: Nominal qurban
     * - $wajibPinjam: Nominal wajib pinjam
     * - $wajib: Nominal wajib
     * - $lain_lain: Nominal lain-lain
     * - $disabled: Status disabled untuk tombol submit
     * - $disabled_*: Status disabled untuk setiap inputan
     */
    public $namaList = [];
    public $anggota_id = '';
    public $pokok = '';
    public $wajibOptions = [];
    public $wajibPinjamList = [];
    public $manasuka = '';
    public $qurban = '';
    public $wajibPinjam = '';
    public $wajibPinjamManual = '';
    public $wajib = '';
    public $wajibManual = '';
    public $lain_lain = '';

    public $disabled = false;
    public $disabled_pokok = false;
    public $disabled_wajib = false;
    public $disabled_wajib_manual = false;
    public $disabled_manasuka = false;
    public $disabled_wajibPinjam = false;
    public $disabled_wajibPinjam_manual = false;
    public $disabled_qurban = false;
    public $disabled_lain_lain = false;

    /**
     * Lifecycle hook untuk inisialisasi data awal.
     * Mengambil daftar anggota dan wajib pinjam dari database.
     *
     * @return void
     */
    public function mount()
    {
        $this->namaList = Anggota::pluck('nama', 'id');
        $this->wajibPinjamList = WajibPinjam::orderBy('nominal', 'asc')->pluck('nominal', 'id');
    }

    /**
     * Lifecycle hook saat komponen di-render.
     * Mengambil data wajib dan pokok berdasarkan anggota yang dipilih.
     *
     * @return void
     */
    public function updated($propertyName)
    {   
        if ($propertyName === 'anggota_id') {
            $this->getWajib();
            $this->getPokok();
        }

        $this->disabled();
    }

    /**
     * Mengambil data wajib berdasarkan jenis pegawai anggota yang dipilih.
     *
     * @return void
     */
    public function getWajib()
    {
        $anggota = Anggota::find($this->anggota_id);

        if ($anggota) {
            $this->wajibOptions = Wajib::where('jenis_pegawai', $anggota->jenis_pegawai)
                ->orderBy('nominal', 'desc')
                ->pluck('nominal')
                ->toArray();
        } else {
            $this->wajibOptions = [];
        }
    }

    /**
     * Mengambil data pokok dari tabel simpanan.
     * 
     * Jika disimpanan sudah ada pokok, maka set pokok ke 'Rp 0'.
     * Jika tidak ada, ambil nominal dari tabel pokok.
     *
     * @return void
     */
    public function getPokok()
    {
        if ($this->anggota_id) {
            $anggota = Anggota::find($this->anggota_id); 
            $kasHarian = Simpanan::where('anggota_id', $this->anggota_id)->latest()->first();
            $pokok = Pokok::first();
            $wajib = Wajib::where('jenis_pegawai', $anggota->jenis_pegawai)->first();
    
            if (($kasHarian && $kasHarian->pokok > 0) || ($wajib && $wajib->nominal == 0)  ) {
                $this->pokok = 'Rp 0';
            } else {
                $this->pokok = 'Rp ' . number_format($pokok->nominal, 0, ',', '.');
            }
    
            return;
        }

        $this->pokok = '';
    }
    

    /**
     * Validasi inputan saat pokok diubah.
     * Jika pokok bernilai 0, set disabled_pokok ke true.
     *
     * @return void
     */
    public function updatedPokok()
    {
        $pokok = (int) str_replace(['Rp', '.', ','], '', $this->pokok);

        if ($pokok === 0) {
            $this->disabled_pokok = true;
        } else {
            $this->disabled_pokok = false;
        }

        $this->disabled();
    }

    /**
     * Validasi inputan saat wajib diubah.
     * Jika wajib bernilai 0, set disabled_wajib ke true.
     *
     * @return void
     */
    public function updatedWajib()
    {
        $wajib = (int) str_replace(['Rp', '.', ','], '', $this->wajib);

        if ($wajib === 0) {
            $this->disabled_wajib = true;
        } else {
            $this->disabled_wajib = false;
        }

        $this->disabled();
    }

    public function updatedWajibManual()
    {
        $wajibManual = (int) str_replace(['Rp', '.', ','], '', $this->wajibManual);

        if ($wajibManual === 0) {
            $this->disabled_wajib_manual = true;
        } else {
            $this->disabled_wajib_manual = false;
        }

        $this->disabled();
    }

    /**
     * Validasi inputan saat manasuka diubah.
     * Jika manasuka bernilai 0, set disabled_manasuka ke true.
     *
     * @return void
     */
    public function updatedManasuka()
    {
        $manasuka = (int) str_replace(['Rp', '.', ','], '', $this->manasuka);

        if ($manasuka === 0) {
            $this->disabled_manasuka = true;
        } else {
            $this->disabled_manasuka = false;
        }

        $this->disabled();
    }

    /**
     * Validasi inputan saat wajib pinjam diubah.
     * Jika wajib pinjam bernilai 0, set disabled_wajibPinjam ke true.
     *
     * @return void
     */
    public function updatedWajibPinjam()
    {
        $wajibPinjam = (int) str_replace(['Rp', '.', ','], '', $this->wajibPinjam);

        if ($wajibPinjam === 0) {
            $this->disabled_wajibPinjam = true;
        } else {
            $this->disabled_wajibPinjam = false;
        }

        $this->disabled();
    }

    public function updatedWajibPinjamManual()
    {
        $wajibPinjamManual = (int) str_replace(['Rp', '.', ','], '', $this->wajibPinjamManual);

        if ($wajibPinjamManual === 0) {
            $this->disabled_wajibPinjam_manual = true;
        } else {
            $this->disabled_wajibPinjam_manual = false;
        }

        $this->disabled();
    }

    /**
     * Validasi inputan saat qurban diubah.
     * Jika qurban bernilai 0, set disabled_qurban ke true.
     *
     * @return void
     */
    public function updatedQurban()
    {
        $qurban = (int) str_replace(['Rp', '.', ','], '', $this->qurban);

        if ($qurban === 0) {
            $this->disabled_qurban = true;
        } else {
            $this->disabled_qurban = false;
        }

        $this->disabled();
    }

    /**
     * Validasi inputan saat lain-lain diubah.
     * Jika lain-lain bernilai 0, set disabled_lain_lain ke true.
     *
     * @return void
     */
    public function updatedLainLain()
    {
        $lain_lain = (int) str_replace(['Rp', '.', ','], '', $this->lain_lain);

        if ($lain_lain === 0) {
            $this->disabled_lain_lain = true;
        } else {
            $this->disabled_lain_lain = false;
        }

        $this->disabled();
    }

    /**
     * Menghitung apakah semua inputan bernilai 0.
     * Jika semua inputan bernilai 0, set disabled ke true.
     *
     * @return void
     */
    public function disabled()
    {
        $pokok = (int) str_replace(['Rp', '.', ','], '', $this->pokok);
        $wajib = (int) str_replace(['Rp', '.', ','], '', $this->wajib);
        $wajibManual = (int) str_replace(['Rp', '.', ','], '', $this->wajibManual);
        $manasuka = (int) str_replace(['Rp', '.', ','], '', $this->manasuka);
        $wajibPinjam = (int) str_replace(['Rp', '.', ','], '', $this->wajibPinjam);
        $wajibPinjamManual = (int) str_replace(['Rp', '.', ','], '', $this->wajibPinjamManual);
        $qurban = (int) str_replace(['Rp', '.', ','], '', $this->qurban);
        $lain_lain = (int) str_replace(['Rp', '.', ','], '', $this->lain_lain);

        // dd($pokok, $manasuka, $wajib, $wajibPinjam, $qurban, $lain_lain);

        if ($pokok === 0 && $manasuka === 0 && $wajib === 0 && $wajibManual === 0 && $wajibPinjam === 0 && $wajibPinjamManual === 0 && $qurban === 0 && $lain_lain === 0) {
            $this->disabled = true;
        } else {
            $this->disabled = false;
        }
    }

    /**
     * Merender tampilan form
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.form-create-kas-harian');
    }
}
