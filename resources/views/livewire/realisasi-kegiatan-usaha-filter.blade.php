<div>
    <div class="mb-8 flex justify-between items-center">
        <div class="relative w-2/3 sm:w-1/3">
            {{-- <div class="flex items-center">
                <select id="yearFilter" wire:model.change="selectedYear" class="p-2 bg-white border-2 border-[#6DA854] w-full rounded-md">
                    <option value="">Pilih Tahun</option>
                    @foreach ($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div> --}}
        </div>
        <a href="{{ route('admin.shu.create-realisasi-kegiatan-usaha') }}" wire:ignore class="bg-green-800 text-white py-2 px-4 rounded-md flex items-center ml-4 whitespace-nowrap">
            <i data-lucide="plus" class="mr-2"></i>
            <span class="sm:hidden">Tambah</span>
            <span class="hidden sm:inline">Tambah</span>
        </a>
    </div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-left text-[#6DA854]">No</th>
                    <th class="p-3 text-center">Tahun</th>
                    <th class="p-3 text-center">SHU</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($shus as $index => $shu)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="pl-5 text-[#6DA854]">{{ $shus->firstItem() + $index }}</td>
                        <td class="p-3 text-center whitespace-nowrap">{{$shu->tahun}}</td>
                        <td class="p-3 text-center whitespace-nowrap">Rp {{ number_format($shu->jumlah_shu, 0, ',', '.') }}</td>
                        <td class="p-3 text-center whitespace-nowrap">
                            <button 
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                onclick="confirmDelete({{ $shu->id }})">
                                    Hapus
                            </button>
                            <form id="delete-form-{{ $shu->id }}" action="{{ route('admin.shu.destroy-realisasi-kegiatan-usaha', $shu->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-3">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $shus->links() }}
    </div>   
</div>
@push('scripts')
    <script>
        function confirmDelete(shuId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data SHU akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#166534',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${shuId}`).submit();
                }
            })
        }
    </script>
@endpush