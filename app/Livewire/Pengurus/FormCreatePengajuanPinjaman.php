<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\Persentase;
use App\Models\Pinjaman;

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

    public function mount()
    {
        $this->namaList = Anggota::pluck('nama', 'id');
        $this->lama_angsuran = '';
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['jumlah_pinjaman', 'lama_angsuran'])) {
            $this->hitungPinjaman();
        }
    }

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

            // dd($this->nominal_pokok, $this->nominal_bunga, $this->nominal_angsuran, $this->biaya_admin, $this->total_pinjaman);
        } else {
            $this->reset(['nominal_pokok', 'nominal_bunga', 'nominal_angsuran', 'biaya_admin', 'total_pinjaman']);
        }
    }

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
    }

    public function render()
    {
        return view('livewire.pengurus.form-create-pengajuan-pinjaman');
    }
}
