<?php

namespace App\Exports;

use App\Models\PerhitunganNeraca;
use App\Models\neracaAwalD;
use App\Models\neracaAwalK;
use App\Models\nPerubahanD;
use App\Models\nPerubahanK;
use App\Models\aPenyesuaianD;
use App\Models\aPenyesuaianK;
use App\Models\rugiDanLabaD;
use App\Models\rugiDanLabaK;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TabelNeracaExport implements FromView, WithStyles
{
    protected $selectedYear;
    protected $tahunNeracaAwal = '';
    protected $data = [];

    public function __construct($selectedYear)
    {
        $this->selectedYear = $selectedYear;
    }

    public $fields = [
        'kas', 'bank', 'piutang', 'piutang_tanah', 'piutang_lain_pada_anggota',
        'penyisihan_piutang', 'piutang_barang', 'persediaan_barang',
        'persediaan_peralatan', 'akumulasi_peny_peralatan', 'pendapatan_ymh_diterima',
        'simpanan_manasuka_pkpri', 'tabungan_di_pkpri', 'simpanan_pokok_pkpri',
        'simpanan_wajib_pkpri', 'simp_khusus_pkpri', 'simp_khusus_swp',
        'skpb', 'penyertaan_di_hotel_pkpri', 'penyertaan_di_kopen',
        'penyertaan_unit_konsumsi', 'tanah', 'kewajiban_titipan',
        'biaya_yang_masih_harus_dibayar', 'jasa_partisipasi', 'dana_pengurus',
        'dana_karyawan', 'dana_pendidikan', 'dana_sosial', 'utang_ke_pkpri_atau_bni',
        'tabungan_qurban', 'simpanan_khusus_swp', 'simpanan_manasuka',
        'donasi', 'simpanan_pokok_anggota', 'simpanan_wajib_anggota',
        'cadangan', 'shu', 'jasa_dari_anggota', 'jasa_administrasi',
        'pembelian', 'penjualan', 'hpp_penjualan', 'beban_organisasi','beban_operasional',
        'beban_umum', 'beban_lain_lain', 'jasa_unit_konsumsi',
        'pendapatan_lain_lain', 'pendapatan_tanah_kavling',
        'piutang_khusus', 'beban_pajak_belum_dibayar', 'pajak',
        'jasa_simp_mana_suka',
    ];

    private function getTahunNeracaAwal()
    {
        $this->tahunNeracaAwal = $this->selectedYear - 1;
    }

    public function view(): View
    {
        $this->getTahunNeracaAwal();

        $perhitungan = PerhitunganNeraca::with([
            'neracaAwalD', 'neracaAwalK',
            'nPerubahanD', 'nPerubahanK',
            'aPenyesuaianD', 'aPenyesuaianK',
            'rugiDanLabaD', 'rugiDanLabaK',
        ])->where('tahun', $this->selectedYear)->first();

        if ($perhitungan) {
            $totals = [
                'neraca_awal_d'     => 0,
                'neraca_awal_k'     => 0,
                'n_perubahan_d'     => 0,
                'n_perubahan_k'     => 0,
                'n_percobaan_d'     => 0,
                'n_percobaan_k'     => 0,
                'n_saldo_d'         => 0,
                'n_saldo_k'         => 0,
                'a_penyesuaian_d'   => 0,
                'a_penyesuaian_k'   => 0,
                'ns_disesuaikan_d'  => 0,
                'ns_disesuaikan_k'  => 0,
                'rugi_dan_laba_d'   => 0,
                'rugi_dan_laba_k'   => 0,
                'neraca_d'          => 0,
                'neraca_k'          => 0,
            ];

            foreach ($this->fields as $field) {
                $neracaAwalD = $perhitungan->neracaAwalD?->{"neraca_awal_d_$field"} ?? 0;
                $neracaAwalK = $perhitungan->neracaAwalK?->{"neraca_awal_k_$field"} ?? 0;
                $nPerubahanD = $perhitungan->nPerubahanD?->{"n_perubahan_d_$field"} ?? 0;
                $nPerubahanK = $perhitungan->nPerubahanK?->{"n_perubahan_k_$field"} ?? 0;
                $aPenyesuaianD = $perhitungan->aPenyesuaianD?->{"a_penyesuaian_d_$field"} ?? 0;
                $aPenyesuaianK = $perhitungan->aPenyesuaianK?->{"a_penyesuaian_k_$field"} ?? 0;
                $rugiDanLabaD = $perhitungan->rugiDanLabaD?->{"rugi_dan_laba_d_$field"} ?? 0;
                $rugiDanLabaK = $perhitungan->rugiDanLabaK?->{"rugi_dan_laba_k_$field"} ?? 0;

                $nPercobaanD = $neracaAwalD + $nPerubahanD;
                $nPercobaanK = $neracaAwalK + $nPerubahanK;

                // Hitung N. Saldo
                $selisihNSaldo = $nPercobaanD - $nPercobaanK;
                $nSaldoD = $selisihNSaldo > 0 ? $selisihNSaldo : 0;
                $nSaldoK = $selisihNSaldo <= 0 ? abs($selisihNSaldo) : 0;

                // Hitung NS. Disesuaikan 
                $selisihNSDisesuaikan = $nSaldoD + $aPenyesuaianD - $nSaldoK - $aPenyesuaianK;
                $nsDisesuaikanD = $selisihNSDisesuaikan > 0 ? $selisihNSDisesuaikan : 0;
                $nsDisesuaikanK = $selisihNSDisesuaikan < 0 ? abs($selisihNSDisesuaikan) : 0;

                // Hitung Neraca
                $neracaD = $nsDisesuaikanD + $rugiDanLabaD;
                $neracaK = $nsDisesuaikanK + $rugiDanLabaK;

                $this->data[$field] = [
                    'neraca_awal_d'     => $neracaAwalD,
                    'neraca_awal_k'     => $neracaAwalK,
                    'n_perubahan_d'     => $nPerubahanD,
                    'n_perubahan_k'     => $nPerubahanK,
                    'n_percobaan_d'     => $nPercobaanD,
                    'n_percobaan_k'     => $nPercobaanK,
                    'n_saldo_d'         => $nSaldoD,
                    'n_saldo_k'         => $nSaldoK,
                    'a_penyesuaian_d'   => $aPenyesuaianD,
                    'a_penyesuaian_k'   => $aPenyesuaianK,
                    'ns_disesuaikan_d'  => $nsDisesuaikanD,
                    'ns_disesuaikan_k'  => $nsDisesuaikanK,
                    'rugi_dan_laba_d'   => $rugiDanLabaD,
                    'rugi_dan_laba_k'   => $rugiDanLabaK,
                    'neraca_d'          => $neracaD,
                    'neraca_k'          => $neracaK,
                    'jumlah'
                ];

                foreach ($totals as $key => $val) {
                    $totals[$key] += $this->data[$field][$key];
                }
            }

            $this->data['jumlah'] = $totals;
        }

        return view('exports.tabel-neraca', [
            'fields'          => $this->fields,
            'selectedYear'    => $this->selectedYear,
            'tahunNeracaAwal' => $this->tahunNeracaAwal,
            'data'            => $this->data,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        // Merge judul
        $sheet->mergeCells('A1:R1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        // AutoSize setiap kolom secara dinamis
        foreach ($sheet->getColumnIterator() as $column) {
            $colIndex = $column->getColumnIndex();
            $sheet->getColumnDimension($colIndex)->setAutoSize(true);
        }

        // Non-wrap agar teks tidak turun ke bawah
        $sheet->getStyle('A1:R' . $lastRow)->getAlignment()->setWrapText(false);

        // Tetapkan tinggi baris tetap
        $sheet->getDefaultRowDimension()->setRowHeight(20);

        // Style untuk header (baris ke-3 dan ke-4)
        $sheet->getStyle('A3:R4')->applyFromArray([
            'font' => ['bold' => true],
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

        // Border bawah antar baris data
        for ($row = 5; $row <= $lastRow; $row++) {
            $sheet->getStyle("A{$row}:R{$row}")->applyFromArray([
                'borders' => [
                    'allBorders' => [ 
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ]);
        }

        // Rata tengah A1 - A58
        $sheet->getStyle('A1:A58')->getAlignment()->setHorizontal(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
        );

        // Rata kanan C5 sampai R59
        $sheet->getStyle('C5:R59')->getAlignment()->setHorizontal(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
        );
        
        // Jumlah A59
        $sheet->getStyle('A59')->getAlignment()->setHorizontal(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
        );
    }
}
