<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shu;

class RencanaPerhitunganShuFilter extends Component
{
    public $selectedYear;

    public $availableYears = [];

    public $shu = 0;
    public $jasa_simpanan = 0;
    public $jasa_partisipasi = 0;
    public $dana_pengurus = 0;
    public $dana_karyawan = 0;
    public $dana_pendidikan = 0;
    public $dana_sosial = 0;
    public $cadangan = 0;

    public function mount()
    {
        $this->availableYears = Shu::select('tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun')
        ->toArray();

        $currentYear = now()->format('Y');

        // kalau tahun sekarang ada di database, pakai itu
        if (in_array($currentYear, $this->availableYears)) {
            $this->selectedYear = $currentYear;
        } else {
            // fallback ke tahun terbaru di database (karena orderBy desc, jadi [0])
            $this->selectedYear = $this->availableYears[0] ?? null;
        }

        $this->updateShu();
    }

    public function updatedSelectedYear()
    {
        $this->updateShu();
    }

    private function updateShu()
    {
        if ($this->selectedYear) {
            $this->shu = Shu::where('tahun', $this->selectedYear)->first();
        } else {
            $this->shu = null;
        }

        $this->hitungJasaSimpanan();
        $this->hitungJasaPartisipasi();
        $this->hitungDanaPengurus();
        $this->hitungDanaKaryawan();
        $this->hitungDanaPendidikan();
        $this->hitungDanaSosial();
        $this->hitungCadangan();
    }

    private function hitungJasaSimpanan()
    {
        $jumlah_shu = $this->shu->jumlah_shu;

        $this->jasa_simpanan = $jumlah_shu * (25/100);
    }

    private function hitungJasaPartisipasi()
    {
        $jumlah_shu = $this->shu->jumlah_shu;

        $this->jasa_partisipasi = $jumlah_shu * (20/100);
    }

    private function hitungDanaPengurus()
    {
        $jumlah_shu = $this->shu->jumlah_shu;

        $this->dana_pengurus = $jumlah_shu * (10/100);
    }

    private function hitungDanaKaryawan()
    {
        $jumlah_shu = $this->shu->jumlah_shu;

        $this->dana_karyawan = $jumlah_shu * (5/100);
    }

    private function hitungDanaPendidikan()
    {
        $jumlah_shu = $this->shu->jumlah_shu;

        $this->dana_pendidikan = $jumlah_shu * (5/100);
    }

    private function hitungDanaSosial()
    {
        $jumlah_shu = $this->shu->jumlah_shu;

        $this->dana_sosial = $jumlah_shu * (5/100);
    }

    private function hitungCadangan()
    {
        $jumlah_shu = $this->shu->jumlah_shu;

        $this->cadangan = $jumlah_shu * (30/100);
    }

    public function render()
    {
        return view('livewire.rencana-perhitungan-shu-filter');
    }
}
