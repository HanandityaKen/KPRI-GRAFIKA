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
                SUM(hari_lembur) +
                SUM(perjalanan_pengawas) +
                SUM(thr) +
                SUM(admin) +
                SUM(iuran_dekopinda) +
                SUM(honor_pengurus) +
                SUM(rkrab) +
                SUM(pembinaan) +
                SUM(harkop) +
                SUM(dandik) +
                SUM(rapat) +
                SUM(jasa_manasuka) +
                SUM(pajak) +
                SUM(tabungan_qurban) +
                SUM(dekopinda) +
                SUM(wajib_pkpri) +
                SUM(dansos) +
                SUM(shu) +
                SUM(dana_pengurus) +
                SUM(dana_kesejahteraan) +
                SUM(pembayaran_listrik_dan_air) +
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
                SUM(hari_lembur) as total_hari_lembur,
                SUM(perjalanan_pengawas) as total_perjalanan_pengawas,
                SUM(thr) as total_thr,
                SUM(admin) as total_admin,
                SUM(iuran_dekopinda) as total_iuran_dekopinda,
                SUM(honor_pengurus) as total_honor_pengurus,
                SUM(rkrab) as total_rkrab,
                SUM(pembinaan) as total_pembinaan,
                SUM(harkop) as total_harkop,
                SUM(dandik) as total_dandik,
                SUM(rapat) as total_rapat,
                SUM(jasa_manasuka) as total_jasa_manasuka,
                SUM(pajak) as total_pajak,
                SUM(tabungan_qurban) as total_tabungan_qurban,
                SUM(dekopinda) as total_dekopinda,
                SUM(wajib_pkpri) as total_wajib_pkpri,
                SUM(dansos) as total_dansos,
                SUM(shu) as total_shu,
                SUM(dana_pengurus) as total_dana_pengurus,
                SUM(dana_kesejahteraan) as total_dana_kesejahteraan,
                SUM(pembayaran_listrik_dan_air) as total_pembayaran_listrik_dan_air,
                SUM(tnh_kav) as total_tnh_kav,
                SUM(angsuran + pokok + wajib + manasuka + wajib_pinjam + qurban + lain_lain + piutang + hutang + hari_lembur + perjalanan_pengawas + thr + admin + iuran_dekopinda + honor_pengurus + rkrab + pembinaan + harkop + dandik + rapat + jasa_manasuka + pajak + tabungan_qurban + dekopinda + wajib_pkpri + dansos + shu + dana_pengurus + dana_kesejahteraan + pembayaran_listrik_dan_air + tnh_kav) as total_jumlah
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
                    'total_hari_lembur' => $jkks->get($monthNumber)->total_hari_lembur ?? 0,
                    'total_perjalanan_pengawas' => $jkks->get($monthNumber)->total_perjalanan_pengawas ?? 0,
                    'total_thr' => $jkks->get($monthNumber)->total_thr ?? 0,
                    'total_admin' => $jkks->get($monthNumber)->total_admin ?? 0,
                    'total_iuran_dekopinda' => $jkks->get($monthNumber)->total_iuran_dekopinda ?? 0,
                    'total_honor_pengurus' => $jkks->get($monthNumber)->total_honor_pengurus ?? 0,
                    'total_rkrab' => $jkks->get($monthNumber)->total_rkrab ?? 0,
                    'total_pembinaan' => $jkks->get($monthNumber)->total_pembinaan ?? 0,
                    'total_harkop' => $jkks->get($monthNumber)->total_harkop ?? 0,
                    'total_dandik' => $jkks->get($monthNumber)->total_dandik ?? 0,
                    'total_rapat' => $jkks->get($monthNumber)->total_rapat ?? 0,
                    'total_jasa_manasuka' => $jkks->get($monthNumber)->total_jasa_manasuka ?? 0,
                    'total_pajak' => $jkks->get($monthNumber)->total_pajak ?? 0,
                    'total_tabungan_qurban' => $jkks->get($monthNumber)->total_tabungan_qurban ?? 0,
                    'total_dekopinda' => $jkks->get($monthNumber)->total_dekopinda ?? 0,
                    'total_wajib_pkpri' => $jkks->get($monthNumber)->total_wajib_pkpri ?? 0,
                    'total_dansos' => $jkks->get($monthNumber)->total_dansos ?? 0,
                    'total_shu' => $jkks->get($monthNumber)->total_shu ?? 0,
                    'total_dana_pengurus' => $jkks->get($monthNumber)->total_dana_pengurus ?? 0,
                    'total_dana_kesejahteraan' => $jkks->get($monthNumber)->total_dana_kesejahteraan ?? 0,
                    'total_pembayaran_listrik_dan_air' => $jkks->get($monthNumber)->total_pembayaran_listrik_dan_air ?? 0,
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
        $lastRow = $sheet->getHighestRow();

        // Merge judul utama dari A1 sampai AG1
        $sheet->mergeCells('A1:AG1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        // AutoSize setiap kolom secara dinamis
        foreach ($sheet->getColumnIterator() as $column) {
            $colIndex = $column->getColumnIndex();
            $sheet->getColumnDimension($colIndex)->setAutoSize(true);
        }

        // Non-wrap agar teks tidak turun ke bawah
        $sheet->getStyle('A1:AG' . $lastRow)->getAlignment()->setWrapText(false);

        // Tetapkan tinggi baris tetap
        $sheet->getDefaultRowDimension()->setRowHeight(20);

        // Style untuk header (baris ke-3 dan ke-4)
        $sheet->getStyle('A3:AG4')->applyFromArray([
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

        // Border bawah antar baris data
        for ($row = 5; $row <= $lastRow; $row++) {
            $sheet->getStyle("A{$row}:AG{$row}")->applyFromArray([
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ]);
        }
    }
}
