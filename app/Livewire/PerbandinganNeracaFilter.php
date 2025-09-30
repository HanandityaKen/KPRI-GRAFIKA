<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PerhitunganNeraca;
use App\Models\Neraca;
use App\Exports\PerbandinganNeracaExport;
use Maatwebsite\Excel\Facades\Excel;

class PerbandinganNeracaFilter extends Component
{
    public $selectedYear;

    public $availableYears = [];

    public $tahunSebelumnya = '';

    // Aktiva Lancar
    public $kasPrev = 0;
    public $kasCurr = 0;

    public $bankPrev = 0;
    public $bankCurr = 0;

    public $piutangPrev = 0;
    public $piutangCurr = 0;

    public $persediaanPeralatanPrev = 0;
    public $persediaanPeralatanCurr = 0;

    public $akumulasiPenyusutanPeralatanPrev = 0;
    public $akumulasiPenyusutanPeralatanCurr = 0;

    public $pendapatanYmhDiterimaPrev = 0;
    public $pendapatanYmhDiterimaCurr = 0;

    public $simpManasukaDiPkpriPrev = 0;
    public $simpManasukaDiPkpriCurr = 0;

    public $jumlahAktivaLancarPrev = 0;
    public $jumlahAktivaLancarCurr = 0;

    //Kewajiban Lancar
    public $pendapatanDiterimaLebihDahuluPrev = 0;
    public $pendapatanDiterimaLebihDahuluCurr = 0;

    public $kewajibanTitipanPrev = 0;
    public $kewajibanTitipanCurr = 0;

    public $pajakYmhDibayarPrev = 0;
    public $pajakYmhDibayarCurr = 0;

    public $jasaPartisipasiAnggotaPrev = 0;
    public $jasaPartisipasiAnggotaCurr = 0;

    public $danaPengurusPrev = 0;
    public $danaPengurusCurr = 0;

    public $danaKaryawanPrev = 0;
    public $danaKaryawanCurr = 0;

    public $danaPendidikanPrev = 0;
    public $danaPendidikanCurr = 0;

    public $danaSosialPrev = 0;
    public $danaSosialCurr = 0;

    public $tabunganQurbanPrev = 0;
    public $tabunganQurbanCurr = 0;

    public $simpManasukaAnggotaPrev = 0;
    public $simpManasukaAnggotaCurr = 0;

    public $simpWajibPinjamAnggotaPrev = 0;
    public $simpWajibPinjamAnggotaCurr = 0;

    public $jumlahKewajibanLancarPrev = 0;
    public $jumlahKewajibanLancarCurr = 0;

    //Penyertaan
    public $tabunganDiPkpriPrev = 0;
    public $tabunganDiPkpriCurr = 0;

    public $simpPokokDiPkpriPrev = 0;
    public $simpPokokDiPkpriCurr = 0;

    public $sipWajibDiPkpriPrev = 0;
    public $sipWajibDiPkpriCurr = 0;

    public $simpKhususDiPkpriPrev = 0;
    public $simpKhususDiPkpriCurr = 0;

    public $simpWajibPinjamDiPkpriPrev = 0;
    public $simpWajibPinjamDiPkpriCurr = 0;

    public $skpbPrev = 0;
    public $skpbCurr = 0;

    public $penyertaanDiHotelPkpriPrev = 0;
    public $penyertaanDiHotelPkpriCurr = 0;

    public $penyertaanDiKopenPrev = 0;
    public $penyertaanDiKopenCurr = 0;

    public $penyertaanDiUnitKonsumsiPrev = 0;
    public $penyertaanDiUnitKonsumsiCurr = 0;

    public $jumlahPenyertaanPrev = 0;
    public $jumlahPenyertaanCurr = 0;

    //Kekayaan
    public $donasiPrev = 0;
    public $donasiCurr = 0;

    public $simpPokokAnggotaPrev = 0;
    public $simpPokokAnggotaCurr = 0;

    public $simpWajibAnggotaPrev = 0;
    public $simpWajibAnggotaCurr = 0;

    public $cadanganPrev = 0;
    public $cadanganCurr = 0;

