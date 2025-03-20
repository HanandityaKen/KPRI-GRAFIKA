<div>
    <div class="mb-8 flex justify-between items-center">
        <div class="relative w-1/3">
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
                    <th class="p-3 text-left text-[#6DA854]">No</th>
                    <th class="p-3 text-left whitespace-nowrap">Nama</th>
                    <th class="p-3 text-left whitespace-nowrap">Total Pinjam</th>
                    <th class="p-3 text-left whitespace-nowrap">Lama Angsuran</th>
                    <th class="p-3 text-left whitespace-nowrap">Nominal Angsuran</th>
                    <th class="p-3 text-left whitespace-nowrap">Nominal Pokok</th>
                    <th class="p-3 text-left whitespace-nowrap">Nominal Jasa</th>
                    <th class="p-3 text-left whitespace-nowrap">Kurang Angsuran</th>
                    <th class="p-3 text-left whitespace-nowrap">Kurang Jasa</th>
                    <th class="p-3 text-left whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($angsurans as $index => $angsuran)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="pl-5 text-[#6DA854]">{{ $angsurans->firstItem() + $index }}</td>
                        <td class="p-3 whitespace-nowrap">{{ $angsuran->pinjaman->pengajuan_pinjaman->anggota->nama }}</td>
                        <td class="p-3 whitespace-nowrap">Rp {{ number_format($angsuran->pinjaman->pengajuan_pinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">{{ ucwords($angsuran->pinjaman->pengajuan_pinjaman->lama_angsuran) }}</td>
                        <td class="p-3 whitespace-nowrap">Rp {{ number_format($angsuran->pinjaman->pengajuan_pinjaman->nominal_angsuran, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">Rp {{ number_format($angsuran->pinjaman->pengajuan_pinjaman->nominal_pokok, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">Rp {{ number_format($angsuran->pinjaman->pengajuan_pinjaman->nominal_bunga, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">Rp {{ number_format($angsuran->kurang_angsuran, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">Rp {{ number_format($angsuran->kurang_jasa, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('pengurus.kas-harian.create') }}">
                                <button class="px-3 py-1 bg-green-800 text-white rounded hover:bg-green-900 ml-2">
                                    Bayar
                                </button>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-3">Tidak ada data angsuran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $angsurans->links() }}
    </div>        
</div>
