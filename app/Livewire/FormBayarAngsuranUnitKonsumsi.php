<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KasHarian;
use App\Models\AngsuranUnitKonsumsi;
use App\Models\Anggota;
use Carbon\Carbon;

class FormBayarAngsuranUnitKonsumsi extends Component
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
        $this->angsuran = AngsuranUnitKonsumsi::findOrFail($id);

        $this->anggotaList = Anggota::where('posisi', 'pengurus')->pluck('nama', 'id')->toArray();

        $this->cekJasa();
    }

    public function updatedAngsuranManual()
    {
        $angsuranManual = (int) str_replace(['Rp', '.', ','], '', $this->angsuranManual);
        $kurangAngsuran = AngsuranUnitKonsumsi::where('id', $this->angsuran->id)->value('kurang_angsuran');
        $tunggakan = AngsuranUnitKonsumsi::where('id', $this->angsuran->id)->value('tunggakan');

        if ($angsuranManual > $kurangAngsuran + $tunggakan) {
            $this->error_angsuran_manual = '* Angsuran manual tidak boleh lebih besar dari kurang angsuran! (Maks: Rp ' . number_format($kurangAngsuran + $tunggakan, 0, ',', '.') . ')';
            $this->disabled = true;
        } else {
            $this->error_angsuran_manual = '';
            $this->disabled = false;
        }

        $this->cekJasa();
    }

    public function updatedTanggal()
    {
        $this->cekJasa();
    }

    public function cekJasa()
    {
        $angsuranManual = (int) str_replace(['Rp', '.', ','], '', $this->angsuranManual);
        $kurangAngsuran = AngsuranUnitKonsumsi::where('id', $this->angsuran->id)->value('kurang_angsuran');
        $tunggakan = AngsuranUnitKonsumsi::where('id', $this->angsuran->id)->value('tunggakan');

        $unitKonsumsiId = $this->angsuran->unit_konsumsi->id;

        $selectedTanggal = Carbon::createFromFormat('d-m-Y', $this->tanggal);
        $bulan = $selectedTanggal->month;
        $tahun = $selectedTanggal->year;

        $cekKasHarian = KasHarian::where('unit_konsumsi_id', $unitKonsumsiId)
            ->where('jenis_transaksi', 'kas masuk')
            ->where('keterangan', 'Bayar Angsuran Unit atau Barang Konsumsi')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->first();

        if ($cekKasHarian) {
            $this->jasa = "Rp " . number_format(0, 0, ',', '.');
        } else {
            if ($angsuranManual === ($kurangAngsuran + $tunggakan)) {
                $this->jasa = "Rp " . number_format($this->angsuran->kurang_jasa, 0, ',', '.');
            } else {
                $this->jasa = "Rp " . number_format($this->angsuran->unit_konsumsi->pengajuan_unit_konsumsi->nominal_bunga, 0, ',', '.');
            }
        }
    }

    public function render()
    {
        return view('livewire.form-bayar-angsuran-unit-konsumsi');
    }
}
