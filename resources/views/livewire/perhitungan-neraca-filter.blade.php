<div>
    <div class="mb-8 flex justify-between items-center">
        <div class="relative w-2/3 sm:w-1/3">
        </div>
        <a href="{{ route('admin.neraca.create-perhitungan-neraca') }}" wire:ignore class="bg-green-800 text-white py-2 px-4 rounded-md flex items-center ml-4 whitespace-nowrap">
            <i data-lucide="plus" class="mr-2"></i>
            <span class="sm:hidden">Tambah</span>
            <span class="hidden sm:inline">Tambah</span>
        </a>
    </div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-left text-[#6DA854] border-r border-b border-[#6DA854]">No</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Tahun</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Jumlah N. Perubahan D</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Jumlah N. Perubahan K</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Jumlah A. Penyesuaian D</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]">Jumlah A. Penyesuaian K</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-b border-[#6DA854]">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($perhitunganNeracas as $index => $perhitunganNeraca)    
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="pl-5 text-[#6DA854] border-r border-[#6DA854]">{{ $perhitunganNeracas->firstItem() + $index }}</td>
                        <td class="p-3 text-center border-l border-r border-[#6DA854] whitespace-nowrap">{{ $perhitunganNeraca->tahun }}</td>
                        <td class="p-3 text-right border-l border-r border-[#6DA854] whitespace-nowrap">Rp {{ number_format($perhitunganNeraca->jumlah_n_perubahan_d, 0, ',', '.') }}</td>
                        <td class="p-3 text-right border-l border-r border-[#6DA854] whitespace-nowrap">Rp {{ number_format($perhitunganNeraca->jumlah_n_perubahan_k, 0, ',', '.') }}</td>
                        <td class="p-3 text-right border-l border-r border-[#6DA854] whitespace-nowrap">Rp {{ number_format($perhitunganNeraca->jumlah_a_penyesuaian_d, 0, ',', '.') }}</td>
                        <td class="p-3 text-right border-l border-r border-[#6DA854] whitespace-nowrap">Rp {{ number_format($perhitunganNeraca->jumlah_a_penyesuaian_k, 0, ',', '.') }}</td>
                        <td class="p-3 text-center border-l border-[#6DA854] whitespace-nowrap">
                            <a href="">
                                <button class="px-3 py-1 bg-green-800 text-white rounded hover:bg-green-900 ml-2">
                                    Edit
                                </button>
                            </a>
                            <button 
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                onclick="confirmDelete({{ $perhitunganNeraca->id }})">
                                    Hapus
                            </button>
                            <form id="delete-form-{{ $perhitunganNeraca->id }}" action="{{ route('admin.neraca.destroy-perhitungan-neraca', $perhitunganNeraca->id) }}" method="POST" style="display: none;">
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
        {{ $perhitunganNeracas->links() }}
    </div>   
</div>
@push('scripts')
    <script>
        function confirmDelete(perhitunganNeracaId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Perhitungan neraca akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#166534',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${perhitunganNeracaId}`).submit();
                }
            })
        }
    </script>
@endpush