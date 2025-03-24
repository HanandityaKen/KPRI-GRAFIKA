<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\Persentase;

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

    public function mount()
    {
        $this->namaList = Anggota::pluck('nama', 'id');
        $this->lama_angsuran = '';
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['nominal', 'lama_angsuran'])) {
            $this->hitungUnitKonsumsi();
        }
    }

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

    public function render()
    {
        return view('livewire.pengurus.form-create-pengajuan-unit-konsumsi');
    }
}
