<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\Wajib;
use App\Models\Simpanan;
use App\Models\Saldo;

/**
 * Komponen Livewire untuk form pembuatan kas harian keluar.
 * 
 * Fitur:
 * - Menampilkan dropdown anggota dengan nama dan ID
 * - Mengambil data wajib berdasarkan jenis pegawai anggota yang dipilih
 * - Validasi inputan untuk memastikan tidak ada yang kosong di setiap field
 * * - Menangani status disabled untuk tombol submit
 */
class FormCreateKasHarianKeluar extends Component
{   
    /**
     * Komponen untuk form kas harian keluar.
     * 
     * Properti:
     * - $namaList: Daftar nama anggota untuk dropdown
     * - $anggota_id: ID anggota yang dipilih
     * - $bendahara: Status apakah anggota adalah bendahara
     * - $wajibOptions: Daftar nominal wajib berdasarkan jenis pegawai
     * - $selectedWajib: Nominal wajib yang dipilih
     * - $qurban: Nominal qurban
     * - $manasuka: Nominal manasuka
     * - $lain_lain: Nominal lain-lain
     * Khusus untuk bendahara, bendahara dapat mengisi field tambahan:
     * - $b_umum: Nominal biaya umum
     * - $b_orgns: Nominal biaya organisasi
     * - $b_oprs: Nominal biaya operasional
     * - $b_lain: Nominal biaya lain-lain
     * - $tnh_kav: Nominal tanah kavling
     * 
     * - $error_qurban: Pesan error untuk qurban
     * - $error_manasuka: Pesan error untuk manasuka
     * 
     * - $disabled: Status disabled untuk tombol submit
     * - $disabled_*: Status disabled untuk setiap inputan
     */
    public $namaList = [];
    public $anggota_id = '';
    public $bendahara = false;
    public $wajibOptions = [0];
    public $selectedWajib = 0;
    public $qurban = '';
    public $manasuka = '';
    public $lain_lain = '';

    // Tambahan khusus untuk bendahara
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

    /**
     * Lifecycle hook untuk inisialisasi data awal.
     * Mengambil daftar anggota dari database.
     */
    public function mount()
    {
        $this->namaList = Anggota::pluck('nama', 'id');
    }

    /**
     * Mengecek apakah anggota adalah bendahara.
     * Mengambil data wajib berdasarkan anggota yang dipilih.
     */
    public function updated($propertyName)
    {
        if ($propertyName === 'anggota_id') {
            $this->getBendahara();
            $this->getWajibOptions();
        }
    }

    /**
     * Mengecek apakah anggota yang dipilih adalah bendahara atau bukan.
     */
    public function getBendahara()
    {
        if ($this->anggota_id) {
            $anggota = Anggota::find($this->anggota_id);

            $this->bendahara = $anggota && $anggota->jabatan === 'bendahara';
        } else {
            $this->bendahara = false;
        }

        $this->checkDisabled();
    }

    /**
     * Mengambil data wajib berdasarkan anggota yang dipilih.
     * Jika anggota tidak dipilih, set $wajibOptions ke [0].
     */
    public function getWajibOptions()
    {
        if ($this->anggota_id) {
            $totalWajib =  Simpanan::where('anggota_id', $this->anggota_id)->pluck('wajib')->toArray();

            $this->wajibOptions = array_merge([0], $totalWajib);
        } else {
            $this->wajibOptions = [0]; 
        }

        $this->selectedWajib = 0; 
        $this->checkDisabled();
    }

    /**
     * Cek apakah wajib dipilih.
     */
    public function updatedSelectedWajib()
    {
        $this->checkDisabled();
    }

    /**
     * Validasi real-time saat qurban diubah.
     * Mengecek apakah simpanan qurban cukup.
     */
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

    /**
     * Validasi real-time saat manasuka diubah.
     * Mengecek apakah simpanan manasuka cukup.
     */
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

    /**
     * Validasi real-time saat lain-lain diubah.
     */
    public function updatedLainLain() 
    { 
        $this->checkDisabled(); 
    }

    /**
     * Validasi real-time saat biaya umum diubah.
     * Khusus untuk bendahara.
     */
    public function updatedBUmum() 
    {
        $this->checkDisabled(); 
    }

    /**
     * Validasi real-time saat biaya organisasi diubah.
     * Khusus untuk bendahara.
     */
    public function updatedBOrgns() 
    { 
        $this->checkDisabled(); 
    }

    /**
     * Validasi real-time saat biaya operasional diubah.
     * Khusus untuk bendahara.
     */
    public function updatedBOprs() 
    { 
        $this->checkDisabled(); 
    }

    /**
     * Validasi real-time saat biaya lain-lain diubah.
     * Khusus untuk bendahara.
     */
    public function updatedBLain() 
    { 
        $this->checkDisabled(); 
    }

    /**
     * Validasi real-time saat tanah kavling diubah.
     * Khusus untuk bendahara.
     */
    public function updatedTnhKav() 
    { 
        $this->checkDisabled(); 
    }

    /**
     * Cek apakah semua inputan sudah diisi dan tidak ada yang kosong.
     * Jika ada yang kosong, set disabled ke true.
     * 
     * @return void
     */
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

    /**
     * Merender tampilan form.
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.pengurus.form-create-kas-harian-keluar');
    }
}
