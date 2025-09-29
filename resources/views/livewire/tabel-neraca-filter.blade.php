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
        <button wire:click="exportExcel" class="flex items-center px-4 py-2 bg-green-800 text-white rounded ml-4 whitespace-nowrap">
            <svg class="w-4 h-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM155.7 250.2L192 302.1l36.3-51.9c7.6-10.9 22.6-13.5 33.4-5.9s13.5 22.6 5.9 33.4L221.3 344l46.4 66.2c7.6 10.9 5 25.8-5.9 33.4s-25.8 5-33.4-5.9L192 385.8l-36.3 51.9c-7.6 10.9-22.6 13.5-33.4 5.9s-13.5-22.6-5.9-33.4L162.7 344l-46.4-66.2c-7.6-10.9-5-25.8 5.9-33.4s25.8-5 33.4 5.9z"/></svg>
            Ekspor Excel
        </button>
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
                        <td class="p-3 border-r border-b border-[#6DA854] text-center">{{ $index + 1 }}</td>
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
