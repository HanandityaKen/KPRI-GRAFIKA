<div>
    <div class="container mx-auto px-6 md:px-20 mt-10 mb-10">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="border border-green-200 rounded-lg">
                <div class="p-6">
                    <div class="divide-y divide-green-200">
                        <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-green-200">
                            <!-- Table Head -->
                            <thead class="bg-green-100">
                            <tr>
                                <th class="border border-green-200 px-4 py-2 text-left">Tanggal</th>
                                <th class="border border-green-200 px-4 py-2 text-left">Transaksi</th>
                                <th class="border border-green-200 px-4 py-2 text-left">Jumlah</th>
                                <th class="border border-green-200 px-4 py-2 text-left">Detail</th>
                            </tr>
                            </thead>
                            <!-- Table Body -->
                            <tbody>
                            @foreach($riwayat as $item)
                                @if (!$item->skip_render)
                                    <tr class="border-b border-green-200">
                                        <td class="px-4 py-2 text-sm">{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $item->transaksi }}</td>
                                        <td class="px-4 py-2 text-sm">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 text-sm">
                                            <a href="{{ route('detail-riwayat', $item->id) }}">
                                                <button class="px-3 py-1 bg-blue-700 text-white rounded hover:bg-blue-600">
                                                    Detail
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="mt-4">
                        {{ $riwayat->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
