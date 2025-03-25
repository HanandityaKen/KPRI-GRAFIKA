<div>
    <div class="mb-8 flex justify-between items-center">
        <div class="relative w-1/3">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" wire:model.live="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500" placeholder="Search">
        </div>
        <a href="{{ route('pengurus.kas-harian.create') }}" wire:ignore class="bg-green-800 text-white py-2 px-4 rounded-md flex items-center ml-4">
            <i data-lucide="plus" class="mr-2"></i>
            Tambah Kas Harian
        </a>
    </div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-left text-[#6DA854]">No</th>
                    <th class="p-3 text-left">Nama Anggota</th>
                    <th class="p-3 text-left">Jenis Transaksi</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Keterangan</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kasHarians as $index => $kasHarian)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="pl-5 text-[#6DA854]">{{ $kasHarians->firstItem() + $index }}</td>
                        <td class="p-3">{{$kasHarian->anggota->nama}}</td>
                        <td class="p-3">
                            @if ($kasHarian->jenis_transaksi == 'kas masuk')
                                Kas Masuk
                            @elseif ($kasHarian->jenis_transaksi == 'kas keluar')
                                Kas Keluar
                            @endif
                        </td>
                        <td class="p-3">
                            {{ \Carbon\Carbon::parse($kasHarian->tanggal)->translatedFormat('d-m-Y') }}
                        </td>
                        <td class="p-3">{{$kasHarian->keterangan}}</td>
                        <td class="whitespace-nowrap">
                            @if ($kasHarian->js_admin == 0 && $kasHarian->hutang == 0 && $kasHarian->jasa == 0 && $kasHarian->angsuran == 0 && $kasHarian->barang_kons == 0)
                                <a href="{{ route('pengurus.kas-harian.edit', $kasHarian->id) }}">
                                    <button class="px-3 py-1 bg-green-800 text-white rounded hover:bg-green-900 ml-2">
                                        Edit
                                    </button>
                                </a>
                                <button 
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2"
                                    onclick="confirmDelete({{ $kasHarian->id }})">
                                        Hapus
                                </button>
                                <form id="delete-form-{{ $kasHarian->id }}" action="{{ route('pengurus.kas-harian.destroy', $kasHarian->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-3">Tidak ada data kas harian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $kasHarians->links() }}
    </div>
</div>
