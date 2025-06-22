<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\KasHarian;
use App\Models\Simpanan;
use App\Models\Pokok;
use App\Models\Wajib;

/**
 * Komponen Livewire untuk form edit kas harian keluar.
 * 
 * Fitur:
 * - Menampilkan dropdown anggota dengan nama dan ID
 * - Mengambil data kas harian berdasarkan id_kas_harian
 * - Validasi inputan untuk memastikan tidak ada yang kosong di setiap field
 * - Menangani status disabled untuk tombol submit
 */
class FormEditKasHarianKeluar extends Component
{
    /**
     * Komponen untuk form kas harian keluar.
     * 
     * Properti:
     * - $kasHarian: Model kas harian yang sedang diedit
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
    public $kasHarian;
    public $namaList = [];
    public $anggota_id = '';
    public $bendahara = false;

    public $selectedWajib = '';
    public $manasuka = '';
    public $qurban = '';
    public $lain_lain = '';

    public $hari_lembur = '';
    public $perjalanan_pengawas = '';
    public $thr = '';
    public $admin = '';
    public $iuran_dekopinda = '';
    public $rkrab = '';
    public $pembinaan = '';
    public $harkop = '';
    public $dandik = '';
    public $rapat = '';
    public $jasa_manasuka = '';
    public $pajak = '';
    public $tabungan_qurban = '';
    public $dekopinda = '';
    public $wajib_pkpri = '';
    public $dansos = '';
    public $shu = '';
    public $dana_pengurus = '';
    public $tnh_kav = '';

    public $error_qurban;
    public $error_manasuka;
    public $disabled = false;
    public $disabled_qurban = false;
    public $disabled_manasuka = false;

    public $wajibOption = [];

    /**
     * Lifecycle hook untuk inisialisasi data awal.
     * 
     * @param int $id ID kas harian yang akan diedit.
     */
    public function mount($id)
    {
        $this->kasHarian = KasHarian::findOrFail($id);
        $this->namaList = Anggota::pluck('nama', 'id')->toArray();
        $this->anggota_id = $this->kasHarian->anggota_id;

        $this->selectedWajib = $this->kasHarian->wajib;
        $this->manasuka = $this->kasHarian->manasuka;
        $this->qurban = $this->kasHarian->qurban;
        $this->lain_lain = $this->kasHarian->lain_lain;

        $this->hari_lembur         = $this->kasHarian->hari_lembur;
        $this->perjalanan_pengawas = $this->kasHarian->perjalanan_pengawas;
        $this->thr                 = $this->kasHarian->thr;
        $this->admin               = $this->kasHarian->admin;
        $this->iuran_dekopinda     = $this->kasHarian->iuran_dekopinda;
        $this->rkrab               = $this->kasHarian->rkrab;
        $this->pembinaan           = $this->kasHarian->pembinaan;
        $this->harkop              = $this->kasHarian->harkop;
        $this->dandik              = $this->kasHarian->dandik;
        $this->rapat               = $this->kasHarian->rapat;
        $this->jasa_manasuka       = $this->kasHarian->jasa_manasuka;
        $this->pajak               = $this->kasHarian->pajak;
        $this->tabungan_qurban     = $this->kasHarian->tabungan_qurban;
        $this->dekopinda           = $this->kasHarian->dekopinda;
        $this->wajib_pkpri         = $this->kasHarian->wajib_pkpri;
        $this->dansos              = $this->kasHarian->dansos;
        $this->shu                 = $this->kasHarian->shu;
        $this->dana_pengurus       = $this->kasHarian->dana_pengurus;
        $this->tnh_kav             = $this->kasHarian->tnh_kav;

        $anggota = Anggota::find($this->anggota_id);
        $this->bendahara = $anggota && $anggota->jabatan === 'bendahara';

        $this->wajibOption = [0, $this->kasHarian->wajib];

        $this->checkDisabled();
    }

    /**
     * Mengecek apakah anggota adalah bendahara.
     */
    public function updated($propertyName)
    {
        if ($propertyName === 'anggota_id') {
            $this->getBendahara();
        }

        $this->checkDisabled();
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
    }

