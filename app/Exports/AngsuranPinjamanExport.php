<?php

namespace App\Exports;

use App\Models\Angsuran;
use App\Models\Anggota;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AngsuranPinjamanExport implements FromView, WithStyles
{
    public function view(): View
    {
        $angsurans = Angsuran::select('angsuran_pinjaman.*')
            ->join('pinjaman', 'pinjaman.id', '=', 'angsuran_pinjaman.pinjaman_id')
            ->join('pengajuan_pinjaman', 'pengajuan_pinjaman.id', '=', 'pinjaman.pengajuan_pinjaman_id')
            ->where('pinjaman.status', 'dalam pembayaran')
            ->orderBy('pengajuan_pinjaman.tanggal', 'desc')
            ->with(['pinjaman.pengajuan_pinjaman'])
            ->get();

        return view('exports.angsuran-pinjaman', compact('angsurans'));
    }

    public function styles(Worksheet $sheet)
    {
        // **Gabungkan sel untuk judul agar tidak mempengaruhi auto-size kolom**
        $sheet->mergeCells('A1:J1'); // Sesuaikan sampai kolom J
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        // **Auto-fit lebar kolom berdasarkan isi header**
        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // **Menentukan range tabel untuk border (hanya di pinggir)**
        $lastRow = $sheet->getHighestRow();
        $borderRange = 'A3:J' . $lastRow; // Sesuaikan sampai kolom J

        $sheet->getStyle($borderRange)->applyFromArray([
            'borders' => [
                'outline' => [ // Hanya border luar (atas, bawah, kanan, kiri)
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // **Header diberi background abu-abu dan bold**
        $sheet->getStyle('A3:J3')->applyFromArray([ // Sesuaikan sampai kolom J
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E0E0E0'],
            ],
        ]);

        // **Tambahkan border horizontal di antara header dan data**
        $sheet->getStyle('A3:J3')->applyFromArray([ // Sesuaikan sampai kolom J
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // **Tambahkan border antar data (hanya garis bawah antar baris data)**
        for ($row = 4; $row <= $lastRow; $row++) {
            $sheet->getStyle("A{$row}:J{$row}")->applyFromArray([ // Sesuaikan sampai kolom J
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ]);
        }
    }
}
