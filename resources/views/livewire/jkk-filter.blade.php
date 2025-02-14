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
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Uraian
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Tanggal
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Angsuran
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
                            SWP
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Qurban
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Jasa
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            J.Admin
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Lain-Lain
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Piutang
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Hutang
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Biaya Umum
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Biaya Organisasi
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Biaya Operasional
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Biaya Lain
                        </div>
                    </th>
                    <th class="p-3 text-left">
                        <div class="flex items-center">
                            Tanah Kavling
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
                @forelse ($jkks as $index => $jkk)     
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="pl-5 text-[#6DA854]">{{ $jkks->firstItem() + $index }}</td>
                        <td class="p-3">{{ $jkk->nama }}</td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($jkk->tanggal)->translatedFormat('d-m-y') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_angsuran, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_pokok, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_wajib, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_manasuka, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_swp, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_qurban, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_jasa, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_j_admin, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_lain_lain, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_piutang, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_hutang, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_b_umum, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_b_orgns, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_b_oprs, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_b_lain, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_tnh_kav, 0, ',', '.') }}</td>
                        <td class="p-3">- Rp {{ number_format($jkk->total_jumlah, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $jkks->links() }}
    </div>   
</div>

