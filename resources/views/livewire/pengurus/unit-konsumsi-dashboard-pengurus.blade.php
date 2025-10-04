@php
    $ketua = auth()->guard('pengurus')->check() && auth()->guard('pengurus')->user()->jabatan === 'ketua';
    $bendahara = auth()->guard('pengurus')->check() && auth()->guard('pengurus')->user()->jabatan === 'bendahara';
    $pembantu_umum = auth()->guard('pengurus')->check() && auth()->guard('pengurus')->user()->jabatan === 'pembantu umum';
    $pengawas = auth()->guard('pengurus')->check() && auth()->guard('pengurus')->user()->jabatan === 'pengawas';
@endphp
<div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-center text-[#6DA854] border-r border-b border-[#6DA854]">No</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Nama</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Tanggal</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Barang</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Nominal Barang</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-b border-[#6DA854]">Status</th>
                    @if ($bendahara || $pembantu_umum || $pengawas || $ketua)
                        <th class="p-3 text-center whitespace-nowrap border-l border-b border-[#6DA854]">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($pengajuanUnitKonsumsis as $index => $pengajuanUnitKonsumsi)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="p-3 text-center text-[#6DA854] border-r border-[#6DA854]">{{ $pengajuanUnitKonsumsis->firstItem() + $index }}</td>
                        <td class="p-3 whitespace-nowrap border-l border-r border-[#6DA854]">{{ $pengajuanUnitKonsumsi->nama_anggota }}</td>
                        <td class="p-3 text-center whitespace-nowrap border-l border-r border-[#6DA854]">
                            {{ \Carbon\Carbon::parse($pengajuanUnitKonsumsi->tanggal)->translatedFormat('d-m-Y') }}
                        </td>
                        <td class="p-3 whitespace-nowrap border-l border-r border-[#6DA854]">{{ $pengajuanUnitKonsumsi->nama_barang }}</td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">Rp {{ number_format($pengajuanUnitKonsumsi->nominal, 0, ',', '.') }}</td>
                        <td class="p-3 text-center whitespace-nowrap border-l border-[#6DA854]">
                            @if ($pengajuanUnitKonsumsi->status == 'menunggu')
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-1.5 py-0.5 rounded-sm">Menunggu</span>
                            @elseif ($pengajuanUnitKonsumsi->status == 'disetujui')
                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Disetujui</span>
                            @elseif ($pengajuanUnitKonsumsi->status == 'ditolak')
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Ditolak</span>
                            @endif
                        </td>
                        <td class="p-3 text-center whitespace-nowrap border-l border-[#6DA854]">
                            @if ($bendahara || $pembantu_umum)
                                @if ($pengajuanUnitKonsumsi->status == 'menunggu')
                                    <a href="{{ route('pengurus.pengajuan-unit-konsumsi.edit', $pengajuanUnitKonsumsi->id) }}">
                                        <button class="px-3 py-1 bg-green-800 text-white rounded hover:bg-green-900">
                                            Edit
                                        </button>
                                    </a>
                                    <button 
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                        onclick="confirmDelete({{ $pengajuanUnitKonsumsi->id }})">
                                            Hapus
                                    </button>
                                    <form id="delete-form-{{ $pengajuanUnitKonsumsi->id }}" action="{{ route('pengurus.pengajuan-unit-konsumsi.destroy', $pengajuanUnitKonsumsi->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                            @elseif ($pengawas || $ketua)
                                @if ($pengajuanUnitKonsumsi->status == 'menunggu')
                                    <form action="{{ route('pengurus.setujui-pengajuan-unit-konsumsi', $pengajuanUnitKonsumsi->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-green-800 text-white rounded hover:bg-green-900">
                                            Disetujui
                                        </button>
                                    </form>
                                
                                    <form action="{{ route('pengurus.tolak-pengajuan-unit-konsumsi', $pengajuanUnitKonsumsi->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-500">
                                            Ditolak
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('pengurus.detail-pengajuan-unit-konsumsi', $pengajuanUnitKonsumsi->id) }}">
                                    <button class="px-3 py-1 bg-blue-700 text-white rounded hover:bg-blue-600">
                                        Detail
                                    </button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center py-3">Tidak ada data pengajuan unit konsumsi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $pengajuanUnitKonsumsis->links() }}
    </div> 
</div>
