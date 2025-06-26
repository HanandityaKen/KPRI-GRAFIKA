<div>
    <div class="mb-8 flex justify-between items-center">        
        <div class="relative w-2/3 sm:w-1/3">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" wire:model.live="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500" placeholder="Search">
        </div>
        <button wire:click="exportExcel" class="flex items-center px-4 py-2 bg-green-800 text-white rounded ml-4 whitespace-nowrap">
            <svg class="w-4 h-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM155.7 250.2L192 302.1l36.3-51.9c7.6-10.9 22.6-13.5 33.4-5.9s13.5 22.6 5.9 33.4L221.3 344l46.4 66.2c7.6 10.9 5 25.8-5.9 33.4s-25.8 5-33.4-5.9L192 385.8l-36.3 51.9c-7.6 10.9-22.6 13.5-33.4 5.9s-13.5-22.6-5.9-33.4L162.7 344l-46.4-66.2c-7.6-10.9-5-25.8 5.9-33.4s25.8-5 33.4 5.9z"/></svg>
            Ekspor Excel
        </button>
    </div>

    <!-- Anggota Table -->
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="p-3 text-left text-[#6DA854]">No</th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            No. Anggota
                        </div>
                    </th>

                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Nama
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Pokok
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Wajib
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            M.Suka
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            WP
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Qurban
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Jumlah
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($simpanans as $index => $simpanan)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="pl-5 text-[#6DA854]">{{ $simpanans->firstItem() + $index }}</td>
                        <td class="p-3 whitespace-nowrap">{{ $simpanan->no_anggota }}</td>
                        <td class="p-3 whitespace-nowrap">{{ $simpanan->nama_anggota }}</td>
                        <td class="p-3 whitespace-nowrap">Rp {{ number_format($simpanan->total_pokok, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">Rp {{ number_format($simpanan->total_wajib, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">Rp {{ number_format($simpanan->total_manasuka, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">Rp {{ number_format($simpanan->total_wajib_pinjam, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">Rp {{ number_format($simpanan->total_qurban, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap font-bold">Rp {{ number_format($simpanan->total_pokok + $simpanan->total_wajib + $simpanan->total_manasuka + $simpanan->total_wajib_pinjam + $simpanan->total_qurban, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-3">Tidak ada data simpanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $simpanans->links() }}
    </div>
</div>
