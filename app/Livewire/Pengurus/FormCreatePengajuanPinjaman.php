<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\Persentase;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use App\Models\Angsuran;

/**
 * Komponen Livewire untuk membuat formulir pengajuan pinjaman oleh pengurus.
 * 
 * Komponen ini memungkinkan pengurus:
 * - Memilih anggota.
 * - Mengisi jumlah pinjaman dan lama angsuran.
 * - Secara otomatis menghitung:
 *   - Nominal pokok angsuran.
 *   - Nominal bunga.
 *   - Nominal angsuran per bulan.
 *   - Biaya administrasi.
 *   - Total pinjaman setelah dipotong biaya admin.
 * - Mengecek apakah anggota masih memiliki pinjaman aktif.
 */
class FormCreatePengajuanPinjaman extends Component
{
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
    public $error_jumlah_pinjaman = '';
    public $disabled_jumlah_pinjaman = false;
    public $disabled = false;
    public $kurangAngsuran = '';
    public $kompen = '';

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

    public function resetPerhitungan()
    {
        $this->reset([
            'jumlah_pinjaman',
            'lama_angsuran',
            'nominal_pokok',
            'nominal_bunga',
            'nominal_angsuran',
            'biaya_admin',
            'total_pinjaman',
            'kompen',
        ]);
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

    public function updatedJumlahPinjaman()
    {
        $jumlahPinjaman = (int) str_replace(['Rp', '.', ','], '', $this->jumlah_pinjaman);

        $kurangAngsuran = Angsuran::whereHas('pinjaman.pengajuan_pinjaman', function ($query) {
            $query->where('anggota_id', $this->anggota_id);
        })
        ->orderBy('created_at', 'desc')
        ->value('kurang_angsuran'); 

        // dd($kurangAngsuran);
        if (empty($this->jumlah_pinjaman) || $jumlahPinjaman < $kurangAngsuran) {
            $this->error_jumlah_pinjaman = '* Jumlah pinjaman tidak boleh kurang dari kurang angsuran yang belum dibayar! (Min: Rp ' . number_format($kurangAngsuran, 0, ',', '.') . ')';
            $this->disabled_jumlah_pinjaman = true;
        } else {
            $this->error_jumlah_pinjaman = '';
            $this->disabled_jumlah_pinjaman = false;
        }

        $this->kompen = "Rp " . number_format($jumlahPinjaman + (int) $kurangAngsuran, 0, ',', '.');

        $this->disabled();
    }

    /**
     * Melakukan perhitungan otomatis terkait pinjaman:
     * - Nominal pokok = jumlah pinjaman dibagi lama angsuran.
     * - Bunga dan biaya admin diambil dari tabel `persentase`.
     * - Semua nilai dibulatkan ke atas kelipatan 100 dan diformat ke dalam format Rupiah.
     */
    public function hitungPinjaman()
    {
        if (empty($this->jumlah_pinjaman) || empty($this->lama_angsuran)) {
            $this->reset(['nominal_pokok', 'nominal_bunga', 'nominal_angsuran', 'biaya_admin', 'total_pinjaman']);
            return;
        }

        $kurangAngsuran = Angsuran::whereHas('pinjaman.pengajuan_pinjaman', function ($query) {
            $query->where('anggota_id', $this->anggota_id);
        })
        ->orderBy('created_at', 'desc')
        ->value('kurang_angsuran');

        $jumlahPinjaman = (int) str_replace(['Rp', '.', ','], '', $this->jumlah_pinjaman);
        $lamaAngsuran = (int) preg_replace('/[^0-9]/', '', $this->lama_angsuran);

        $kompen = $jumlahPinjaman + (int) $kurangAngsuran;

        if ($kompen > 0 && $lamaAngsuran > 0) {
            $this->nominal_pokok = ceil(($kompen / $lamaAngsuran) / 100) * 100;

            $bunga_persen = Persentase::where('id', 3)->value('persentase');
            $biaya_admin_persen = Persentase::where('id', 2)->value('persentase');

            $this->nominal_bunga = ceil(($kompen * $bunga_persen) / 100) * 100;
            $this->nominal_angsuran = ceil(($this->nominal_pokok + $this->nominal_bunga) / 100) * 100;
            $this->biaya_admin = ceil(($kompen * $biaya_admin_persen) / 100) * 100;
            $this->total_pinjaman = ceil(($kompen - $this->biaya_admin - $kurangAngsuran) / 100) * 100;

            $this->nominal_pokok = "Rp " . number_format($this->nominal_pokok, 0, ',', '.');
            $this->nominal_bunga = "Rp " . number_format($this->nominal_bunga, 0, ',', '.');
            $this->nominal_angsuran = "Rp " . number_format($this->nominal_angsuran, 0, ',', '.');
            $this->biaya_admin = "Rp " . number_format($this->biaya_admin, 0, ',', '.');
            $this->total_pinjaman = "Rp " . number_format($this->total_pinjaman, 0, ',', '.');

            // dd($this->nominal_pokok, $this->nominal_bunga, $this->nominal_angsuran, $this->biaya_admin, $this->total_pinjaman);
        } else {
            $this->reset(['nominal_pokok', 'nominal_bunga', 'nominal_angsuran', 'biaya_admin', 'total_pinjaman']);
        }
    }

    /**
     * Mengecek apakah anggota yang dipilih memiliki pinjaman aktif.
     * Pinjaman aktif didefinisikan sebagai pinjaman dengan status "dalam pembayaran".
     * Jika iya, maka akan mengatur $pinjamanAktif menjadi true.
     */
    public function updatedAnggotaId()
    {
        if ($this->anggota_id) {
            $this->pinjamanAktif = Pinjaman::whereHas('pengajuan_pinjaman', function ($query) {
                    $query->where('anggota_id', $this->anggota_id);
                })
                ->where('status', 'dalam pembayaran')
                ->exists();

            $pengajuanPinjaman = PengajuanPinjaman::where('anggota_id', $this->anggota_id)
                ->orderBy('created_at', 'desc')
                ->value('total_pinjaman');

            $kurangAngsuran = Angsuran::whereHas('pinjaman.pengajuan_pinjaman', function ($query) {
                $query->where('anggota_id', $this->anggota_id);
            })
            ->orderBy('created_at', 'desc')
            ->value('kurang_angsuran'); 

            $jumlahPinjaman = (int) str_replace(['Rp', '.', ','], '', $this->jumlah_pinjaman);

            $this->kurangAngsuran = "Rp " . number_format($kurangAngsuran, 0, ',', '.');

            $this->kompen = "Rp " . number_format($jumlahPinjaman + (int)$kurangAngsuran, 0, ',', '.');
        } else {
            $this->pinjamanAktif = false;
        }

        $this->resetPerhitungan();
        // $this->disabled();
    }

    /**
     * Mengatur status disabled untuk tombol submit.
     * Jika anggota memiliki pinjaman aktif atau lama angsuran tidak valid, tombol akan dinonaktifkan.
     */
    public function disabled()
    {
        if ($this->disabled_lama_angsuran || $this->disabled_jumlah_pinjaman) {
            $this->disabled = true;
        } else {
            $this->disabled = false;
        }
    }

    /**
     * Merender tampilan Livewire untuk form pengajuan pinjaman.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.pengurus.form-create-pengajuan-pinjaman');
    }
}
