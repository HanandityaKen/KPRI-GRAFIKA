<div>
    <div class="container mx-auto px-6 md:px-20 mt-10 mb-10">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="border border-green-200 rounded-lg">
                <div class="p-6">
                    <div class="divide-y divide-green-200">
                        <div class="overflow-x-auto no-scrollbar">
                            <table class="w-full border-collapse border border-green-200">
                                <thead class="bg-green-100">
                                    <tr>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Tahun</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" colspan="12">Jasa</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Jumlah</th>
                                    </tr>
                                    <tr>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Januari</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Februari</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Maret</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">April</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Mei</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Juni</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Juli</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Agustus</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">September</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Oktober</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">November</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Desember</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="px-4 py-3 text-center text-base border-r border-green-200 whitespace-nowrap">
                                            {{ now()->year }}
                                        </td>
                            
                                        @foreach ($jasa['bulan'] as $bulan => $nilai)
                                            @if ($bulan <= now()->month)
                                                <td class="px-4 py-3 text-right text-base border-r border-l border-green-200 whitespace-nowrap">
                                                    Rp {{ number_format($nilai, 0, ',', '.') }}
                                                </td>
                                            @else
                                                <td class="px-4 py-3 text-center text-base border-r border-l border-green-200 whitespace-nowrap">
                                                    -
                                                </td>
                                            @endif
                                        @endforeach
                            
                                        <td class="px-4 py-3 text-right text-base border-l border-green-200 whitespace-nowrap">
                                            Rp {{ number_format(array_sum($jasa['bulan']), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