    /**
     * Validasi real-time saat wajib diubah.
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

        $totalQurban = $totalQurban + (int) $this->kasHarian->qurban;

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

        $totalManasuka = $totalManasuka + (int) $this->kasHarian->manasuka;

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

    public function updatedHariLembur() 
    {
        $this->checkDisabled(); 
    }

    public function updatedPerjalananPengawas()
    {
        $this->checkDisabled();
    }

    public function updatedThr()
    {
        $this->checkDisabled();
    }

    public function updatedAdmin()
    {
        $this->checkDisabled();
    }

    public function updatedIuranDekopinda()
    {
        $this->checkDisabled();
    }

    public function updatedRkrab()
    {
        $this->checkDisabled();
    }

    public function updatedPembinaan()
    {
        $this->checkDisabled();
    }

    public function updatedHarkop()
    {
        $this->checkDisabled();
    }

    public function updatedDandik()
    {
        $this->checkDisabled();
    }

    public function updatedRapat()
    {
        $this->checkDisabled();
    }

    public function updatedJasaManasuka()
    {
        $this->checkDisabled();
    }

    public function updatedPajak()
    {
        $this->checkDisabled();
    }

    public function updatedTabunganQurban()
    {
        $this->checkDisabled();
    }

    public function updatedDekopinda()
    {
        $this->checkDisabled();
    }

    public function updatedWajibPkpri()
    {
        $this->checkDisabled();
    }

    public function updatedDansos()
    {
        $this->checkDisabled();
    }

    public function updatedShu()
    {
        $this->checkDisabled();
    }

    public function updatedDanaPengurus()
    {
        $this->checkDisabled();
    }
    
    /**
     * Validasi real-time saat tanah kavling diubah.
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
        $hari_lembur         = (int) str_replace(['Rp', '.', ','], '', $this->hari_lembur);
        $perjalanan_pengawas = (int) str_replace(['Rp', '.', ','], '', $this->perjalanan_pengawas);
        $thr                 = (int) str_replace(['Rp', '.', ','], '', $this->thr);
        $admin               = (int) str_replace(['Rp', '.', ','], '', $this->admin);
        $iuran_dekopinda     = (int) str_replace(['Rp', '.', ','], '', $this->iuran_dekopinda);
        $rkrab               = (int) str_replace(['Rp', '.', ','], '', $this->rkrab);
        $pembinaan           = (int) str_replace(['Rp', '.', ','], '', $this->pembinaan);
        $harkop              = (int) str_replace(['Rp', '.', ','], '', $this->harkop);
        $dandik              = (int) str_replace(['Rp', '.', ','], '', $this->dandik);
        $rapat               = (int) str_replace(['Rp', '.', ','], '', $this->rapat);
        $jasa_manasuka       = (int) str_replace(['Rp', '.', ','], '', $this->jasa_manasuka);
        $pajak               = (int) str_replace(['Rp', '.', ','], '', $this->pajak);
        $tabungan_qurban     = (int) str_replace(['Rp', '.', ','], '', $this->tabungan_qurban);
        $dekopinda           = (int) str_replace(['Rp', '.', ','], '', $this->dekopinda);
        $wajib_pkpri         = (int) str_replace(['Rp', '.', ','], '', $this->wajib_pkpri);
        $dansos              = (int) str_replace(['Rp', '.', ','], '', $this->dansos);
        $shu                 = (int) str_replace(['Rp', '.', ','], '', $this->shu);
        $dana_pengurus       = (int) str_replace(['Rp', '.', ','], '', $this->dana_pengurus);
        $tnh_kav             = (int) str_replace(['Rp', '.', ','], '', $this->tnh_kav);

        $hasValidationError = $this->disabled_qurban || $this->disabled_manasuka;

        $isAllZero = $qurban === 0 &&
                    $manasuka === 0 &&
                    $lain_lain === 0 &&
                    $wajib === 0 &&
                    (!$this->bendahara || (
                        $hari_lembur === 0 &&
                        $perjalanan_pengawas === 0 &&
                        $thr === 0 &&
                        $admin === 0 &&
                        $iuran_dekopinda === 0 &&
                        $rkrab === 0 &&
                        $pembinaan === 0 &&
                        $harkop === 0 &&
                        $dandik === 0 &&
                        $rapat === 0 &&
                        $jasa_manasuka === 0 &&
                        $pajak === 0 &&
                        $tabungan_qurban === 0 &&
                        $dekopinda === 0 &&
                        $wajib_pkpri === 0 &&
                        $dansos === 0 &&
                        $shu === 0 &&
                        $dana_pengurus === 0 &&
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
        return view('livewire.form-edit-kas-harian-keluar');
    }
}
