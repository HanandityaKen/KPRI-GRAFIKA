<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\Persentase;
use App\Models\UnitKonsumsi;

/**
 * Komponen Livewire untuk membuat formulir pengajuan pinjaman oleh pengurus.
 * 
 * Komponen ini memungkinkan pengurus:
 * - Memilih anggota.
 * - Mengisi nominal, nama barang dan lama angsuran.
 * - Secara otomatis menghitung:
 *   - Nominal pokok angsuran.
 *   - Nominal bunga.
 *   - Nominal angsuran per bulan.
 * - Mengecek apakah anggota masih memiliki pinjaman aktif.
 */
class FormCreatePengajuanUnitKonsumsi extends Component
{
    public $namaList = [];
    public $anggota_id = '';
    public $nominal = '';
    public $lama_angsuran = '';
    public $nominal_pokok = '';
    public $nominal_bunga = '';
    public $jumlah_nominal = '';
    public $error_nominal = '';
    public $disabled = false;
    public $unitKonsumsiAktif = false;

    /**
     * Lifecycle hook yang dijalankan saat komponen pertama kali dimuat.
     * Mengambil data semua anggota dan menyimpannya dalam bentuk array key-value (id => nama).
     */
    public function mount()
    {
        $this->namaList = Anggota::pluck('nama', 'id');
        $this->lama_angsuran = '';
    }

    /**
     * Method ini akan otomatis dipanggil oleh Livewire
     * setiap ada perubahan nilai pada properti apa pun.
     * Di sini hanya tangani perubahan pada nominal dan lama angsuran.
     *
     * @param string $propertyName
     */
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['nominal', 'lama_angsuran'])) {
            $this->hitungUnitKonsumsi();
        }
    }

    /**
     * Method ini akan dipanggil setiap kali nilai nominal berubah.
     * Jika nominal lebih dari 5 juta, tampilkan pesan error dan reset nilai lainnya.
     */
    public function updatedNominal()
    {
        $nominal = (int) str_replace(['Rp', '.', ','], '', $this->nominal);

        if ($nominal > 5000000) {
            $this->error_nominal = '* Nominal maksimal Rp 5.000.000.';
            $this->reset(['nominal_pokok', 'nominal_bunga', 'jumlah_nominal']); // Reset nilai jika lebih dari 5 juta
            $this->disabled = true;
            return;
        } else {
            $this->error_nominal = '';
            $this->disabled = false;
        }

        $this->hitungUnitKonsumsi();
    }

    /**
     * Melakukan perhitungan otomatis terkait unit konsumsi:
     * - Nominal pokok = nominal dibagi lama angsuran.
     * - Bunga diambil dari tabel `persentase` dengan id 4.
     * - Semua nilai dibulatkan ke atas kelipatan 100 dan diformat ke dalam format Rupiah.
     */
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

    /**
     * Method ini akan dipanggil setiap kali anggota_id berubah.
     * Mengecek apakah anggota yang dipilih sudah memiliki unit konsumsi aktif.
     * Jika ada, set $unitKonsumsiAktif ke true, jika tidak set ke false.
     */
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
    }

    /**
     * Merender tampilan Livewire untuk form pengajuan unit konsumsi.
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.pengurus.form-create-pengajuan-unit-konsumsi');
    }
}
