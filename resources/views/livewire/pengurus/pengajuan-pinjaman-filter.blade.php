@php
    $ketua = auth()->guard('pengurus')->check() && auth()->guard('pengurus')->user()->jabatan === 'ketua';
    $bendahara = auth()->guard('pengurus')->check() && auth()->guard('pengurus')->user()->jabatan === 'bendahara';
    $pengawas = auth()->guard('pengurus')->check() && auth()->guard('pengurus')->user()->jabatan === 'pengawas';
@endphp
<div>
    <div class="mb-8 flex justify-between items-center">
        <div class="relative w-2/3 sm:w-1/3">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" wire:model.live="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500" placeholder="Search">
        </div>
        @if ($bendahara)    
            <a href="{{ route('pengurus.pengajuan-pinjaman.create') }}" wire:ignore class="bg-green-800 text-white py-2 px-4 rounded-md flex items-center ml-4 whitespace-nowrap">
                <i data-lucide="plus" class="mr-2"></i>
                <span class="sm:hidden">Tambah</span>
                <span class="hidden sm:inline">Tambah Pengajuan Pinjaman</span>
            </a>
        @endif
    </div>

    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-center text-[#6DA854] border-r border-b border-[#6DA854]">No</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Nama</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Tanggal</th>
                    <th class="text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Nominal</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-b border-[#6DA854]">Status</th>
                    @if ($bendahara || $pengawas || $ketua)
                        <th class="p-3 text-center whitespace-nowrap border-l border-b border-[#6DA854]">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($pengajuanPinjamans as $index => $pengajuanPinjaman)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="p-3 text-center text-[#6DA854] border-r border-[#6DA854]">{{ $pengajuanPinjamans->firstItem() + $index }}</td>
                        <td class="p-3 whitespace-nowrap border-l border-r border-[#6DA854]">{{ $pengajuanPinjaman->nama_anggota }}</td>
                        <td class="p-3 text-center whitespace-nowrap border-l border-r border-[#6DA854]">
                            {{ \Carbon\Carbon::parse($pengajuanPinjaman->tanggal)->translatedFormat('d-m-Y') }}
                        </td>
                        <td class="p-3 text-right whitespace-nowrap border-l border-r border-[#6DA854]">Rp {{ number_format($pengajuanPinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
                        <td class="p-3 text-center whitespace-nowrap border-l border-[#6DA854]">
                            @if ($pengajuanPinjaman->status == 'menunggu')
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-1.5 py-0.5 rounded-sm">Menunggu</span>
                            @elseif ($pengajuanPinjaman->status == 'disetujui')
                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Disetujui</span>
                            @elseif ($pengajuanPinjaman->status == 'ditolak')
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Ditolak</span>
                            @endif
                        </td>
                        @if ($bendahara || $pengawas || $ketua)
                            <td class="p-3 text-center whitespace-nowrap border-l border-[#6DA854]">
                                @if ($bendahara)
                                    @if ($pengajuanPinjaman->status == 'menunggu')
                                        <a href="{{ route('pengurus.pengajuan-pinjaman.edit', $pengajuanPinjaman->id) }}">
                                            <button class="px-3 py-1 bg-green-800 text-white rounded hover:bg-green-900">
                                                Edit
                                            </button>
                                        </a>
                                        <button 
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                            onclick="confirmDelete({{ $pengajuanPinjaman->id }})">
                                                Hapus
                                        </button>
                                        <form id="delete-form-{{ $pengajuanPinjaman->id }}" 
                                            action="{{ route('pengurus.pengajuan-pinjaman.destroy', $pengajuanPinjaman->id) }}" 
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                @elseif ($pengawas || $ketua)
                                    @if ($pengajuanPinjaman->status == 'menunggu')   
                                        <form action="{{ route('pengurus.setujui-pengajuan-pinjaman', $pengajuanPinjaman->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-green-800 text-white rounded hover:bg-green-900">
                                                Disetujui
                                            </button>
                                        </form>
                                    
                                        <form action="{{ route('pengurus.tolak-pengajuan-pinjaman', $pengajuanPinjaman->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-500">
                                                Ditolak
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('pengurus.detail-pengajuan-pinjaman', $pengajuanPinjaman->id) }}">
                                        <button class="px-3 py-1 bg-blue-700 text-white rounded hover:bg-blue-600">
                                            Detail
                                        </button>
                                    </a>
                                @endif
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-3">Tidak ada data pengajuan pinjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $pengajuanPinjamans->links() }}
    </div>        
</div>
