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
        // **Gabungkan sel untuk judul agar tidak mempengaruhi auto-size kolom**
        $sheet->mergeCells('A1:G1'); // Sesuaikan sampai kolom J
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        // **Auto-fit lebar kolom berdasarkan isi header**
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // **Menentukan range tabel untuk border (hanya di pinggir)**
        $lastRow = $sheet->getHighestRow();
        $borderRange = 'A3:G' . $lastRow; // Sesuaikan sampai kolom J

        $sheet->getStyle($borderRange)->applyFromArray([
            'borders' => [
                'outline' => [ // Hanya border luar (atas, bawah, kanan, kiri)
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // **Header diberi background abu-abu dan bold**
        $sheet->getStyle('A3:G3')->applyFromArray([ // Sesuaikan sampai kolom J
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E0E0E0'],
            ],
        ]);

        // **Tambahkan border horizontal di antara header dan data**
        $sheet->getStyle('A3:G3')->applyFromArray([ // Sesuaikan sampai kolom J
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // **Tambahkan border antar data (hanya garis bawah antar baris data)**
        for ($row = 4; $row <= $lastRow; $row++) {
            $sheet->getStyle("A{$row}:G{$row}")->applyFromArray([ // Sesuaikan sampai kolom J
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ]);
        }
    }
}
