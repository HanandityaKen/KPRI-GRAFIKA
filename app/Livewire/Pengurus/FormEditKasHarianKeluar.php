<?php

namespace App\Livewire\Pengurus;

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
    public $sekretaris = false;
    public $pembantuUmum = false;
    public $pengawas = false;

    public $selectedWajibPinjam = '';
    public $wajib_pinjam_manual = '';
    public $manasuka = '';
    public $qurban = '';
    public $lain_lain = '';

    public $hari_lembur = '';
    public $perjalanan_pengawas = '';
    public $thr = '';
    public $admin = '';
    public $iuran_dekopinda = '';
    public $honor_pengurus = '';
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
    public $dana_kesejahteraan = '';
    public $pembayaran_listrik_dan_air = '';
    public $tnh_kav = '';
    
    public $error_qurban;
    public $error_manasuka;
    public $error_wajib_pinjam_manual;
    public $disabled = false;
    public $disabled_qurban = false;
    public $disabled_manasuka = false;
    public $disabled_wajib_pinjam_manual = false;

    public $wajibPinjamOption = [];

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

        $this->selectedWajibPinjam = $this->kasHarian->wajib_pinjam;
        $this->wajib_pinjam_manual = "Rp " . number_format($this->kasHarian->wajib_pinjam, 0, ',', '.');
        $this->manasuka = $this->kasHarian->manasuka;
        $this->qurban = $this->kasHarian->qurban;
        $this->lain_lain = $this->kasHarian->lain_lain;

        $this->hari_lembur         = $this->kasHarian->hari_lembur;
        $this->perjalanan_pengawas = $this->kasHarian->perjalanan_pengawas;
        $this->thr                 = $this->kasHarian->thr;
        $this->admin               = $this->kasHarian->admin;
        $this->iuran_dekopinda     = $this->kasHarian->iuran_dekopinda;
        $this->honor_pengurus      = $this->kasHarian->honor_pengurus;
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
        $this->dana_kesejahteraan  = $this->kasHarian->dana_kesejahteraan;
        $this->pembayaran_listrik_dan_air  = $this->kasHarian->pembayaran_listrik_dan_air;
        $this->tnh_kav             = $this->kasHarian->tnh_kav;

        $anggota = Anggota::find($this->anggota_id);
        $this->bendahara = $anggota && $anggota->jabatan === 'bendahara';

        $this->wajibPinjamOption = [0, $this->kasHarian->wajib_pinjam];
        $this->getBendahara();
        $this->getSekretaris();
        $this->getPembantuUmum();
        $this->getPengawas();
        $this->checkDisabled();
    }

    /**
     * Mengecek apakah anggota adalah bendahara.
     */
    public function updated($propertyName)
    {
        if ($propertyName === 'anggota_id') {
            $this->getBendahara();
            $this->getSekretaris();
            $this->getPembantuUmum();
            $this->getPengawas();
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

    public function getSekretaris()
    {
        if ($this->anggota_id) {
            $anggota = Anggota::find($this->anggota_id);

            $this->sekretaris = $anggota && $anggota->jabatan === 'sekretaris';
        } else {
            $this->sekretaris = false;
        }
    }

    public function getPembantuUmum()
    {
        if ($this->anggota_id) {
            $anggota = Anggota::find($this->anggota_id);

            $this->pembantuUmum = $anggota && $anggota->jabatan === 'pembantu umum';
        } else {
            $this->pembantuUmum = false;
        }
    }

    public function getPengawas()
    {
        if ($this->anggota_id) {
            $anggota = Anggota::find($this->anggota_id);

            $this->pengawas = $anggota && $anggota->jabatan === 'pengawas';
        } else {
            $this->pengawas = false;
        }
    }

    /**
     * Validasi real-time saat wajib diubah.
     */
    public function updatedSelectedWajibPinjam()
    {
        $this->checkDisabled();
    }

    public function updatedWajibPinjamManual()
    {
        $wajibPinjamManual = (int) str_replace(['Rp', '.', ','], '', $this->wajib_pinjam_manual);
        $totalWajibPinjam = Simpanan::where('anggota_id', $this->anggota_id)->value('wajib_pinjam');

        $totalWajibPinjam = $totalWajibPinjam + (int) $this->kasHarian->wajib_pinjam;

        if ($wajibPinjamManual > $totalWajibPinjam) {
            $this->error_wajib_pinjam_manual = '* Simpanan wajib pinjam tidak cukup!';
            $this->disabled_wajib_pinjam_manual = true;
        } else {
            $this->error_wajib_pinjam_manual = '';
            $this->disabled_wajib_pinjam_manual = false;
        }

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

    public function updatedHonorPengurus()
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

    public function updatedDanaKesejahteraan()
    {
        $this->checkDisabled();
    }

    public function updatedPembayaranListrikDanAir()
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

    public function shouldTabunganQurbanBeReadonly()
    {
        $fields = [
            'qurban',
            'manasuka',
            'lain_lain',
            'selectedWajibPinjam',
            'wajib_pinjam_manual',
            'hari_lembur',
            'perjalanan_pengawas',
            'thr',
            'admin',
            'iuran_dekopinda',
            'honor_pengurus',
            'rkrab',
            'pembinaan',
            'harkop',
            'dandik',
            'rapat',
            'jasa_manasuka',
            'pajak',
            'dekopinda',
            'wajib_pkpri',
            'dansos',
            'shu',
            'dana_pengurus',
            'dana_kesejahteraan',
            'pembayaran_listrik_dan_air',
            'tnh_kav',
        ];
        
        foreach ($fields as $field) {
            $value = (int) str_replace(['Rp', '.', ','], '', $this->$field);
            if ($value > 0) {
                return true;
            }
        }
        
        return false;
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
        $wajib_pinjam      = (int) $this->selectedWajibPinjam;
        $wajib_pinjam_manual = (int) str_replace(['Rp', '.', ','], '', $this->wajib_pinjam_manual);

        // Biaya tambahan khusus bendahara
        $hari_lembur         = (int) str_replace(['Rp', '.', ','], '', $this->hari_lembur);
        $perjalanan_pengawas = (int) str_replace(['Rp', '.', ','], '', $this->perjalanan_pengawas);
        $thr                 = (int) str_replace(['Rp', '.', ','], '', $this->thr);
        $admin               = (int) str_replace(['Rp', '.', ','], '', $this->admin);
        $iuran_dekopinda     = (int) str_replace(['Rp', '.', ','], '', $this->iuran_dekopinda);
        $honor_pengurus      = (int) str_replace(['Rp', '.', ','], '', $this->honor_pengurus);
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
        $dana_kesejahteraan  = (int) str_replace(['Rp', '.', ','], '', $this->dana_kesejahteraan);
        $pembayaran_listrik_dan_air  = (int) str_replace(['Rp', '.', ','], '', $this->pembayaran_listrik_dan_air);
        $tnh_kav             = (int) str_replace(['Rp', '.', ','], '', $this->tnh_kav);

        $hasValidationError = $this->disabled_qurban || $this->disabled_manasuka || $this->disabled_wajib_pinjam_manual;

        $isAllZero = $qurban === 0 &&
                    $manasuka === 0 &&
                    $lain_lain === 0 &&
                    $wajib_pinjam === 0 &&
                    $wajib_pinjam_manual === 0 &&
                    $dansos === 0 &&
                    (!$this->bendahara || (
                        $hari_lembur === 0 &&
                        $perjalanan_pengawas === 0 &&
                        $thr === 0 &&
                        $admin === 0 &&
                        $iuran_dekopinda === 0 &&
                        $honor_pengurus === 0 &&
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
                        $shu === 0 &&
                        $dana_pengurus === 0 &&
                        $dana_kesejahteraan === 0 &&
                        $pembayaran_listrik_dan_air === 0 &&
                        $tnh_kav === 0
                    )) &&
                    (!$this->sekretaris || (
                        $hari_lembur === 0 &&
                        $perjalanan_pengawas === 0 &&
                        $honor_pengurus === 0 &&
                        $dana_pengurus === 0
                    )) &&
                    (!$this->pembantuUmum || (
                        $hari_lembur === 0 &&
                        $perjalanan_pengawas === 0 &&
                        $honor_pengurus === 0 &&
                        $dana_pengurus === 0
                    )) &&
                    (!$this->pengawas || (
                        $hari_lembur === 0 &&
                        $perjalanan_pengawas === 0 &&
                        $honor_pengurus === 0 &&
                        $dana_pengurus === 0
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
        return view('livewire.pengurus.form-edit-kas-harian-keluar');
    }
}
