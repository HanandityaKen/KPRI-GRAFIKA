<div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-left text-[#6DA854]">No</th>
                    <th class="p-3 text-left whitespace-nowrap">Nama</th>
                    <th class="p-3 text-left whitespace-nowrap">Tanggal</th>
                    <th class="p-3 text-left whitespace-nowrap">Barang</th>
                    <th class="p-3 text-left whitespace-nowrap">Nominal Barang</th>
                    <th class="p-3 text-left whitespace-nowrap">Status</th>
                    <th class="p-3 text-left whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengajuanUnitKonsumsis as $index => $pengajuanUnitKonsumsi)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="pl-5 text-[#6DA854]">{{ $pengajuanUnitKonsumsis->firstItem() + $index }}</td>
                        <td class="p-3 whitespace-nowrap">{{ $pengajuanUnitKonsumsi->anggota->nama }}</td>
                        <td class="p-3 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($pengajuanUnitKonsumsi->created_at)->translatedFormat('d-m-Y') }}
                        </td>
                        <td class="p-3 whitespace-nowrap">{{ $pengajuanUnitKonsumsi->nama_barang }}</td>
                        <td class="p-3 whitespace-nowrap">Rp {{ number_format($pengajuanUnitKonsumsi->nominal, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">
                            @if ($pengajuanUnitKonsumsi->status == 'menunggu')
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-1.5 py-0.5 rounded-sm">Menunggu</span>
                            @elseif ($pengajuanUnitKonsumsi->status == 'disetujui')
                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Disetujui</span>
                            @elseif ($pengajuanUnitKonsumsi->status == 'ditolak')
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Ditolak</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap">
                            <form action="{{ route('admin.setujui-pengajuan-unit-konsumsi', $pengajuanUnitKonsumsi->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-green-800 text-white rounded hover:bg-green-900 ml-2">
                                    Disetujui
                                </button>
                            </form>
                        
                            <form action="{{ route('admin.tolak-pengajuan-unit-konsumsi', $pengajuanUnitKonsumsi->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-500 ml-2">
                                    Ditolak
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-3">Tidak ada data pengajuan unit konsumsi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $pengajuanUnitKonsumsis->links() }}
    </div> 
</div>
