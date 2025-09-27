<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
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
    </div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-left text-[#6DA854] border-r border-b border-[#6DA854]" rowspan="2">No</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Perkiraan Buku Besar</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="2">Neraca Awal {{ $tahunNeracaAwal }}</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="2">N. Perubahan</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="2">N. Percobaan</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="2">N. Saldo</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="2">A. Penyesuaian</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="2">NS. Disesuaikan</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="2">Rugi dan Laba</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-b border-[#6DA854]" colspan="2">Neraca {{ $selectedYear }}</th>
                </tr>
                <tr class="border-b border-[#6DA854]">
                    {{-- Neraca Awal --}}
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">D</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">K</th>

                    {{-- N. Perubahan --}}
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">D</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">K</th>

                    {{-- N. Percobaan --}}
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">D</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">K</th>

                    {{-- N. Saldo --}}
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">D</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">K</th>

                    {{-- A. Penyesuaian --}}
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">D</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">K</th>

                    {{-- NS. Disesuaikan --}}
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">D</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">K</th>

                    {{-- Rugi dan Laba --}}
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">D</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">K</th>

                    {{-- Neraca --}}
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">D</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-[#6DA854]">K</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fields as $index => $field)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="p-3 border-r border-[#6DA854] text-center">{{ $index + 1 }}</td>
                        <td class="p-3 border border-[#6DA854]">{{ ucwords(str_replace('_', ' ', $field)) }}</td>

                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['neraca_awal_d'], 0, ',', '.') }}</td>
                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['neraca_awal_k'], 0, ',', '.') }}</td>

                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['n_perubahan_d'], 0, ',', '.') }}</td>
                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['n_perubahan_k'], 0, ',', '.') }}</td>

                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['n_percobaan_d'], 0, ',', '.') }}</td>
                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['n_percobaan_k'], 0, ',', '.') }}</td>

                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['n_saldo_d'], 0, ',', '.') }}</td>
                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['n_saldo_k'], 0, ',', '.') }}</td>

                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['a_penyesuaian_d'], 0, ',', '.') }}</td>
                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['a_penyesuaian_k'], 0, ',', '.') }}</td>

                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['ns_disesuaikan_d'], 0, ',', '.') }}</td>
                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['ns_disesuaikan_k'], 0, ',', '.') }}</td>

                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['rugi_dan_laba_d'], 0, ',', '.') }}</td>
                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['rugi_dan_laba_k'], 0, ',', '.') }}</td>

                        <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['neraca_d'], 0, ',', '.') }}</td>
                        <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($data[$field]['neraca_k'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="font-bold bg-gray-100">
                    <td class="p-3 border-t border-b border-r border-[#6DA854] text-center" colspan="2">Jumlah</td>
            
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['neraca_awal_d'], 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['neraca_awal_k'], 0, ',', '.') }}</td>
            
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['n_perubahan_d'], 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['n_perubahan_k'], 0, ',', '.') }}</td>
            
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['n_percobaan_d'], 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['n_percobaan_k'], 0, ',', '.') }}</td>
            
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['n_saldo_d'], 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['n_saldo_k'], 0, ',', '.') }}</td>
            
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['a_penyesuaian_d'], 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['a_penyesuaian_k'], 0, ',', '.') }}</td>
            
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['ns_disesuaikan_d'], 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['ns_disesuaikan_k'], 0, ',', '.') }}</td>
            
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['rugi_dan_laba_d'], 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['rugi_dan_laba_k'], 0, ',', '.') }}</td>
            
                    <td class="p-3 border border-[#6DA854] text-right">{{ number_format($data['jumlah']['neraca_d'], 0, ',', '.') }}</td>
                    <td class="p-3 border-t border-b border-l border-[#6DA854] text-right">{{ number_format($data['jumlah']['neraca_k'], 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
