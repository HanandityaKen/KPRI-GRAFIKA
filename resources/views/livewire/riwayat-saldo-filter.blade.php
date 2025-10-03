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
    </div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-center whitespace-nowrap border-r border-b border-[#6DA854]">
                        Bulan
                    </th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">
                        Saldo Awal
                    </th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">
                        Kas Masuk
                    </th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">
                        Kas Keluar
                    </th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-b border-[#6DA854]">
                        Saldo Akhir
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayatSaldo as $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="p-3 text-center border-r border-[#6DA854]">{{ $item['bulan'] }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">Rp {{ number_format($item['saldo_awal'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">Rp {{ number_format($item['kas_masuk'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">Rp {{ number_format($item['kas_keluar'], 0, ',', '.') }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-[#6DA854]">Rp {{ number_format($item['saldo_akhir'], 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-3">Tidak ada riwayat saldo.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

