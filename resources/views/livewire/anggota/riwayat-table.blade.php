<div wire:poll.keep-alive.5s>
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
                                <th class="p-3 text-center border border-green-200">Tanggal</th>
                                <th class="p-3 text-center border border-green-200">Transaksi</th>
                                <th class="p-3 text-center border border-green-200">Jumlah</th>
                                <th class="p-3 text-center border border-green-200">Detail</th>
                            </tr>
                            </thead>
                            <!-- Table Body -->
                            <tbody>
                            @foreach($riwayat as $item)
                                @if (!isset($item->skip_render) || !$item->skip_render)
                                    <tr class="border-b border-green-200">
                                        <td class="p-3 text-center text-sm border border-green-200">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                        <td class="p-3 text-sm border border-green-200">{{ $item->transaksi }}</td>
                                        @if ($item->jenis_transaksi === 'kas masuk')
                                            <td class="p-3 text-right text-sm border border-green-200">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                        @elseif ($item->jenis_transaksi === 'kas keluar' || $item->kas_harian->jenis_transaksi === 'kas keluar')
                                            @if ($item->js_admin > 0 || $item->hutang > 0 || $item->barang_kons > 0)
                                                <td class="p-3 text-right text-sm border border-green-200">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                            @else
                                                <td class="p-3 text-right text-sm border border-green-200">- Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                            @endif
                                        @endif
                                        <td class="p-3 text-center text-sm border border-green-200">
                                            @if($item->type == 'kas')
                                                <a href="{{ route('detail-riwayat', $item->id) }}">
                                            @else
                                                <a href="{{ route('detail-tabungan-qurban', $item->id) }}">
                                            @endif
                                                <button class="px-3 py-1 bg-green-800 text-white rounded hover:bg-green-900">
                                                    Detail
                                                </button>
                                                @if ($item->pokok > 0 || $item->wajib > 0 || $item->manasuka > 0 || $item->wajib_pinjam > 0 || $item->qurban > 0 || $item->lain_lain > 0 || $item->hutang > 0 || $item->jasa > 0 || $item->angsuran > 0 || $item->barang_kons > 0)
                                                    <a href="{{ route('struk', $item->id) }}" target="_blank">
                                                        <button class="px-3 py-1 bg-blue-700 text-white rounded hover:bg-blue-600 ml-2">
                                                            Struk
                                                        </button>
                                                    </a>
                                                @endif
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
