<div>
    <div class="mb-8 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <!-- Select Tahun & Bulan -->
        <div class="flex flex-row items-center space-x-4">
            <div class="flex items-center">
                <label for="yearFilter" class="mr-2">Tahun:</label>
                <select id="yearFilter" wire:model.change="selectedYear" class="p-2 bg-white border-2 border-[#6DA854] w-[100px] rounded-md">
                    <option value="">Pilih Tahun</option>
                    @foreach ($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center">
                <label for="monthFilter" class="mr-2">Bulan:</label>
                <select id="monthFilter" wire:model.change="selectedMonth" class="p-2 bg-white border-2 border-[#6DA854] w-[100px] rounded-md">
                    <option value="">Pilih Bulan</option>
                    @foreach($availableMonths as $month)
                        <option value="{{ $month['value'] }}">{{ $month['label'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    
        <!-- Search -->
        <div class="relative w-full sm:w-64 max-w-xs">
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
                    <th class="p-3 text-left">Nama Anggota</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Jenis Transaksi</th>
                    <th class="p-3 text-left">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayatTransaksis as $index => $riwayatTransaksi)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="pl-5 text-[#6DA854]">{{ $riwayatTransaksis->firstItem() + $index }}</td>
                        <td class="p-3">{{$riwayatTransaksi->nama_anggota}}</td>
                        <td class="p-3">
                            {{ \Carbon\Carbon::parse($riwayatTransaksi->tanggal)->translatedFormat('d-m-Y') }}
                        </td>
                        <td class="p-3">
                            @if ($riwayatTransaksi->jenis_transaksi == 'kas masuk')
                                Kas Masuk
                            @elseif ($riwayatTransaksi->jenis_transaksi == 'kas keluar')
                                Kas Keluar
                            @endif
                        </td>
                        <td class="p-3 whitespace-nowrap">Rp {{ number_format($riwayatTransaksi->total, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-3">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $riwayatTransaksis->links() }}
    </div>
</div>
