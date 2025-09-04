<div>
    <div class="mb-8 flex justify-between items-center">
        <div class="relative w-2/3 sm:w-1/3">
            <div class="flex items-center">
                <select id="yearFilter" wire:model.change="selectedYear" class="p-2 bg-white border-2 border-[#6DA854] w-1/2 rounded-md">
                    @foreach ($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="relative w-full sm:w-64">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" wire:model.live="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500" placeholder="Search">
        </div>
    </div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-left text-[#6DA854] border-r border-b border-[#6DA854]" rowspan="2">No</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-[#6DA854]" rowspan="2">Nama</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-[#6DA854]" colspan="12">Bulan</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-[#6DA854]" rowspan="2">Jumlah</th>
                </tr>
                <tr class="border-b border-[#6DA854]">
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Januari</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Februari</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Maret</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">April</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Mei</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Juni</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Juli</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Agustus</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">September</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Oktober</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">November</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Desember</th>
                </tr>
            </thead>
            <tbody>
                @foreach($result as $dataAnggota)
                    @php
                        $bulanData = $dataAnggota['bulan'];
                        $jumlah = array_sum($bulanData);
                    @endphp
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="p-3 text-left border-r border-[#6DA854]">
                            {{ $result->firstItem() + $loop->index }}
                        </td>
                        <td class="p-3 border-l border-r border-[#6DA854] whitespace-nowrap">
                            {{ $dataAnggota['nama'] }}
                        </td>
            
                        @foreach($bulanData as $nilai)
                            <td class="p-3 text-right border-l border-r border-[#6DA854] whitespace-nowrap">
                                Rp {{ number_format($nilai, 0, ',', '.') }}
                            </td>
                        @endforeach
            
                        <td class="p-3 text-right border-l border-[#6DA854] font-bold whitespace-nowrap">
                            Rp {{ number_format($jumlah, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>            
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $result->links() }}
    </div>
</div>
