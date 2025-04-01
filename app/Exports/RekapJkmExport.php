<?php

namespace App\Exports;

use App\Models\KasHarian;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
// use Maatwebsite\Excel\Concerns\FromCollection;

class RekapJkmExport implements FromView, WithStyles
{
    public $selectedYear;

    public function __construct($selectedYear)
    {
        $this->selectedYear = $selectedYear;
    }

    public function getTotalByYear()
    {
        return KasHarian::where('jenis_transaksi', 'kas masuk')
            ->whereYear('tanggal', $this->selectedYear)
            ->selectRaw('
                SUM(angsuran) + 
                SUM(pokok) + 
                SUM(wajib) + 
                SUM(manasuka) + 
                SUM(wajib_pinjam) + 
                SUM(qurban) + 
                SUM(jasa) + 
                SUM(js_admin) + 
                SUM(lain_lain) + 
                SUM(barang_kons) as total
            ')
            ->value('total');
    }

    public function view(): View
    {
        $jkms = KasHarian::selectRaw('
                MONTH(tanggal) as bulan,
                SUM(angsuran) as total_angsuran,
                SUM(pokok) as total_pokok,
                SUM(wajib) as total_wajib,
                SUM(manasuka) as total_m_suka,
                SUM(wajib_pinjam) as total_swp,
                SUM(qurban) as total_qurban,
                SUM(jasa) as total_jasa,
                SUM(js_admin) as total_j_admin,
                SUM(lain_lain) as total_lain_lain,
                SUM(barang_kons) as total_barang_kons,
                SUM(angsuran + pokok + wajib + manasuka + wajib_pinjam + qurban + jasa + js_admin + lain_lain + barang_kons) as total_jumlah
            ')
            ->where('jenis_transaksi', 'kas masuk')
            ->whereYear('tanggal', $this->selectedYear)
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get()
            ->keyBy('bulan');

        $allMonths = collect([
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ]);

        $result = $allMonths->map(function ($monthName, $monthNumber) use ($jkms) {
            return [
                'bulan' => $monthName,
                'total_angsuran' => $jkms->get($monthNumber)->total_angsuran ?? 0,
                'total_pokok' => $jkms->get($monthNumber)->total_pokok ?? 0,
                'total_wajib' => $jkms->get($monthNumber)->total_wajib ?? 0,
                'total_m_suka' => $jkms->get($monthNumber)->total_m_suka ?? 0,
                'total_swp' => $jkms->get($monthNumber)->total_swp ?? 0,
                'total_qurban' => $jkms->get($monthNumber)->total_qurban ?? 0,
                'total_jasa' => $jkms->get($monthNumber)->total_jasa ?? 0,
                'total_j_admin' => $jkms->get($monthNumber)->total_j_admin ?? 0,
                'total_lain_lain' => $jkms->get($monthNumber)->total_lain_lain ?? 0,
                'total_barang_kons' => $jkms->get($monthNumber)->total_barang_kons ?? 0,
                'total_jumlah' => $jkms->get($monthNumber)->total_jumlah ?? 0,
            ];
        });

        return view('exports.rekap-jkm', [
            'jkms' => $result,
            'totalPerTahun' => $this->getTotalByYear(),
            'selectedYear' => $this->selectedYear
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // **Gabungkan sel untuk judul agar tidak mempengaruhi auto-size kolom**
        $sheet->mergeCells('A1:L1'); // Sesuaikan sampai kolom I
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        // **Auto-fit lebar kolom berdasarkan isi header**
        foreach (range('A', 'L') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // **Menentukan range tabel untuk border (hanya di pinggir)**
        $lastRow = $sheet->getHighestRow();
        $borderRange = 'A3:L' . $lastRow; // Sesuaikan sampai kolom I

        $sheet->getStyle($borderRange)->applyFromArray([
            'borders' => [
                'outline' => [ // Hanya border luar (atas, bawah, kanan, kiri)
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // **Header diberi background abu-abu dan bold**
        $sheet->getStyle('A3:L3')->applyFromArray([ // Sesuaikan sampai kolom I
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E0E0E0'],
            ],
        ]);

        // **Tambahkan border horizontal di antara header dan data**
        $sheet->getStyle('A3:L3')->applyFromArray([ // Sesuaikan sampai kolom I
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // **Tambahkan border antar data (hanya garis bawah antar baris data)**
        for ($row = 4; $row <= $lastRow; $row++) {
            $sheet->getStyle("A{$row}:L{$row}")->applyFromArray([ // Sesuaikan sampai kolom I
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ]);
        }
    }
}
