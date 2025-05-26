<div>
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
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            Bulan
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            Angsuran
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            Pokok
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            Wajib
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            M.Suka
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            SWP
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            Qurban
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            Lain-lain
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            Piutang
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            Hutang
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            Beban Umum
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            Beban Organisasi
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            Beban Operasional
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            Beban Lain
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap">
                        <div class="flex items-center text-sm">
                            Tanah Kavling
                            {{-- <i data-lucide="arrow-down-up" class="ml-2 w-4"></i> --}}
                        </div>
                    </th>
                    <th class="p-3 text-left whitespace-nowrap text-sm">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jkks as $jkk)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="p-3">{{ $jkk['bulan'] }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk['total_angsuran'], 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk['total_pokok'], 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk['total_wajib'], 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk['total_m_suka'], 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk['total_swp'], 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk['total_qurban'], 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk['total_lain_lain'], 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk['total_piutang'], 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk['total_hutang'], 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk['total_b_umum'], 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk['total_b_orgns'], 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk['total_b_oprs'], 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk['total_b_lain'], 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk['total_tnh_kav'], 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap font-bold">- Rp {{ number_format($jkk['total_jumlah'], 0, ',', '.') }}</td>
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
