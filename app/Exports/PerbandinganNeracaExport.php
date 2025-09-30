<?php

namespace App\Exports;

use App\Models\Neraca;
use App\Models\PerhitunganNeraca;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PerbandinganNeracaExport implements FromView, WithStyles
{
    protected $selectedYear;
    protected $tahunSebelumnya = '';

    public function __construct($selectedYear)
    {
        $this->selectedYear = $selectedYear;
    }

    private function getTahunSebelumnya()
    {
        $this->tahunSebelumnya = $this->selectedYear - 1;
    }

    public function view(): View
    {
        $this->getTahunSebelumnya();

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

        return view('exports.perbandingan-neraca', [
            'selectedYear'    => $this->selectedYear,
            'tahunSebelumnya' => $this->tahunSebelumnya,

            // Aktiva Lancar
            'kasPrev' => $this->kasPrev,
            'kasCurr' => $this->kasCurr,
            'bankPrev' => $this->bankPrev,
            'bankCurr' => $this->bankCurr,
            'piutangPrev' => $this->piutangPrev,
            'piutangCurr' => $this->piutangCurr,
            'persediaanPeralatanPrev' => $this->persediaanPeralatanPrev,
            'persediaanPeralatanCurr' => $this->persediaanPeralatanCurr,
            'akumulasiPenyusutanPeralatanPrev' => $this->akumulasiPenyusutanPeralatanPrev,
            'akumulasiPenyusutanPeralatanCurr' => $this->akumulasiPenyusutanPeralatanCurr,
            'pendapatanYmhDiterimaPrev' => $this->pendapatanYmhDiterimaPrev,
            'pendapatanYmhDiterimaCurr' => $this->pendapatanYmhDiterimaCurr,
            'simpManasukaDiPkpriPrev' => $this->simpManasukaDiPkpriPrev,
            'simpManasukaDiPkpriCurr' => $this->simpManasukaDiPkpriCurr,
            'jumlahAktivaLancarPrev' => $this->jumlahAktivaLancarPrev,
            'jumlahAktivaLancarCurr' => $this->jumlahAktivaLancarCurr,

            // Kewajiban Lancar
            'pendapatanDiterimaLebihDahuluPrev' => $this->pendapatanDiterimaLebihDahuluPrev,
            'pendapatanDiterimaLebihDahuluCurr' => $this->pendapatanDiterimaLebihDahuluCurr,
            'kewajibanTitipanPrev' => $this->kewajibanTitipanPrev,
            'kewajibanTitipanCurr' => $this->kewajibanTitipanCurr,
            'pajakYmhDibayarPrev' => $this->pajakYmhDibayarPrev,
            'pajakYmhDibayarCurr' => $this->pajakYmhDibayarCurr,
            'jasaPartisipasiAnggotaPrev' => $this->jasaPartisipasiAnggotaPrev,
            'jasaPartisipasiAnggotaCurr' => $this->jasaPartisipasiAnggotaCurr,
            'danaPengurusPrev' => $this->danaPengurusPrev,
            'danaPengurusCurr' => $this->danaPengurusCurr,
            'danaKaryawanPrev' => $this->danaKaryawanPrev,
            'danaKaryawanCurr' => $this->danaKaryawanCurr,
            'danaPendidikanPrev' => $this->danaPendidikanPrev,
            'danaPendidikanCurr' => $this->danaPendidikanCurr,
            'danaSosialPrev' => $this->danaSosialPrev,
            'danaSosialCurr' => $this->danaSosialCurr,
            'tabunganQurbanPrev' => $this->tabunganQurbanPrev,
            'tabunganQurbanCurr' => $this->tabunganQurbanCurr,
            'simpManasukaAnggotaPrev' => $this->simpManasukaAnggotaPrev,
            'simpManasukaAnggotaCurr' => $this->simpManasukaAnggotaCurr,
            'simpWajibPinjamAnggotaPrev' => $this->simpWajibPinjamAnggotaPrev,
            'simpWajibPinjamAnggotaCurr' => $this->simpWajibPinjamAnggotaCurr,
            'jumlahKewajibanLancarPrev' => $this->jumlahKewajibanLancarPrev,
            'jumlahKewajibanLancarCurr' => $this->jumlahKewajibanLancarCurr,

            // Penyertaan
            'tabunganDiPkpriPrev' => $this->tabunganDiPkpriPrev,
            'tabunganDiPkpriCurr' => $this->tabunganDiPkpriCurr,
            'simpPokokDiPkpriPrev' => $this->simpPokokDiPkpriPrev,
            'simpPokokDiPkpriCurr' => $this->simpPokokDiPkpriCurr,
            'sipWajibDiPkpriPrev' => $this->sipWajibDiPkpriPrev,
            'sipWajibDiPkpriCurr' => $this->sipWajibDiPkpriCurr,
            'simpKhususDiPkpriPrev' => $this->simpKhususDiPkpriPrev,
            'simpKhususDiPkpriCurr' => $this->simpKhususDiPkpriCurr,
            'simpWajibPinjamDiPkpriPrev' => $this->simpWajibPinjamDiPkpriPrev,
            'simpWajibPinjamDiPkpriCurr' => $this->simpWajibPinjamDiPkpriCurr,
            'skpbPrev' => $this->skpbPrev,
            'skpbCurr' => $this->skpbCurr,
            'penyertaanDiHotelPkpriPrev' => $this->penyertaanDiHotelPkpriPrev,
            'penyertaanDiHotelPkpriCurr' => $this->penyertaanDiHotelPkpriCurr,
            'penyertaanDiKopenPrev' => $this->penyertaanDiKopenPrev,
            'penyertaanDiKopenCurr' => $this->penyertaanDiKopenCurr,
            'penyertaanDiUnitKonsumsiPrev' => $this->penyertaanDiUnitKonsumsiPrev,
            'penyertaanDiUnitKonsumsiCurr' => $this->penyertaanDiUnitKonsumsiCurr,
            'jumlahPenyertaanPrev' => $this->jumlahPenyertaanPrev,
            'jumlahPenyertaanCurr' => $this->jumlahPenyertaanCurr,

            // Kekayaan
            'donasiPrev' => $this->donasiPrev,
            'donasiCurr' => $this->donasiCurr,
            'simpPokokAnggotaPrev' => $this->simpPokokAnggotaPrev,
            'simpPokokAnggotaCurr' => $this->simpPokokAnggotaCurr,
            'simpWajibAnggotaPrev' => $this->simpWajibAnggotaPrev,
            'simpWajibAnggotaCurr' => $this->simpWajibAnggotaCurr,
            'cadanganPrev' => $this->cadanganPrev,
            'cadanganCurr' => $this->cadanganCurr,
            'shuPrev' => $this->shuPrev,
            'shuCurr' => $this->shuCurr,
            'jumlahKekayaanPrev' => $this->jumlahKekayaanPrev,
            'jumlahKekayaanCurr' => $this->jumlahKekayaanCurr,

            // Aktiva Tetap
            'tanahPrev' => $this->tanahPrev,
            'tanahCurr' => $this->tanahCurr,

            // Jumlah Total
            'jumlahTotalKiriPrev' => $this->jumlahTotalKiriPrev,
            'jumlahTotalKiriCurr' => $this->jumlahTotalKiriCurr,
            'jumlahTotalKananPrev' => $this->jumlahTotalKananPrev,
            'jumlahTotalKananCurr' => $this->jumlahTotalKananCurr,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        // Merge judul
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()
            ->setBold(true)
            ->setSize(14)
            ->setName('Times New Roman');

        // AutoSize setiap kolom secara dinamis
        foreach ($sheet->getColumnIterator() as $column) {
            $colIndex = $column->getColumnIndex();
            $sheet->getColumnDimension($colIndex)->setAutoSize(true);
        }

        // Non-wrap agar teks tidak turun ke bawah
        $sheet->getStyle('A1:H' . $lastRow)->getAlignment()->setWrapText(false);

        // Tetapkan tinggi baris tetap
        $sheet->getDefaultRowDimension()->setRowHeight(20);

        // Font Times Roman
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Times New Roman')->setSize(12);

        // Style untuk header (baris ke-3 dan ke-4)
        $sheet->getStyle('A3:H4')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Border bawah antar baris data
        for ($row = 5; $row <= $lastRow; $row++) {
            $sheet->getStyle("A{$row}:H{$row}")->applyFromArray([
                'borders' => [
                    'allBorders' => [ 
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ]);
        }

        // Rata kanan C6 sampai D31 
        $sheet->getStyle('C6:D31')->getAlignment()->setHorizontal(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
        );

        // Rata kanan G6 sampai H31 
        $sheet->getStyle('G6:H31')->getAlignment()->setHorizontal(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
        );

        // Rata tengah A1 - A30
        $sheet->getStyle('A1:A30')->getAlignment()->setHorizontal(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
        );

        // Rata tengah E1 - E30
        $sheet->getStyle('E1:E30')->getAlignment()->setHorizontal(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
        );

        // Bold + Times New Roman untuk beberapa cell
        $cellsToStyle = ['B5', 'F5', 'B18', 'F18', 'B29'];

        foreach ($cellsToStyle as $cell) {
            $sheet->getStyle($cell)->getFont()
                ->setBold(true)
                ->setName('Times New Roman');
        }

        // Bold B17 - H17
        $sheet->getStyle('B17:H17')->getFont()->setBold(true);

        // Bold B28 - H28
        $sheet->getStyle('B28:H28')->getFont()->setBold(true);

        // Bold B31 - H31
        $sheet->getStyle('B31:H31')->getFont()->setBold(true);
    }
}
