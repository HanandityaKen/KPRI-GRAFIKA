<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KasHarian;
use App\Models\Angsuran;
use App\Models\Anggota;
use Carbon\Carbon;

class FormBayarAngsuran extends Component
{
    public $angsuran;
    public $angsuranManual = '';
    public $error_angsuran_manual;
    public $disabled = false;
    public $jasa = 0;
    public $tanggal;

    // List Pengurus
    public $anggotaList = [];

    public function mount($id)
    {
        $this->tanggal = now()->format('d-m-Y');
        $this->angsuran = Angsuran::findOrFail($id);
        $this->cekJasa();

        $this->anggotaList = Anggota::where('posisi', 'pengurus')->pluck('nama', 'id')->toArray();
    }

    public function updatedAngsuranManual()
    {
        $angsuranManual = (int) str_replace(['Rp', '.', ','], '', $this->angsuranManual);
        $kurangAngsuran = Angsuran::where('id', $this->angsuran->id)->value('kurang_angsuran');
        $tunggakan = Angsuran::where('id', $this->angsuran->id)->value('tunggakan');

        // dd($angsuranManual, $kurangAngsuran, $tunggakan);

        if ($angsuranManual > $kurangAngsuran + $tunggakan) {
            $this->error_angsuran_manual = '* Angsuran manual tidak boleh lebih besar dari kurang angsuran! (Maks: Rp ' . number_format($kurangAngsuran + $tunggakan, 0, ',', '.') . ')';
            $this->disabled = true;
        } else {
            $this->error_angsuran_manual = '';
            $this->disabled = false;
        }
    }

    public function updatedTanggal()
    {
        $this->cekJasa();
    }

    public function cekJasa()
    {
        $pinjamanId = $this->angsuran->pinjaman->id;

        $selectedTanggal = Carbon::createFromFormat('d-m-Y', $this->tanggal);
        $bulan = $selectedTanggal->month;
        $tahun = $selectedTanggal->year;

        $cekKasHarian = KasHarian::where('pinjaman_id', $pinjamanId)
            ->where('jenis_transaksi', 'kas masuk')
            ->where('keterangan', 'Bayar Angsuran Pinjaman')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->first();

        if ($cekKasHarian) {
            // Sudah bayar di bulan ini
            $this->jasa = "Rp " . number_format(0, 0, ',', '.');
        } else {
            // Belum bayar di bulan ini
            $this->jasa = "Rp " . number_format($this->angsuran->pinjaman->pengajuan_pinjaman->nominal_bunga, 0, ',', '.');
        }
    }

    public function render()
    {
        return view('livewire.form-bayar-angsuran');
    }
}
