<?php

namespace App\Exports;

use App\Models\KasHarian;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class JkkExport implements FromView, WithStyles
{
    public $selectedYear;

    public $selectedMonth;

    public function __construct($selectedYear, $selectedMonth = null)
    {
        $this->selectedYear = $selectedYear;
        $this->selectedMonth = $selectedMonth;
    }

    public function getTotalByPeriod()
    {
        $query = DB::table('kas_harian')
            ->where('jenis_transaksi', 'kas keluar');

        if ($this->selectedYear) {
            $query->whereYear('tanggal', $this->selectedYear);
        }

        if ($this->selectedMonth) {
            $query->whereMonth('tanggal', $this->selectedMonth);
        }

        return $query->sum(DB::raw('
            angsuran + pokok + wajib + manasuka + wajib_pinjam +
            qurban + lain_lain + piutang + hutang + hari_lembur +
            perjalanan_pengawas + thr + admin + iuran_dekopinda +
            honor_pengurus + rkrab + pembinaan + harkop + dandik + rapat +
            jasa_manasuka + pajak + tabungan_qurban + dekopinda +
            wajib_pkpri + dansos + shu + dana_pengurus + dana_kesejahteraan + pembayaran_listrik_dan_air + tnh_kav
        '));
    }

    public function view(): View
    {
        $query = DB::table('kas_harian')
            ->selectRaw('
                nama_anggota,
                tanggal,
                SUM(angsuran) as angsuran,
                SUM(pokok) as pokok,
                SUM(wajib) as wajib,
                SUM(manasuka) as manasuka,
                SUM(wajib_pinjam) as wajib_pinjam,
                SUM(qurban) as qurban,
                SUM(lain_lain) as lain_lain,
                SUM(piutang) as piutang,
                SUM(hutang) as hutang,
                SUM(hari_lembur) as hari_lembur,
                SUM(perjalanan_pengawas) as perjalanan_pengawas,
                SUM(thr) as thr,
                SUM(admin) as admin,
                SUM(iuran_dekopinda) as iuran_dekopinda,
                SUM(honor_pengurus) as honor_pengurus,
                SUM(rkrab) as rkrab,
                SUM(pembinaan) as pembinaan,
                SUM(harkop) as harkop,
                SUM(dandik) as dandik,
                SUM(rapat) as rapat,
                SUM(jasa_manasuka) as jasa_manasuka,
                SUM(pajak) as pajak,
                SUM(tabungan_qurban) as tabungan_qurban,
                SUM(dekopinda) as dekopinda,
                SUM(wajib_pkpri) as wajib_pkpri,
                SUM(dansos) as dansos,
                SUM(shu) as shu,
                SUM(dana_pengurus) as dana_pengurus,
                SUM(dana_kesejahteraan) as dana_kesejahteraan,
                SUM(pembayaran_listrik_dan_air) as pembayaran_listrik_dan_air,
                SUM(tnh_kav) as tnh_kav
            ')
            ->where('jenis_transaksi', 'kas keluar');

        if ($this->selectedYear) {
            $query->whereYear('tanggal', $this->selectedYear);
        }

        if ($this->selectedMonth) {
            $query->whereMonth('tanggal', $this->selectedMonth);
        }

        $transaksi = $query
            ->groupBy('nama_anggota', 'tanggal')
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->get();

        return view('exports.jkk', [
            'transaksi' => $transaksi,
            'selectedYear' => $this->selectedYear,
            'selectedMonth' => $this->selectedMonth,
            'totalPerPeriode' => $this->getTotalByPeriod(),
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        // Merge judul utama dari A1 sampai AH1
        $sheet->mergeCells('A1:AH1');
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
        $sheet->getStyle('A1:AH' . $lastRow)->getAlignment()->setWrapText(false);

        // Tetapkan tinggi baris tetap
        $sheet->getDefaultRowDimension()->setRowHeight(20);

        // Font Times Roman
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Times New Roman')->setSize(12);

        // Style untuk header (baris ke-3 dan ke-4)
        $sheet->getStyle('A3:AH4')->applyFromArray([
            'font' => [
                'bold' => true,
                'name' => 'Times New Roman', 
                'size' => 13, 
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E0E0E0'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Border bawah antar baris data
        for ($row = 5; $row <= $lastRow; $row++) {
            $sheet->getStyle("A{$row}:AH{$row}")->applyFromArray([
                'borders' => [
                    'allBorders' => [ 
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ]);
        }

        // Rata tengah untuk kolom B5 
        $sheet->getStyle("B5:B{$lastRow}")->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Rata kanan untuk kolom C5 sampai AH5
        $sheet->getStyle("C5:AH{$lastRow}")->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Footer
        $sheet->getStyle("A{$lastRow}:AH{$lastRow}")->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'size' => 13,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);
    }
}
