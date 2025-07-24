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
        // **Gabungkan sel untuk judul agar tidak mempengaruhi auto-size kolom**
        $sheet->mergeCells('A1:M1'); // Sesuaikan sampai kolom I
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        // **Auto-fit lebar kolom berdasarkan isi header**
        foreach (range('A', 'M') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // **Menentukan range tabel untuk border (hanya di pinggir)**
        $lastRow = $sheet->getHighestRow();
        $borderRange = 'A3:M' . $lastRow; // Sesuaikan sampai kolom I

        $sheet->getStyle($borderRange)->applyFromArray([
            'borders' => [
                'outline' => [ // Hanya border luar (atas, bawah, kanan, kiri)
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // **Header diberi background abu-abu dan bold**
        $sheet->getStyle('A3:M3')->applyFromArray([ // Sesuaikan sampai kolom I
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E0E0E0'],
            ],
        ]);

        // **Tambahkan border horizontal di antara header dan data**
        $sheet->getStyle('A3:M3')->applyFromArray([ // Sesuaikan sampai kolom I
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // **Tambahkan border antar data (hanya garis bawah antar baris data)**
        for ($row = 4; $row <= $lastRow; $row++) {
            $sheet->getStyle("A{$row}:M{$row}")->applyFromArray([ // Sesuaikan sampai kolom I
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ]);
        }
    }
}
