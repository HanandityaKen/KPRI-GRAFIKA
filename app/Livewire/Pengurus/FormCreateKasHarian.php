<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use App\Models\Angsuran;

class FormCreateKasHarian extends Component
{
    public $namaList = [];
    public $anggota_id = '';
    public $angsuran = 0;
    public $jasa = 0;
    public $angsuranList = [];
    public $jasaList = [];
    public $hasAngsuran = false;

    public function mount()
    {
        $this->namaList = Anggota::pluck('nama', 'id');
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'anggota_id') {
            $this->getAngsuranJasa();
        }
    }

    public function getAngsuranJasa()
    {
        // dd($this->anggota_id);
        if ($this->anggota_id) {
            $pengajuan = PengajuanPinjaman::where('anggota_id', $this->anggota_id)
                ->where('status', 'disetujui')
                ->latest()
                ->first();

            if ($pengajuan) {
                $pinjaman = Pinjaman::where('pengajuan_pinjaman_id', $pengajuan->id)
                    ->where('status', 'dalam pembayaran') // Pinjaman dalam proses
                    ->first();

                if ($pinjaman) {
                    $angsuran = Angsuran::where('pinjaman_id', $pinjaman->id)
                        ->where(function ($query) {
                            $query->where('kurang_angsuran', '>', 0)
                                ->orWhere('kurang_jasa', '>', 0);
                        })
                        ->exists();

                        if ($angsuran) {
                            $this->hasAngsuran = true;
                            $this->angsuranList = [
                                0 => "Rp 0",
                                $pengajuan->nominal_angsuran => "Rp " . number_format($pengajuan->nominal_pokok, 0, ',', '.')
                            ];
                            $this->jasaList = [
                                0 => "Rp 0",
                                $pengajuan->nominal_bunga => "Rp " . number_format($pengajuan->nominal_bunga, 0, ',', '.')
                            ];
                            return;
                        }
                }
            }
        }

        $this->hasAngsuran = false;
        $this->angsuranList = [0 => "Rp 0"];
        $this->jasaList = [0 => "Rp 0"];
        $this->angsuran = 0;
        $this->jasa = 0;
    }

    public function render()
    {
        return view('livewire.pengurus.form-create-kas-harian');
    }
}