    public $shuPrev = 0;
    public $shuCurr = 0;

    public $jumlahKekayaanPrev = 0;
    public $jumlahKekayaanCurr = 0;

    // Aktiva Tetap
    public $tanahPrev = 0;
    public $tanahCurr = 0;

    // Tabel Kiri
    public $jumlahTotalKiriPrev = 0;
    public $jumlahTotalKiriCurr = 0;

    // Tabel Kanan
    public $jumlahTotalKananPrev = 0;
    public $jumlahTotalKananCurr = 0;

    public function mount()
    {   
        $this->availableYears = PerhitunganNeraca::select('tahun')
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

        $this->getTahunSebelumnya();
        $this->getNeraca();
    }

    public function updatedSelectedYear()
    {
        $this->getTahunSebelumnya();
        $this->getNeraca();
    }

    private function getNeraca()
    {
        $neracaPrev = Neraca::where('tahun', $this->tahunSebelumnya)->first();
        $neracaCurr = Neraca::where('tahun', $this->selectedYear)->first();

        // Aktiva Lancar
        $this->kasPrev = $neracaPrev?->kas ?? 0;
        $this->kasCurr = $neracaCurr?->kas ?? 0;

        $this->bankPrev = $neracaPrev?->bank ?? 0;
        $this->bankCurr = $neracaCurr?->bank ?? 0;
        
        $this->piutangPrev = $neracaPrev?->piutang ?? 0;
        $this->piutangCurr = $neracaCurr?->piutang ?? 0;

        $this->persediaanPeralatanPrev = $neracaPrev?->persediaan_barang ?? 0;
        $this->persediaanPeralatanCurr = $neracaCurr?->persediaan_barang ?? 0;

        $this->akumulasiPenyusutanPeralatanPrev = $neracaPrev?->akumulasi_penyusutan_peralatan ?? 0;
        $this->akumulasiPenyusutanPeralatanCurr = $neracaCurr?->akumulasi_penyusutan_peralatan ?? 0;

        $this->pendapatanYmhDiterimaPrev = $neracaPrev?->pendapatan_ymh_diterima ?? 0;
        $this->pendapatanYmhDiterimaCurr = $neracaCurr?->pendapatan_ymh_diterima ?? 0;

        $this->simpManasukaDiPkpriPrev = $neracaPrev?->simpanan_manasuka_pkpri ?? 0;
        $this->simpManasukaDiPkpriCurr = $neracaCurr?->simpanan_manasuka_pkpri ?? 0;

        $this->jumlahAktivaLancarPrev = $this->kasPrev + $this->bankPrev + $this->piutangPrev + $this->persediaanPeralatanPrev + $this->akumulasiPenyusutanPeralatanPrev + $this->pendapatanYmhDiterimaPrev + $this->simpManasukaDiPkpriPrev;
        $this->jumlahAktivaLancarCurr = $this->kasCurr + $this->bankCurr + $this->piutangCurr + $this->persediaanPeralatanCurr + $this->akumulasiPenyusutanPeralatanCurr + $this->pendapatanYmhDiterimaCurr + $this->simpManasukaDiPkpriCurr;

        // Kewajiban Lancar
        $this->pendapatanDiterimaLebihDahuluPrev = $neracaPrev?->pendapatan_diterima_lebih_dahulu ?? 0;
        $this->pendapatanDiterimaLebihDahuluCurr = $neracaCurr?->pendapatan_diterima_lebih_dahulu ?? 0;

        $this->kewajibanTitipanPrev = $neracaPrev?->kewajiban_titipan ?? 0;
        $this->kewajibanTitipanCurr = $neracaCurr?->kewajiban_titipan ?? 0;

        $this->pajakYmhDibayarPrev = $neracaPrev?->beban_pajak_belum_dibayar ?? 0;
        $this->pajakYmhDibayarCurr = $neracaCurr?->beban_pajak_belum_dibayar ?? 0;

        $this->jasaPartisipasiAnggotaPrev = $neracaPrev?->jasa_partisipasi ?? 0;
        $this->jasaPartisipasiAnggotaCurr = $neracaCurr?->jasa_partisipasi ?? 0;

        $this->danaPengurusPrev = $neracaPrev?->dana_pengurus ?? 0;
        $this->danaPengurusCurr = $neracaCurr?->dana_pengurus ?? 0;

        $this->danaKaryawanPrev = $neracaPrev?->dana_karyawan ?? 0;
        $this->danaKaryawanCurr = $neracaCurr?->dana_karyawan ?? 0;

        $this->danaPendidikanPrev = $neracaPrev?->dana_pendidikan ?? 0;
        $this->danaPendidikanCurr = $neracaCurr?->dana_pendidikan ?? 0;

        $this->danaSosialPrev = $neracaPrev?->dana_sosial ?? 0;
        $this->danaSosialCurr = $neracaCurr?->dana_sosial ?? 0;

        $this->tabunganQurbanPrev = $neracaPrev?->tabungan_qurban ?? 0;
        $this->tabunganQurbanCurr = $neracaCurr?->tabungan_qurban ?? 0;

        $this->simpManasukaAnggotaPrev = $neracaPrev?->simpanan_manasuka ?? 0;
        $this->simpManasukaAnggotaCurr = $neracaCurr?->simpanan_manasuka ?? 0;

        $this->simpWajibPinjamAnggotaPrev = $neracaPrev?->simpanan_khusus_swp ?? 0;
        $this->simpWajibPinjamAnggotaCurr = $neracaCurr?->simpanan_khusus_swp ?? 0;

        $this->jumlahKewajibanLancarPrev = $this->pendapatanDiterimaLebihDahuluPrev + $this->kewajibanTitipanPrev + $this->pajakYmhDibayarPrev + $this->jasaPartisipasiAnggotaPrev + $this->danaPengurusPrev + $this->danaKaryawanPrev + $this->danaPendidikanPrev + $this->danaSosialPrev + $this->tabunganQurbanPrev + $this->simpManasukaAnggotaPrev + $this->simpWajibPinjamAnggotaPrev;
        $this->jumlahKewajibanLancarCurr = $this->pendapatanDiterimaLebihDahuluCurr + $this->kewajibanTitipanCurr + $this->pajakYmhDibayarCurr + $this->jasaPartisipasiAnggotaCurr + $this->danaPengurusCurr + $this->danaKaryawanCurr + $this->danaPendidikanCurr + $this->danaSosialCurr + $this->tabunganQurbanCurr + $this->simpManasukaAnggotaCurr + $this->simpWajibPinjamAnggotaCurr;

        // Penyertaan
        $this->tabunganDiPkpriPrev = $neracaPrev?->tabungan_di_pkpri ?? 0;
        $this->tabunganDiPkpriCurr = $neracaCurr?->tabungan_di_pkpri ?? 0;

        $this->simpPokokDiPkpriPrev = $neracaPrev?->simpanan_pokok_pkpri ?? 0;
        $this->simpPokokDiPkpriCurr = $neracaCurr?->simpanan_pokok_pkpri ?? 0;

        $this->sipWajibDiPkpriPrev = $neracaPrev?->simpanan_wajib_pkpri ?? 0;
        $this->sipWajibDiPkpriCurr = $neracaCurr?->simpanan_wajib_pkpri ?? 0;

        $this->simpKhususDiPkpriPrev = $neracaPrev?->simp_khusus_pkpri ?? 0;
        $this->simpKhususDiPkpriCurr = $neracaCurr?->simp_khusus_pkpri ?? 0;
        
        $this->simpWajibPinjamDiPkpriPrev = $neracaPrev?->simp_khusus_swp ?? 0;
        $this->simpWajibPinjamDiPkpriCurr = $neracaCurr?->simp_khusus_swp ?? 0;

        $this->skpbPrev = $neracaPrev?->skpb ?? 0;
        $this->skpbCurr = $neracaCurr?->skpb ?? 0;

        $this->penyertaanDiHotelPkpriPrev = $neracaPrev?->penyertaan_di_hotel_pkpri ?? 0;
        $this->penyertaanDiHotelPkpriCurr = $neracaCurr?->penyertaan_di_hotel_pkpri ?? 0;

        $this->penyertaanDiKopenPrev = $neracaPrev?->penyertaan_di_kopen ?? 0;
        $this->penyertaanDiKopenCurr = $neracaCurr?->penyertaan_di_kopen ?? 0;

        $this->penyertaanDiUnitKonsumsiPrev = $neracaPrev?->penyertaan_unit_konsumsi ?? 0;
        $this->penyertaanDiUnitKonsumsiCurr = $neracaCurr?->penyertaan_unit_konsumsi ?? 0;

        $this->jumlahPenyertaanPrev = $this->tabunganDiPkpriPrev + $this->simpPokokDiPkpriPrev + $this->sipWajibDiPkpriPrev + $this->simpKhususDiPkpriPrev + $this->simpWajibPinjamDiPkpriPrev + $this->skpbPrev + $this->penyertaanDiHotelPkpriPrev + $this->penyertaanDiKopenPrev + $this->penyertaanDiUnitKonsumsiPrev;
        $this->jumlahPenyertaanCurr = $this->tabunganDiPkpriCurr + $this->simpPokokDiPkpriCurr + $this->sipWajibDiPkpriCurr + $this->simpKhususDiPkpriCurr + $this->simpWajibPinjamDiPkpriCurr + $this->skpbCurr + $this->penyertaanDiHotelPkpriCurr + $this->penyertaanDiKopenCurr + $this->penyertaanDiUnitKonsumsiCurr;

        // Kekayaan
        $this->donasiPrev = $neracaPrev?->donasi ?? 0;
        $this->donasiCurr = $neracaCurr?->donasi ?? 0;
        
        $this->simpPokokAnggotaPrev = $neracaPrev?->simpanan_pokok_anggota ?? 0;
        $this->simpPokokAnggotaCurr = $neracaCurr?->simpanan_pokok_anggota ?? 0;

        $this->simpWajibAnggotaPrev = $neracaPrev?->simpanan_wajib_anggota ?? 0;
        $this->simpWajibAnggotaCurr = $neracaCurr?->simpanan_wajib_anggota ?? 0;

        $this->cadanganPrev = $neracaPrev?->cadangan ?? 0;
        $this->cadanganCurr = $neracaCurr?->cadangan ?? 0;

        $this->shuPrev = $neracaPrev?->shu ?? 0;
        $this->shuCurr = $neracaCurr?->shu ?? 0;

        $this->jumlahKekayaanPrev = $this->donasiPrev + $this->simpPokokAnggotaPrev + $this->simpWajibAnggotaPrev + $this->cadanganPrev + $this->shuPrev;
        $this->jumlahKekayaanCurr = $this->donasiCurr + $this->simpPokokAnggotaCurr + $this->simpWajibAnggotaCurr + $this->cadanganCurr + $this->shuCurr;

        // Aktiva Tetap
        $this->tanahPrev = $neracaPrev?->tanah ?? 0;
        $this->tanahCurr = $neracaCurr?->tanah ?? 0;

        // Jumlah Total Tabel Kiri
        $this->jumlahTotalKiriPrev = $this->jumlahAktivaLancarPrev + $this->jumlahPenyertaanPrev + $this->tanahPrev;
        $this->jumlahTotalKiriCurr = $this->jumlahAktivaLancarCurr + $this->jumlahPenyertaanCurr + $this->tanahCurr;

        // Jumlah Total Tabel Kanan
        $this->jumlahTotalKananPrev = $this->jumlahKewajibanLancarPrev + $this->jumlahKekayaanPrev;
        $this->jumlahTotalKananCurr = $this->jumlahKewajibanLancarCurr + $this->jumlahKekayaanCurr;
    }

    private function getTahunSebelumnya()
    {
        $this->tahunSebelumnya = $this->selectedYear - 1;
    }

    public function exportExcel()
    {
        $selectedYear = $this->selectedYear;

        $filename = "PERBANDINGAN_NERACA_{$selectedYear}.xlsx";

        return Excel::download(new PerbandinganNeracaExport($selectedYear), $filename);
    }

    public function render()
    {
        return view('livewire.perbandingan-neraca-filter');
    }
}
