<?php

namespace App\Exports;

use App\Models\KasHarian;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapJkkExport implements FromView, WithStyles
{
    public $selectedYear;

    public function __construct($selectedYear)
    {
        $this->selectedYear = $selectedYear;
    }
    
    public function getTotalByYear()
    {
        return KasHarian::where('jenis_transaksi', 'kas keluar')
            ->whereYear('tanggal', $this->selectedYear)
            ->selectRaw('
                SUM(angsuran) + 
                SUM(pokok) + 
                SUM(wajib) + 
                SUM(manasuka) + 
                SUM(wajib_pinjam) + 
                SUM(qurban) + 
                SUM(lain_lain) + 
                SUM(piutang) + 
                SUM(hutang) + 
                SUM(b_umum) + 
                SUM(b_orgns) + 
                SUM(b_oprs) + 
                SUM(b_lain) + 
                SUM(tnh_kav) as total
            ')
            ->value('total');
    }

    public function view(): View
    {
        $jkks = KasHarian::selectRaw('
                MONTH(tanggal) as bulan,
                SUM(angsuran) as total_angsuran,
                SUM(pokok) as total_pokok,
                SUM(wajib) as total_wajib,
                SUM(manasuka) as total_m_suka,
                SUM(wajib_pinjam) as total_swp,
                SUM(qurban) as total_qurban,
                SUM(lain_lain) as total_lain_lain,
                SUM(piutang) as total_piutang,
                SUM(hutang) as total_hutang,
                SUM(b_umum) as total_b_umum,
                SUM(b_orgns) as total_b_orgns,
                SUM(b_oprs) as total_b_oprs,
                SUM(b_lain) as total_b_lain,
                SUM(tnh_kav) as total_tnh_kav,
                SUM(angsuran + pokok + wajib + manasuka + wajib_pinjam + qurban + jasa + js_admin + lain_lain + b_umum + b_orgns + b_oprs + b_lain + tnh_kav) as total_jumlah
            ')
            ->where('jenis_transaksi', 'kas keluar')
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
        
            // Gabungkan data dari database dengan bulan yang kosong
            $result = $allMonths->map(function ($monthName, $monthNumber) use ($jkks) {
                return [
                    'bulan' => $monthName,
                    'total_angsuran' => $jkks->get($monthNumber)->total_angsuran ?? 0,
                    'total_pokok' => $jkks->get($monthNumber)->total_pokok ?? 0,
                    'total_wajib' => $jkks->get($monthNumber)->total_wajib ?? 0,
                    'total_m_suka' => $jkks->get($monthNumber)->total_m_suka ?? 0,
                    'total_swp' => $jkks->get($monthNumber)->total_swp ?? 0,
                    'total_qurban' => $jkks->get($monthNumber)->total_qurban ?? 0,
                    'total_lain_lain' => $jkks->get($monthNumber)->total_lain_lain ?? 0,
                    'total_piutang' => $jkks->get($monthNumber)->total_piutang ?? 0,
                    'total_hutang' => $jkks->get($monthNumber)->total_hutang ?? 0,
                    'total_b_umum' => $jkks->get($monthNumber)->total_b_umum ?? 0,
                    'total_b_orgns' => $jkks->get($monthNumber)->total_b_orgns ?? 0,
                    'total_b_oprs' => $jkks->get($monthNumber)->total_b_oprs ?? 0,
                    'total_tnh_kav' => $jkks->get($monthNumber)->total_tnh_kav ?? 0,
                    'total_jumlah' => $jkks->get($monthNumber)->total_jumlah ?? 0,
                ];
            });

        return view('exports.rekap-jkk', [
            'jkks' => $result,
            'totalPerTahun' => $this->getTotalByYear(),
            'selectedYear' => $this->selectedYear
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // **Gabungkan sel untuk judul agar tidak mempengaruhi auto-size kolom**
        $sheet->mergeCells('A1:O1'); // Sesuaikan sampai kolom I
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        // **Auto-fit lebar kolom berdasarkan isi header**
        foreach (range('A', 'O') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // **Menentukan range tabel untuk border (hanya di pinggir)**
        $lastRow = $sheet->getHighestRow();
        $borderRange = 'A3:O' . $lastRow; // Sesuaikan sampai kolom I

        $sheet->getStyle($borderRange)->applyFromArray([
            'borders' => [
                'outline' => [ // Hanya border luar (atas, bawah, kanan, kiri)
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // **Header diberi background abu-abu dan bold**
        $sheet->getStyle('A3:O3')->applyFromArray([ // Sesuaikan sampai kolom I
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E0E0E0'],
            ],
        ]);

        // **Tambahkan border horizontal di antara header dan data**
        $sheet->getStyle('A3:O3')->applyFromArray([ // Sesuaikan sampai kolom I
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // **Tambahkan border antar data (hanya garis bawah antar baris data)**
        for ($row = 4; $row <= $lastRow; $row++) {
            $sheet->getStyle("A{$row}:O{$row}")->applyFromArray([ // Sesuaikan sampai kolom I
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ]);
        }
    }
}
