<?php

namespace App\Exports;

use App\Models\Anggota;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AnggotaExport implements FromView, WithStyles
{
    public function view(): View
    {
        $anggotas = Anggota::select('no_anggota', 'nama', 'password')
            ->orderBy('no_anggota')
            ->get();

        return view('exports.anggota', compact('anggotas'));
    }

    public function styles(Worksheet $sheet)
    {
        // **Gabungkan sel untuk judul agar tidak mempengaruhi auto-size kolom**
        $sheet->mergeCells('A1:D1'); // Sesuaikan sampai kolom I
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        // **Auto-fit lebar kolom berdasarkan isi header**
        foreach (range('A', 'D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // **Menentukan range tabel untuk border (hanya di pinggir)**
        $lastRow = $sheet->getHighestRow();
        $borderRange = 'A3:D' . $lastRow; // Sesuaikan sampai kolom I

        $sheet->getStyle($borderRange)->applyFromArray([
            'borders' => [
                'outline' => [ // Hanya border luar (atas, bawah, kanan, kiri)
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // AutoSize setiap kolom secara dinamis
        foreach ($sheet->getColumnIterator() as $column) {
            $colIndex = $column->getColumnIndex();
            $sheet->getColumnDimension($colIndex)->setAutoSize(true);
        }

        // Non-wrap agar teks tidak turun ke bawah
        $sheet->getStyle('A1:D' . $lastRow)->getAlignment()->setWrapText(false);

        // Tetapkan tinggi baris tetap
        $sheet->getDefaultRowDimension()->setRowHeight(20);

        $sheet->getStyle('A3:D3')->applyFromArray([
            'font' => ['bold' => true],
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

        // **Tambahkan border antar data (hanya garis bawah antar baris data)**
        for ($row = 4; $row <= $lastRow; $row++) {
            $sheet->getStyle("A{$row}:D{$row}")->applyFromArray([ // Sesuaikan sampai kolom I
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ]);
        }

        $sheet->getStyle("A4:A{$lastRow}")->getAlignment()->setHorizontal('left');    // No
        $sheet->getStyle("B4:B{$lastRow}")->getAlignment()->setHorizontal('center');  // No Anggota
        $sheet->getStyle("D4:D{$lastRow}")->getAlignment()->setHorizontal('left');    // Password
    }
}
