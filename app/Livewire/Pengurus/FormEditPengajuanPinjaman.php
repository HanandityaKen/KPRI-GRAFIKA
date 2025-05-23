<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\Persentase;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;

/**
 * Komponen Livewire untuk form edit pengajuan pinjaman.
 * 
 * Fitur:
 * - Menampilkan dropdown anggota dengan nama dan ID
 * - Mengambil data pengajuan pinjaman berdasarkan id
 * - Validasi inputan untuk memastikan tidak ada yang kosong di setiap field
 * - Menghitung nominal pokok, bunga, angsuran, biaya admin, dan total pinjaman
 * - Menangani status disabled untuk tombol submit
 * - Menangani status aktif pinjaman untuk anggota
 * 
 * Properti:
 * - $pinjaman: Model pengajuan pinjaman yang sedang diedit
 * - $namaList: Daftar nama anggota untuk dropdown
 * - $anggota_id: ID anggota yang dipilih
 * - $jumlah_pinjaman: Jumlah pinjaman yang diminta
 * - $lama_angsuran: Lama angsuran dalam bulan
 * - $nominal_pokok: Nominal pokok pinjaman
 * - $nominal_bunga: Nominal bunga pinjaman
 * - $nominal_angsuran: Nominal angsuran per bulan
 * - $biaya_admin: Biaya admin pinjaman
 * - $total_pinjaman: Total pinjaman setelah dikurangi biaya admin
 * - $pinjamanAktif: Status apakah anggota memiliki pinjaman aktif
 * 
 * Metode:
 * - mount: Inisialisasi data awal saat komponen dimuat
 * - updated: Memanggil metode hitungPinjaman saat ada perubahan pada jumlah pinjaman atau lama angsuran
 * - hitungPinjaman: Menghitung nominal pokok, bunga, angsuran, biaya admin, dan total pinjaman
 * - updatedAnggotaId: Memeriksa apakah anggota memiliki pinjaman aktif saat anggota dipilih
 * - getFormattedJumlahPinjamanProperty: Mengembalikan format jumlah pinjaman yang diformat
 * - render: Mengembalikan tampilan komponen
 */
class FormEditPengajuanPinjaman extends Component
{
    /**
     * Komponen untuk form edit pengajuan pinjaman.
     * 
     * Properti:
     * - $pinjaman: Model pengajuan pinjaman yang sedang diedit
     * - $namaList: Daftar nama anggota untuk dropdown
     * - $anggota_id: ID anggota yang dipilih
     * - $jumlah_pinjaman: Jumlah pinjaman yang diminta
     * - $lama_angsuran: Lama angsuran dalam bulan
     * - $nominal_pokok: Nominal pokok pinjaman
     * - $nominal_bunga: Nominal bunga pinjaman
     * - $nominal_angsuran: Nominal angsuran per bulan
     * - $biaya_admin: Biaya admin pinjaman
     * - $total_pinjaman: Total pinjaman setelah dikurangi biaya admin
     * - $pinjamanAktif: Status apakah anggota memiliki pinjaman aktif
     */
    public $pinjaman;
    public $namaList = [];
    public $anggota_id = '';
    public $jumlah_pinjaman = '';
    public $lama_angsuran = '';
    public $nominal_pokok = '';
    public $nominal_bunga = '';
    public $nominal_angsuran = '';
    public $biaya_admin = '';
    public $total_pinjaman = '';
    public $pinjamanAktif = false;
    public $error_lama_angsuran = '';
    public $disabled_lama_angsuran = false;
    public $disabled = false;

    /**
     * Lifecycle hook untuk inisialisasi data awal.
     * 
     * @param int $id ID pengajuan pinjaman yang akan diedit.
     */
    public function mount($id)
    {
        $this->pinjaman = PengajuanPinjaman::findOrFail($id);
        $this->namaList = Anggota::pluck('nama', 'id')->toArray();
        $this->anggota_id = $this->pinjaman->anggota_id;
        $this->jumlah_pinjaman = "Rp " . number_format($this->pinjaman->jumlah_pinjaman, 0, ',', '.');
        preg_match('/\d+/', $this->pinjaman->lama_angsuran, $matches);
        $this->lama_angsuran = $matches[0] ?? null;
        $this->hitungPinjaman();
    }

