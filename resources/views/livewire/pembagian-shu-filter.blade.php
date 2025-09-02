<div>
    <div class="mb-8 flex justify-between items-center">
        <div class="relative w-2/3 sm:w-1/3">
            <div class="flex items-center">
                <select id="yearFilter" wire:model.change="selectedYear" class="p-2 bg-white border-2 border-[#6DA854] w-1/2 rounded-md">
                    {{-- <option value="">Test</option> --}}
                    @foreach ($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-left text-[#6DA854] border-r border-b border-[#6DA854]" rowspan="2">No</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-[#6DA854]" rowspan="2">Nama</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-[#6DA854]" colspan="2">Jasa</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-[#6DA854]" rowspan="2">Jumlah</th>
                </tr>
                <tr class="border-b border-[#6DA854]">
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Simpanan</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">Partisipasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paginatedHasil as $index => $row)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="p-3 text-left border-r border-[#6DA854]">
                            {{ $index + 1 }}
                        </td>
                        <td class="p-3 border-l border-r border-[#6DA854] whitespace-nowrap">
                            {{ $row->nama_anggota}}
                        </td>
                        <td class="p-3 text-right border-l border-r border-[#6DA854] whitespace-nowrap">
                            Rp {{ number_format($row->simpanan, 0, ',', '.') }}
                        </td>
                        <td class="p-3 text-right border-l border-r border-[#6DA854] whitespace-nowrap">
                            Rp {{ number_format($row->partisipasi, 0, ',', '.') }}
                        </td>
                        <td class="p-3 text-right border-l border-[#6DA854] whitespace-nowrap">
                            Rp {{ number_format($row->jumlah, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $paginatedHasil->links() }}
    </div>
</div>
