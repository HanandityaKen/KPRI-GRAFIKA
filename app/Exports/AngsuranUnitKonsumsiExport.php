<?php

namespace App\Exports;

use App\Models\AngsuranUnitKonsumsi;
use App\Models\Anggota;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\UnitKonsumsi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AngsuranUnitKonsumsiExport implements FromView, WithStyles
{
    public function view(): View
    {
        $angsurans = AngsuranUnitKonsumsi::select('angsuran_unit_konsumsi.*')
            ->join('unit_konsumsi', 'unit_konsumsi.id', '=', 'angsuran_unit_konsumsi.unit_konsumsi_id')
            ->join('pengajuan_unit_konsumsi', 'pengajuan_unit_konsumsi.id', '=', 'unit_konsumsi.pengajuan_unit_konsumsi_id')
            ->where('unit_konsumsi.status', 'dalam pembayaran')
            ->orderBy('pengajuan_unit_konsumsi.tanggal', 'desc')
            ->orderBy('pengajuan_unit_konsumsi.created_at', 'desc')
            ->with(['unit_konsumsi.pengajuan_unit_konsumsi'])
            ->get();

        return view('exports.angsuran-unit-konsumsi', compact('angsurans'));
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        // **Gabungkan sel untuk judul agar tidak mempengaruhi auto-size kolom**
        $sheet->mergeCells('A1:G1'); // Sesuaikan sampai kolom J
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
        $sheet->getStyle('A1:G' . $lastRow)->getAlignment()->setWrapText(false);

        // Tetapkan tinggi baris tetap
        $sheet->getDefaultRowDimension()->setRowHeight(20);

        // Font Times Roman
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Times New Roman')->setSize(12);

        // **Header diberi background abu-abu dan bold**
        $sheet->getStyle('A3:G3')->applyFromArray([ // Sesuaikan sampai kolom J
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
            $sheet->getStyle("A{$row}:G{$row}")->applyFromArray([ // Sesuaikan sampai kolom J
                'borders' => [
                    'allBorders' => [ 
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ]);
        }

        // Rata tengah
        $sheet->getStyle("A4:A{$lastRow}")->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Rata kanan
        $sheet->getStyle("D4:G{$lastRow}")->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    }
}
