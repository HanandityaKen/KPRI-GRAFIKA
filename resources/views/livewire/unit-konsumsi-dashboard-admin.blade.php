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
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Status</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-b border-[#6DA854]">Action</th>
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
                        <td class="p-3 text-center whitespace-nowrap border-l border-r border-[#6DA854]">
                            @if ($pengajuanUnitKonsumsi->status == 'menunggu')
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-1.5 py-0.5 rounded-sm">Menunggu</span>
                            @elseif ($pengajuanUnitKonsumsi->status == 'disetujui')
                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Disetujui</span>
                            @elseif ($pengajuanUnitKonsumsi->status == 'ditolak')
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Ditolak</span>
                            @endif
                        </td>
                        <td class="p-3 text-center whitespace-nowrap border-l border-[#6DA854]">
                            @if ($pengajuanUnitKonsumsi->status == 'menunggu')
                                <button data-modal-target="setujui-modal-{{ $pengajuanUnitKonsumsi->id }}" data-modal-toggle="setujui-modal-{{ $pengajuanUnitKonsumsi->id }}" class="px-3 py-1 bg-green-800 text-white rounded hover:bg-green-900" type="button">
                                    Disetujui
                                </button>

                                {{-- setujui modal --}}
                                <div id="setujui-modal-{{ $pengajuanUnitKonsumsi->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full min-h-screen bg-gray-900 bg-opacity-40">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow-xl">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-5 border-b border-gray-200">
                                                <h3 class="text-xl font-semibold text-gray-900">
                                                    Persetujuan Pinjaman
                                                </h3>
                                                <button type="button" class="text-gray-400 hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="setujui-modal-{{ $pengajuanUnitKonsumsi->id }}">
                                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            
                                            <form id="form-setujui" action="{{ route('admin.setujui-pengajuan-unit-konsumsi', $pengajuanUnitKonsumsi->id) }}" method="POST" class="inline">
                                                @csrf
                                                <!-- Modal body -->
                                                <div class="p-6 space-y-4">
                                                    <div>
                                                        <label class="block mb-2 text-sm text-left font-medium text-gray-700">Disetujui Oleh</label>
                                                        <select id="select_nama_setujui" name="reviewed_by" class="select-nama-setujui text-left bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 transition duration-200" required>
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
                                                        <p class="text-sm text-left whitespace-normal leading-relaxed">Pastikan data unit konsumsi sudah benar sebelum menyetujui</p>
                                                    </div>
                                            
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="flex items-center justify-end p-6 pt-0 space-x-3 border-t border-gray-200 rounded-b">
                                                    <div class="mt-3">
                                                        <button data-modal-hide="setujui-modal-{{ $pengajuanUnitKonsumsi->id }}" type="button" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg focus:outline-none transition duration-200">
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

                                <button data-modal-target="tolak-modal-{{ $pengajuanUnitKonsumsi->id }}" data-modal-toggle="tolak-modal-{{ $pengajuanUnitKonsumsi->id }}" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-500" type="button">
                                    Ditolak
                                </button>

                                {{-- tolak modal --}}
                                <div id="tolak-modal-{{ $pengajuanUnitKonsumsi->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full min-h-screen bg-gray-900 bg-opacity-40">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow-xl">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-5 border-b border-gray-200">
                                                <h3 class="text-xl font-semibold text-gray-900">
                                                    Penolakan Pinjaman
                                                </h3>
                                                <button type="button" class="text-gray-400 hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="tolak-modal-{{ $pengajuanUnitKonsumsi->id }}">
                                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            
                                            <form id="form-tolak" action="{{ route('admin.tolak-pengajuan-unit-konsumsi', $pengajuanUnitKonsumsi->id) }}" method="POST" class="inline">
                                                @csrf
                                                <!-- Modal body -->
                                                <div class="p-6 space-y-4">
                                                    <div>
                                                        <label class="block mb-2 text-sm text-left font-medium text-gray-700">Ditolak Oleh</label>
                                                        <select id="select_nama_tolak" name="reviewed_by" class="select-nama-tolak text-left bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 transition duration-200" required>
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
                                                        <p class="text-sm text-left whitespace-normal leading-relaxed">Pastikan data unit konsumsi sudah benar</p>
                                                    </div>
                                            
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="flex items-center justify-end p-6 pt-0 space-x-3 border-t border-gray-200 rounded-b">
                                                    <div class="mt-3">
                                                        <button data-modal-hide="tolak-modal-{{ $pengajuanUnitKonsumsi->id }}" type="button" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg focus:outline-none transition duration-200">
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

                            <a href="{{ route('admin.detail-pengajuan-unit-konsumsi', $pengajuanUnitKonsumsi->id) }}">
                                <button class="px-3 py-1 bg-blue-700 text-white rounded hover:bg-blue-600">
                                    Detail
                                </button>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-3">Tidak ada data pengajuan unit konsumsi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $pengajuanUnitKonsumsis->links() }}
    </div> 
</div>
