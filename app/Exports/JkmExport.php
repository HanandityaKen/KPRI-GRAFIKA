<?php

namespace App\Exports;

use App\Models\KasHarian;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class JkmExport implements FromView, WithStyles
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
            ->where('jenis_transaksi', 'kas masuk');

        if ($this->selectedYear) {
            $query->whereYear('tanggal', $this->selectedYear);
        }

        if ($this->selectedMonth) {
            $query->whereMonth('tanggal', $this->selectedMonth);
        }

        return $query->sum(DB::raw('
            angsuran + pokok + wajib + manasuka + wajib_pinjam +
            qurban + jasa + js_admin + lain_lain + barang_kons
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
                SUM(jasa) as jasa,
                SUM(js_admin) as js_admin,
                SUM(lain_lain) as lain_lain,
                SUM(barang_kons) as barang_kons    
            ')
            ->where('jenis_transaksi', 'kas masuk');

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

        return view('exports.jkm', [
            'transaksi' => $transaksi,
            'selectedYear' => $this->selectedYear,
            'selectedMonth' => $this->selectedMonth,
            'totalPerPeriode' => $this->getTotalByPeriod(),
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        // **Gabungkan sel untuk judul agar tidak mempengaruhi auto-size kolom**
        $sheet->mergeCells('A1:M1'); // Sesuaikan sampai kolom I
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

        // **Header diberi background abu-abu dan bold**
        $sheet->getStyle('A3:M3')->applyFromArray([ // Sesuaikan sampai kolom I
            'font' => [
                'bold' => true,
                'name' => 'Times New Roman', 
                'size' => 13, 
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E0E0E0'],
            ],
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

        // **Tambahkan border antar data (hanya garis bawah antar baris data)**
        for ($row = 4; $row <= $lastRow; $row++) {
            $sheet->getStyle("A{$row}:M{$row}")->applyFromArray([
                'borders' => [
                    'allBorders' => [ 
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ]);
        }

        // Rata tengah untuk kolom B baris 4 sampai baris terakhir
        $sheet->getStyle("B4:B{$lastRow}")->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Rata kanan untuk kolom C sampai M dari baris 4 sampai baris terakhir
        $sheet->getStyle("C4:M{$lastRow}")->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Terapkan font Times New Roman juga di footer
        $sheet->getStyle("A{$lastRow}:M{$lastRow}")->applyFromArray([
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
