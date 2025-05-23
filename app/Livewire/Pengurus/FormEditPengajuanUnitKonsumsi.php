<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\Persentase;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\UnitKonsumsi;

/**
 * Komponen Livewire untuk mengedit pengajuan unit konsumsi.
 *
 * Fitur:
 * - Mengambil data pengajuan unit konsumsi berdasarkan ID
 * - Menghitung nominal pokok, bunga, dan total berdasarkan inputan
 * - Validasi inputan untuk memastikan tidak ada yang kosong
 * - Menangani status disabled untuk tombol submit
 * - Menangani status aktif unit konsumsi untuk anggota
 * 
 * Properti:
 * - $pengajuanUnitKonsumsi: Model pengajuan unit konsumsi yang sedang diedit
 * - $namaList: Daftar nama anggota untuk dropdown
 * - $anggota_id: ID anggota yang dipilih
 * - $nominal: Jumlah nominal yang diminta
 * - $lama_angsuran: Lama angsuran dalam bulan
 * - $nominal_pokok: Nominal pokok pinjaman
 * - $nominal_bunga: Nominal bunga pinjaman
 * - $jumlah_nominal: Total pinjaman setelah dikurangi biaya admin
 * - $error_nominal: Pesan error jika nominal melebihi batas
 * - $disabled: Status disabled untuk tombol submit
 * - $unitKonsumsiAktif: Status apakah anggota memiliki unit konsumsi aktif
 * 
 *  Metode:
 * - mount: Inisialisasi data awal saat komponen dimuat
 * - updated: Memanggil metode hitungUnitKonsumsi saat ada perubahan pada nominal atau lama angsuran
 * - updatedNominal: Memeriksa dan menghitung nominal pokok, bunga, dan total pinjaman
 * - hitungUnitKonsumsi: Menghitung nominal pokok, bunga, dan total pinjaman berdasarkan inputan
 * - updatedAnggotaId: Memeriksa apakah anggota memiliki unit konsumsi aktif saat anggota dipilih
 * - render: Mengembalikan tampilan komponen
 */

class FormEditPengajuanUnitKonsumsi extends Component
{
    public $pengajuanUnitKonsumsi;
    public $namaList = [];
    public $anggota_id = '';
    public $nominal = '';
    public $nama_barang = '';
    public $lama_angsuran = '';
    public $nominal_pokok = '';
    public $nominal_bunga = '';
    public $jumlah_nominal = '';
    public $error_nominal = '';
    public $disabled_nominal = false;
    public $unitKonsumsiAktif = false;
    public $disabled_lama_angsuran = false;
    public $error_lama_angsuran = '';
    public $disabled = false;

    public function mount($id)
    {
        $this->pengajuanUnitKonsumsi = PengajuanUnitKonsumsi::findOrFail($id);
        $this->namaList = Anggota::pluck('nama', 'id')->toArray();
        $this->anggota_id = $this->pengajuanUnitKonsumsi->anggota_id;
        $this->nama_barang = $this->pengajuanUnitKonsumsi->nama_barang;
        $this->nominal = "Rp " . number_format($this->pengajuanUnitKonsumsi->nominal, 0, ',', '.');
        preg_match('/\d+/', $this->pengajuanUnitKonsumsi->lama_angsuran, $matches);
        $this->lama_angsuran = $matches[0] ?? null;
        $this->updatedNominal();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'lama_angsuran') {
            $this->limitLamaAngsuran();
        }

        if (in_array($propertyName, ['nominal', 'lama_angsuran'])) {
            $this->hitungUnitKonsumsi();
        }
    }

    public function limitLamaAngsuran()
    {
        if ((int) $this->lama_angsuran > 120) {
            $this->error_lama_angsuran = '* Lama angsuran tidak boleh lebih dari 120 bulan / 10 tahun.';
            $this->disabled_lama_angsuran = true;
        } else {
            $this->error_lama_angsuran = '';
            $this->disabled_lama_angsuran = false;
        }

        $this->disabled();
    }

    public function updatedNominal()
    {
        $nominal = (int) str_replace(['Rp', '.', ','], '', $this->nominal);

        if ($nominal > 5000000) {
            $this->error_nominal = '* Nominal maksimal Rp 5.000.000.';
            $this->reset(['nominal_pokok', 'nominal_bunga', 'jumlah_nominal']); // Reset nilai jika lebih dari 5 juta
            $this->disabled = true;
            $this->disabled();
            return;
        } else {
            $this->error_nominal = '';
            $this->disabled = false;
        }

        $this->hitungUnitKonsumsi();
        $this->disabled();
    }

    public function hitungUnitKonsumsi()
    {
        if (empty($this->nominal) || empty($this->lama_angsuran)) {
            $this->reset(['nominal_pokok', 'nominal_bunga', 'jumlah_nominal']);
            return;
        }

        $nominal = (int) str_replace(['Rp', '.', ','], '', $this->nominal);
        $lamaAngsuran = (int) preg_replace('/[^0-9]/', '', $this->lama_angsuran);

        if ($nominal > 5000000) {
            return;
        }

        if ($nominal > 0 && $lamaAngsuran > 0) {
            $this->nominal_pokok = ceil(($nominal / $lamaAngsuran) / 100) * 100;

            $bunga_unit_konsumsi = Persentase::where('id', 4)->value('persentase');
            
            $this->nominal_bunga = ceil(($nominal * $bunga_unit_konsumsi) / 100) * 100;
            $this->jumlah_nominal = $this->nominal_pokok + $this->nominal_bunga;

            $this->nominal_pokok = "Rp " . number_format($this->nominal_pokok, 0, ',', '.');
            $this->nominal_bunga = "Rp " . number_format($this->nominal_bunga, 0, ',', '.');
            $this->jumlah_nominal = "Rp " . number_format($this->jumlah_nominal, 0, ',', '.');
        } else {
            $this->reset(['nominal_pokok', 'nominal_bunga', 'jumlah_nominal']);
        }
    }

    public function updatedAnggotaId()
    {
        if ($this->anggota_id) {
            $this->unitKonsumsiAktif = UnitKonsumsi::whereHas('pengajuan_unit_konsumsi', function ($query) {
                    $query->where('anggota_id', $this->anggota_id);
                })
                ->where('status', 'dalam pembayaran')
                ->exists();
        } else {
            $this->unitKonsumsiAktif = false;
        }

        $this->disabled();
    }

    public function disabled()
    {
        if ($this->unitKonsumsiAktif || $this->error_nominal || $this->error_lama_angsuran) {
            $this->disabled = true;
        } else {
            $this->disabled = false;
        }
    }

    public function render()
    {
        return view('livewire.pengurus.form-edit-pengajuan-unit-konsumsi');
    }
}
