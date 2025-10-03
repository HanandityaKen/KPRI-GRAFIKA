<div wire:poll.keep-alive.5s>
    <div class="mb-8 flex justify-between items-center">
        <div class="relative w-2/3 sm:w-1/3">
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
                    <th class="p-3 text-center text-[#6DA854] border-r border-b border-[#6DA854]">No</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Nama</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Tanggal</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Nama Barang</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Nominal</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-b border-[#6DA854]">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($unit_konsumsis as $index => $unit_konsumsi)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="p-3 text-center text-[#6DA854] border-r border-[#6DA854]">{{ $unit_konsumsis->firstItem() + $index }}</td>
                        <td class="p-3 whitespace-nowrap border-l border-r border-[#6DA854]">{{ $unit_konsumsi->pengajuan_unit_konsumsi->nama_anggota  }}</td>
                        <td class="p-3 text-center whitespace-nowrap border-l border-r border-[#6DA854]">
                            {{ \Carbon\Carbon::parse($unit_konsumsi->pengajuan_unit_konsumsi->tanggal)->translatedFormat('d-m-Y') }}
                        </td>
                        <td class="p-3 whitespace-nowrap border-l border-r border-[#6DA854]">{{ ucwords($unit_konsumsi->pengajuan_unit_konsumsi->nama_barang)  }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">Rp {{ number_format($unit_konsumsi->pengajuan_unit_konsumsi->nominal, 0, ',', '.') }}</td>
                        <td class="p-3 text-center whitespace-nowrap border-l border-[#6DA854]">
                            @if ($unit_konsumsi->status == 'dalam pembayaran')
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-md border border-blue-400">Dalam Pembayaran</span>
                            @elseif ($unit_konsumsi->status == 'lunas')
                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-md border border-green-400">Lunas</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-3">Tidak ada data unit konsumsi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $unit_konsumsis->links() }}
    </div>
</div>
