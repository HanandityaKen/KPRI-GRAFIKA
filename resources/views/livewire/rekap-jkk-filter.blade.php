<div wire:poll.keep-alive.5s>
    <div class="mb-8 flex justify-between items-center">
        <div class="flex items-center">
            <label for="yearFilter" class="mr-2">Tahun:</label>
            <select id="yearFilter" wire:model.change="selectedYear" class="p-2 bg-white border-2 border-[#6DA854] w-[100px] rounded-md">
                @foreach ($availableYears as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <button wire:click="exportExcel" class="flex items-center px-4 py-2 bg-green-800 text-white rounded">
            <svg class="w-4 h-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM155.7 250.2L192 302.1l36.3-51.9c7.6-10.9 22.6-13.5 33.4-5.9s13.5 22.6 5.9 33.4L221.3 344l46.4 66.2c7.6 10.9 5 25.8-5.9 33.4s-25.8 5-33.4-5.9L192 385.8l-36.3 51.9c-7.6 10.9-22.6 13.5-33.4 5.9s-13.5-22.6-5.9-33.4L162.7 344l-46.4-66.2c-7.6-10.9-5-25.8 5.9-33.4s25.8-5 33.4 5.9z"/></svg>
            Ekspor Excel
        </button>
    </div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <!-- Kolom non-kelompok -->
                    <th class="p-3 text-center whitespace-nowrap border-r border-b border-[#6DA854]" rowspan="2">Bulan</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Angsuran</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Pokok</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Wajib</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">M.Suka</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">SWP</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Qurban</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Beban Lain</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Piutang</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Hutang</th>
            
                    <!-- Grup Header -->
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="6">Beban Umum</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="4">Beban Organisasi</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="2">Beban Operasional</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="9">Lain-Lain</th>
            
                    <!-- Kolom akhir -->
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Tanah Kavling</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-b border-[#6DA854]" rowspan="2">Jumlah</th>
                </tr>
                <tr class="border-b border-[#6DA854]">
                    <!-- Subkolom Beban Umum -->
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Hari Lembur</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Perjalanan Pengawas</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">THR</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Admin</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Iuran Dekopinda</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Honor Pengurus</th>
            
                    <!-- Subkolom Beban Organisasi -->
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">RkRab</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Pembinaan</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Harkop</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Dandik</th>
            
                    <!-- Subkolom Beban Operasional -->
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Rapat</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Jasa Manasuka</th>
            
                    <!-- Subkolom Beban Lain -->
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Pajak</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Tabungan Qurban</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Dekopinda</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Wajib PKPRI</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Dansos</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">SHU</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Dana Pengurus</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Dana Kesejahteraan</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Pembayaran Listrik Dan Air</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jkks as $jkk)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="p-3 border-r border-[#6DA854] text-center">{{ $jkk['bulan'] }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_angsuran'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_pokok'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_wajib'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_m_suka'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_swp'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_qurban'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_lain_lain'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_piutang'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_hutang'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_hari_lembur'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_perjalanan_pengawas'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_thr'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_admin'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_iuran_dekopinda'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_honor_pengurus'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_rkrab'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_pembinaan'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_harkop'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_dandik'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_rapat'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_jasa_manasuka'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_pajak'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_tabungan_qurban'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_dekopinda'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_wajib_pkpri'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_dansos'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_shu'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_dana_pengurus'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_dana_kesejahteraan'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_pembayaran_listrik_dan_air'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">- Rp {{ number_format($jkk['total_tnh_kav'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-[#6DA854] font-bold">- Rp {{ number_format($jkk['total_jumlah'], 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-3">Tidak ada data rekap jurnal kas keluar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        <p class="text-lg font-semibold">Total Tahun {{ $selectedYear }}: - Rp {{ number_format($totalPerTahun, 0, ',', '.') }}</p>
    </div>
</div>
