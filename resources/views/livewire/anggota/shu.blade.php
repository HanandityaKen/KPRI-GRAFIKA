<div>
    <div class="container mx-auto px-6 md:px-20 mt-10 mb-10">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="border border-green-200 rounded-lg">
                <div class="p-6">
                    <div class="divide-y divide-green-200">
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-green-200">
                                <thead class="bg-green-100">
                                    <tr>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Tahun</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" colspan="2">Jasa</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Jumlah</th>
                                    </tr>
                                    <tr>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Simpanan</th>
                                        <th class="border border-green-200 px-4 py-3 text-center" rowspan="2">Partisipasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($shuData->isNotEmpty())
                                        <tr class="border-b border-green-200 hover:bg-gray-100">
                                            <td class="px-4 py-3 text-center text-base border-r border-green-200 whitespace-nowrap">
                                                {{ $shuData['tahun'] }}
                                            </td>
                                            <td class="px-4 py-3 text-right text-base border-r border-l border-green-200 whitespace-nowrap">
                                                Rp {{ number_format($shuData['simpanan'], 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 text-right text-base border-r border-l border-green-200 whitespace-nowrap">
                                                Rp {{ number_format($shuData['partisipasi'], 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 text-right text-base border-l border-green-200 whitespace-nowrap">
                                                Rp {{ number_format($shuData['jumlah'], 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="6" class="p-6 text-center text-gray-500">
                                                tidak ada data SHU
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
