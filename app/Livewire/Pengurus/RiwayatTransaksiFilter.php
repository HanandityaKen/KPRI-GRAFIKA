<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\KasHarian;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Carbon\Carbon;

class RiwayatTransaksiFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';

    public $selectedYear;
    
    public $availableYears = [];
    
    public $selectedMonth;
    
    public $availableMonths = [];

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        // $this->selectedYear = now()->format('Y');
        $this->selectedYear = '';
        $years = KasHarian::selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        rsort($years);

        $this->availableYears = $years;
        
        $this->updateAvailableMonths();
    }

    public function updateAvailableMonths()
    {
        Carbon::setLocale('id');

        $months = KasHarian::whereYear('tanggal', $this->selectedYear)
            ->selectRaw('MONTH(tanggal) as month')
            ->distinct()
            ->orderBy('month', 'asc')
            ->pluck('month')
            ->toArray();

        $this->availableMonths = array_map(function ($month) {
            return [
                'value' => $month,
                'label' => \Carbon\Carbon::createFromFormat('m', $month)->translatedFormat('F')
            ];
        }, $months);

        $this->selectedMonth = null;
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
        $this->updateAvailableMonths();
    }

    public function updatedSelectedMonth()
    {
        $this->resetPage();
    }

    public function render()
    {
        $riwayatTransaksis = KasHarian::when($this->selectedYear, function ($query) {
                $query->whereYear('tanggal', $this->selectedYear);
            })
            ->when($this->selectedMonth, function ($query) {
                $query->whereMonth('tanggal', $this->selectedMonth);
            })
            ->where(function ($query) {
                $query->whereHas('anggota', function ($query) {
                    $query->where('nama', 'like', '%' . $this->search . '%');
                })
                ->orWhere('jenis_transaksi', 'like', '%' . $this->search . '%')
                ->orWhere(function ($query) {
                    try {
                        $date = Carbon::createFromFormat('d-m-Y', $this->search, 'Asia/Jakarta')->format('Y-m-d');
                        $query->where('tanggal', $date);
                    } catch (\Exception $e) {
                        try {
                            $date = Carbon::createFromFormat('d-m', $this->search, 'Asia/Jakarta')->format('m-d');
                            $query->orWhereRaw("DATE_FORMAT(tanggal, '%m-%d') = ?", [$date]);
                        } catch (\Exception $e) {
                            // Skip jika tidak valid
                        }
                    }
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->onEachSide(1);

        foreach ($riwayatTransaksis as $transaksi) {
            $transaksi->total = array_sum([
                $transaksi->pokok ?? 0,
                $transaksi->wajib ?? 0,
                $transaksi->manasuka ?? 0,
                $transaksi->wajib_pinjam ?? 0,
                $transaksi->qurban ?? 0,
                $transaksi->angsuran ?? 0,
                $transaksi->jasa ?? 0,
                $transaksi->js_admin ?? 0,
                $transaksi->lain_lain ?? 0,
                $transaksi->barang_kons ?? 0,
                $transaksi->piutang ?? 0,
                $transaksi->hutang ?? 0,
                $transaksi->b_umum ?? 0,
                $transaksi->b_orgns ?? 0,
                $transaksi->b_oprs ?? 0,
                $transaksi->b_lain ?? 0,
                $transaksi->tnh_kav ?? 0,
            ]);
        }

        return view('livewire.pengurus.riwayat-transaksi-filter',[
            'riwayatTransaksis' => $riwayatTransaksis,
        ]);
    }
}
