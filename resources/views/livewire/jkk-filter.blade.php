<div wire:poll.keep-alive.5s>
    <div class="mb-8 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 sm:gap-4">
        <!-- KIRI: Search -->
        <div class="relative w-full sm:w-1/3">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" wire:model.live="search"
                class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500"
                placeholder="Search">
        </div>
    
        <!-- KANAN: Filter & Ekspor -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 w-full sm:w-auto">
            <!-- Dropdown Tahun -->
            <select id="yearFilter" wire:model.change="selectedYear"
                    class="p-2 bg-white border-2 border-[#6DA854] rounded-md w-full sm:w-auto">
                <option value="">Pilih Tahun</option>
                @foreach ($availableYears as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
    
            <!-- Dropdown Bulan -->
            <select id="monthFilter" wire:model.change="selectedMonth"
                    class="p-2 bg-white border-2 border-[#6DA854] rounded-md w-full sm:w-auto">
                <option value="">Pilih Bulan</option>
                @foreach ($availableMonths as $month)
                    <option value="{{ $month['value'] }}">{{ $month['label'] }}</option>
                @endforeach
            </select>
    
            <!-- Tombol Ekspor -->
            <button wire:click="exportExcel" class="flex items-center justify-center px-4 py-2 bg-green-800 text-white rounded w-full sm:w-auto whitespace-nowrap">
                <svg class="w-4 h-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                    <path fill="currentColor" d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM155.7 250.2L192 302.1l36.3-51.9c7.6-10.9 22.6-13.5 33.4-5.9s13.5 22.6 5.9 33.4L221.3 344l46.4 66.2c7.6 10.9 5 25.8-5.9 33.4s-25.8 5-33.4-5.9L192 385.8l-36.3 51.9c-7.6 10.9-22.6 13.5-33.4 5.9s-13.5-22.6-5.9-33.4L162.7 344l-46.4-66.2c-7.6-10.9-5-25.8 5.9-33.4s25.8-5 33.4 5.9z"/>
                </svg>
                <span>Ekspor Excel</span>
            </button>
        </div>
    </div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-center text-[#6DA854] border-r border-b border-[#6DA854]" rowspan="2">No</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Uraian</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Tanggal</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Angsuran</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Pokok</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Wajib</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">M.Suka</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">SWP</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Qurban</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Beban Lain</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Piutang</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Hutang</th>
            
                    <!-- Header Gabungan -->
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="6">Beban Umum</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="4">Beban Organisasi</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="2">Beban Operasional</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="9">Lain-Lain</th>
            
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Tanah Kavling</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Jumlah</th>
                </tr>
                <tr>
                    <!-- Beban Umum -->
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Hari Lembur</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Perjalanan Pengawas</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">THR</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Admin</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Iuran Dekopinda</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Honor Pengurus</th>
            
                    <!-- Beban Organisasi -->
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">RkRab</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Pembinaan</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Harkop</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Dandik</th>
            
                    <!-- Beban Operasional -->
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Rapat</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Jasa Manasuka</th>
            
                    <!-- Beban Lain -->
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Pajak</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Tabungan Qurban</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Dekopinda</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Wajib PKPRI</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Dansos</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">SHU</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Dana Pengurus</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Dana Kesejahteraan</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-b border-[#6DA854]">Pembayaran Listrik Dan Air</th>
                </tr>         
            </thead>
            <tbody>
                @forelse ($jkks as $index => $jkk)     
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="p-3 text-center text-[#6DA854] border-r border-[#6DA854]">{{ $jkks->firstItem() + $index }}</td>
                        <td class="p-3 border-l border-r border-[#6DA854]">{{ $jkk->nama_anggota }}</td>
                        <td class="p-3 text-center whitespace-nowrap border-l border-r border-[#6DA854]">{{ \Carbon\Carbon::parse($jkk->tanggal)->translatedFormat('d-m-y') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_angsuran, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_pokok, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_wajib, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_manasuka, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_swp, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_qurban, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_lain_lain, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_piutang, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_hutang, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_hari_lembur, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_perjalanan_pengawas, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_thr, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_admin, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_iuran_dekopinda, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_honor_pengurus, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_rkrab, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_pembinaan, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_harkop, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_dandik, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_rapat, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_jasa_manasuka, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_pajak, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_tabungan_qurban, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_dekopinda, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_wajib_pkpri, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_dansos, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_shu, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_dana_pengurus, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_dana_kesejahteraan, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_pembayaran_listrik_dan_air, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk->total_tnh_kav, 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-[#6DA854] font-bold">- Rp {{ number_format($jkk->total_jumlah, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14" class="text-center py-4">Tidak ada data kas keluar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $jkks->links() }}
    </div>   
</div>

