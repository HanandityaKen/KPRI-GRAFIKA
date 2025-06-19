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
    </div>

    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-left text-[#6DA854]">No</th>
                    <th class="p-3 text-left whitespace-nowrap">Nama</th>
                    <th class="p-3 text-left whitespace-nowrap">Tanggal</th>
                    <th class="text-left whitespace-nowrap">Nominal</th>
                    <th class="p-3 text-left whitespace-nowrap">Status</th>
                    <th class="p-3 text-left whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengajuanPinjamans as $index => $pengajuanPinjaman)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="pl-5 text-[#6DA854]">{{ $pengajuanPinjamans->firstItem() + $index }}</td>
                        <td class="p-3 whitespace-nowrap">{{ $pengajuanPinjaman->nama_anggota  }}</td>
                        <td class="p-3 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($pengajuanPinjaman->created_at)->translatedFormat('d-m-Y') }}
                        </td>
                        <td class="whitespace-nowrap">Rp {{ number_format($pengajuanPinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">
                            @if ($pengajuanPinjaman->status == 'menunggu')
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-1.5 py-0.5 rounded-sm">Menunggu</span>
                            @elseif ($pengajuanPinjaman->status == 'disetujui')
                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Disetujui</span>
                            @elseif ($pengajuanPinjaman->status == 'ditolak')
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Ditolak</span>
                            @endif
                        </td>
                        <td class="p-3 whitespace-nowrap">
                            @if ($pengajuanPinjaman->status == 'menunggu')
                                <button data-modal-target="setujui-modal-{{ $pengajuanPinjaman->id }}" data-modal-toggle="setujui-modal-{{ $pengajuanPinjaman->id }}" class="px-3 py-1 bg-green-800 text-white rounded hover:bg-green-900" type="button">
                                    Disetujui
                                </button>

                                {{-- setujui modal --}}
                                <div id="setujui-modal-{{ $pengajuanPinjaman->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-40">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow-xl">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-5 border-b border-gray-200">
                                                <h3 class="text-xl font-semibold text-gray-900">
                                                    Persetujuan Pinjaman
                                                </h3>
                                                <button type="button" class="text-gray-400 hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="setujui-modal-{{ $pengajuanPinjaman->id }}">
                                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            
                                            <form id="form-setujui" action="{{ route('admin.setujui-pengajuan-pinjaman', $pengajuanPinjaman->id) }}" method="POST" class="inline">
                                                @csrf
                                                <!-- Modal body -->
                                                <div class="p-6 space-y-4">
                                                    <div>
                                                        <label class="block mb-2 text-sm font-medium text-gray-700">Disetujui Oleh</label>
                                                        <select id="select_nama_setujui" name="reviewed_by" class="select-nama-setujui bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 transition duration-200" required>
                                                            <option value="" disabled selected>Pilih Nama</option>
                                                            @foreach ($anggotaList as $id => $nama)
                                                                <option value="{{ $nama }}" {{ old('anggota_id') == $nama ? 'selected' : '' }}>{{ $nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="flex items-start gap-3 p-4 bg-blue-50 rounded-lg border border-blue-100 text-sm text-blue-800">
                                                        <svg class="w-5 h-5 mt-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        <p class="text-sm whitespace-normal leading-relaxed">Pastikan data pinjaman sudah benar sebelum menyetujui</p>
                                                    </div>
                                            
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="flex items-center justify-end p-6 pt-0 space-x-3 border-t border-gray-200 rounded-b">
                                                    <div class="mt-3">
                                                        <button data-modal-hide="setujui-modal-{{ $pengajuanPinjaman->id }}" type="button" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg focus:outline-none transition duration-200">
                                                            Batal
                                                        </button>
                                                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-green-800 hover:bg-green-900 rounded-lg transition duration-200">
                                                            Setujui Pinjaman
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <button data-modal-target="tolak-modal-{{ $pengajuanPinjaman->id }}" data-modal-toggle="tolak-modal-{{ $pengajuanPinjaman->id }}" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-500" type="button">
                                    Ditolak
                                </button>

                                {{-- tolak modal --}}
                                <div id="tolak-modal-{{ $pengajuanPinjaman->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-40">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow-xl">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-5 border-b border-gray-200">
                                                <h3 class="text-xl font-semibold text-gray-900">
                                                    Penolakan Pinjaman
                                                </h3>
                                                <button type="button" class="text-gray-400 hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="tolak-modal-{{ $pengajuanPinjaman->id }}">
                                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            
                                            <form id="form-tolak" action="{{ route('admin.tolak-pengajuan-pinjaman', $pengajuanPinjaman->id) }}" method="POST" class="inline">
                                                @csrf
                                                <!-- Modal body -->
                                                <div class="p-6 space-y-4">
                                                    <div>
                                                        <label class="block mb-2 text-sm font-medium text-gray-700">Ditolak Oleh</label>
                                                        <select id="select_nama_tolak" name="reviewed_by" class="select-nama-tolak bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 transition duration-200" required>
                                                            <option value="" disabled selected>Pilih Nama</option>
                                                            @foreach ($anggotaList as $id => $nama)
                                                                <option value="{{ $nama }}" {{ old('anggota_id') == $nama ? 'selected' : '' }}>{{ $nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="flex items-start gap-3 p-4 bg-blue-50 rounded-lg border border-blue-100 text-sm text-blue-800">
                                                        <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        <p class="text-sm whitespace-normal leading-relaxed">Pastikan data pinjaman sudah benar</p>
                                                    </div>
                                            
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="flex items-center justify-end p-6 pt-0 space-x-3 border-t border-gray-200 rounded-b">
                                                    <div class="mt-3">
                                                        <button data-modal-hide="tolak-modal-{{ $pengajuanPinjaman->id }}" type="button" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg focus:outline-none transition duration-200">
                                                            Batal
                                                        </button>
                                                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-red-500 hover:bg-red-500 rounded-lg transition duration-200">
                                                            Tolak Pinjaman
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <a href="{{ route('admin.detail-pengajuan-pinjaman', $pengajuanPinjaman->id) }}">
                                <button class="px-3 py-1 bg-blue-700 text-white rounded hover:bg-blue-600">
                                    Detail
                                </button>
                            </a>
                        </td>
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
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.select-nama-setujui').forEach(select => {
                new TomSelect(select, {
                    create: false,
                    sortField: { field: "text", direction: "asc" },
                    openOnFocus: true,
                    maxOptions: 10,
                });
            });

            document.querySelectorAll('.select-nama-tolak').forEach(select => {
                new TomSelect(select, {
                    create: false,
                    sortField: { field: "text", direction: "asc" },
                    openOnFocus: true,
                    maxOptions: 10,
                });
            });
        });
    </script>
@endpush
