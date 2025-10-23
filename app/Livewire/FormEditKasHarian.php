<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\KasHarian;
use App\Models\Simpanan;
use App\Models\Pokok;
use App\Models\Wajib;
use App\Models\WajibPinjam;

/**
 * Komponen Livewire untuk form edit kas harian masuk.
 *
 * Fitur:
 * - Menampilkan dropdown anggota dengan nama dan ID
 * - Mengambil data kas harian berdasarkan id_kas_harian
 * - Mengambil data wajib berdasarkan jenis pegawai anggota yang dipilih
 * - Mengambil data pokok berdasarkan anggota yang dipilih
 * - Validasi inputan untuk memastikan tidak ada yang kosong di setiap field
 * - Menangani status disabled untuk tombol submit
 */
class FormEditKasHarian extends Component
{
    /**
     * Komponen untuk form edit kas harian masuk.
     *
     * Properti:
     * - $kasHarian: Model kas harian yang sedang diedit
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
    public $kasHarian;
    public $namaList = [];
    public $anggota_id = '';
    public $pokok = '';

    public $wajib = '';
    public $wajibOptions = [];
    public $selectedWajib = '';
    public $wajibManual = '';

    public $wajibPinjam = '';
    public $wajibPinjamList = [];
    public $selectedWajibPinjam = '';
    public $wajibPinjamManual = '';

    public $qurban = '';
    public $manasuka = '';
    public $lain_lain = '';

    public $disabled = false;

    // List Pengurus
    public $anggotaList = [];

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

        $this->pokok = $this->kasHarian->pokok;

        $this->wajib = $this->kasHarian->wajib;
        $this->selectedWajib = $this->kasHarian->wajib;
        $this->wajibManual = $this->kasHarian->wajib;

        $this->wajibPinjam = $this->kasHarian->wajib_pinjam;
        $this->selectedWajibPinjam = $this->kasHarian->wajib_pinjam;
        $this->wajibPinjamManual = $this->kasHarian->wajib_pinjam;

        $this->qurban = $this->kasHarian->qurban;
        $this->manasuka = $this->kasHarian->manasuka;
        $this->lain_lain = $this->kasHarian->lain_lain;

        $this->wajibPinjamList = WajibPinjam::orderBy('nominal', 'asc')->pluck('nominal', 'id')->toArray();

        // List Pengurus
        $this->anggotaList = Anggota::where('posisi', 'pengurus')->pluck('nama', 'id')->toArray();

        $this->getWajib();

        $this->disabled();
    }

    /**
     * Validasi real-time saat anggota diubah.
     * Mengambil data wajib dan pokok berdasarkan anggota yang dipilih.
     */
    public function updated($propertyName)
    {
        if ($propertyName === 'anggota_id') {
            $this->getPokok();
            $this->getWajib();
        }

        $this->disabled();
    }

    /**
     * Mengambil data wajib berdasarkan jenis pegawai anggota yang dipilih.
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
     * Menghitung apakah semua inputan bernilai 0.
     * Jika semua inputan bernilai 0, set disabled ke true.
     *
     * @return void
     */
    public function disabled()
    {
        $wajib = (int) str_replace(['Rp', '.', ','], '', $this->selectedWajib);
        $wajibManual = (int) str_replace(['Rp', '.', ','], '', $this->wajibManual);
        $manasuka = (int) str_replace(['Rp', '.', ','], '', $this->manasuka);
        $wajibPinjam = (int) str_replace(['Rp', '.', ','], '', $this->selectedWajibPinjam);
        $wajibPinjamManual = (int) str_replace(['Rp', '.', ','], '', $this->wajibPinjamManual);
        $qurban = (int) str_replace(['Rp', '.', ','], '', $this->qurban);
        $lain_lain = (int) str_replace(['Rp', '.', ','], '', $this->lain_lain);

        // dd($pokok, $manasuka, $wajib, $wajibPinjam, $qurban, $lain_lain);

        if ($manasuka === 0 && $wajib === 0 && $wajibManual === 0 && $wajibPinjam === 0 && $wajibPinjamManual === 0 && $qurban === 0 && $lain_lain === 0) {
            $this->disabled = true;
        } else {
            $this->disabled = false;
        }
    }

    /**
     * Merender tampilan form.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.form-edit-kas-harian');
    }
}