    /**
     * Method ini akan otomatis dipanggil oleh Livewire
     * setiap ada perubahan nilai pada properti apa pun.
     * Di sini hanya tangani perubahan pada jumlah pinjaman dan lama angsuran.
     *
     * @param string $propertyName
     */
    public function updated($propertyName)
    {
        if ($propertyName === 'lama_angsuran') {
            $this->limitLamaAngsuran();
        }

        if (in_array($propertyName, ['jumlah_pinjaman', 'lama_angsuran'])) {
            $this->hitungPinjaman();
        }
    }

    /**
     * Method ini akan membatasi lama angsuran yang dapat dipilih.
     * Jika lama angsuran lebih dari 12 bulan, setel ke 12 bulan.
     */
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

    /**
     * Method ini akan dipanggil setiap kali nilai jumlah pinjaman atau lama angsuran berubah.
     * Menghitung nominal pokok, bunga, angsuran, biaya admin, dan total pinjaman.
     */
    public function hitungPinjaman()
    {
        if (empty($this->jumlah_pinjaman) || empty($this->lama_angsuran)) {
            $this->reset(['nominal_pokok', 'nominal_bunga', 'nominal_angsuran', 'biaya_admin', 'total_pinjaman']);
            return;
        }

        $jumlahPinjaman = (int) str_replace(['Rp', '.', ','], '', $this->jumlah_pinjaman);
        $lamaAngsuran = (int) preg_replace('/[^0-9]/', '', $this->lama_angsuran);

        if ($jumlahPinjaman > 0 && $lamaAngsuran > 0) {
            $this->nominal_pokok = ceil(($jumlahPinjaman / $lamaAngsuran) / 100) * 100;

            $bunga_persen = Persentase::where('id', 3)->value('persentase');
            $biaya_admin_persen = Persentase::where('id', 2)->value('persentase');

            $this->nominal_bunga = ceil(($jumlahPinjaman * $bunga_persen) / 100) * 100;
            $this->nominal_angsuran = ceil(($this->nominal_pokok + $this->nominal_bunga) / 100) * 100;
            $this->biaya_admin = ceil(($jumlahPinjaman * $biaya_admin_persen) / 100) * 100;
            $this->total_pinjaman = ceil(($jumlahPinjaman - $this->biaya_admin) / 100) * 100;

            $this->nominal_pokok = "Rp " . number_format($this->nominal_pokok, 0, ',', '.');
            $this->nominal_bunga = "Rp " . number_format($this->nominal_bunga, 0, ',', '.');
            $this->nominal_angsuran = "Rp " . number_format($this->nominal_angsuran, 0, ',', '.');
            $this->biaya_admin = "Rp " . number_format($this->biaya_admin, 0, ',', '.');
            $this->total_pinjaman = "Rp " . number_format($this->total_pinjaman, 0, ',', '.');
        } else {
            $this->reset(['nominal_pokok', 'nominal_bunga', 'nominal_angsuran', 'biaya_admin', 'total_pinjaman']);
        }
    }

    /**
     * Validasi real-time saat anggota diubah.
     * Memeriksa apakah anggota memiliki pinjaman aktif.
     */
    public function updatedAnggotaId()
    {
        if ($this->anggota_id) {
            $this->pinjamanAktif = Pinjaman::whereHas('pengajuan_pinjaman', function ($query) {
                    $query->where('anggota_id', $this->anggota_id);
                })
                ->where('status', 'dalam pembayaran')
                ->exists();
        } else {
            $this->pinjamanAktif = false;
        }

        $this->disabled();
    }

    /**
     * Mengembalikan format jumlah pinjaman yang diformat.
     * 
     * @return string
     */
    public function getFormattedJumlahPinjamanProperty()
    {
        return "Rp " . number_format($this->jumlah_pinjaman, 0, ',', '.');
    }

    /**
     * Mengatur status disabled untuk tombol submit.
     * Jika anggota memiliki pinjaman aktif atau lama angsuran tidak valid, tombol akan dinonaktifkan.
     */
    public function disabled()
    {
        if ($this->pinjamanAktif || $this->disabled_lama_angsuran) {
            $this->disabled = true;
        } else {
            $this->disabled = false;
        }
    }


    /**
     * Merender tampilan Livewire untuk form edit pengajuan pinjaman.
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.pengurus.form-edit-pengajuan-pinjaman');
    }
}
