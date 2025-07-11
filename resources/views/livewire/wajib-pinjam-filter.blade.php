<div wire:poll.keep-alive.5s>
    <div class="mb-8 flex justify-between items-center">
        <div class="relative w-2/3 sm:w-1/3">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" wire:model.live="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500" placeholder="Search">
        </div>
        <a href="{{ route('admin.wajib-pinjam.create') }}" wire:ignore class="bg-green-800 text-white py-2 px-4 rounded-md flex items-center ml-4 whitespace-nowrap">
            <i data-lucide="plus" class="mr-2"></i>
            <span class="sm:hidden">Tambah</span>
            <span class="hidden sm:inline">Tambah Nominal</span>
        </a>
    </div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-left text-[#6DA854]">No</th>
                    <th class="p-3 text-center whitespace-nowrap">Nominal</th>
                    <th class="p-3 text-center whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($wajib_pinjams as $index => $wajib_pinjam)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="pl-5 text-[#6DA854]">{{ $wajib_pinjams->firstItem() + $index }}</td>
                        <td class="p-3 text-center whitespace-nowrap">Rp {{ number_format($wajib_pinjam->nominal, 0, ',', '.') }}</td>
                        <td class=" text-center whitespace-nowrap">
                            <a href="{{ route('admin.wajib-pinjam.edit', $wajib_pinjam->id) }}">
                                <button class="px-3 py-1 bg-green-800 text-white rounded hover:bg-green-900 ml-2">
                                    Edit
                                </button>
                            </a>
                            <button 
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2"
                                onclick="confirmDelete({{ $wajib_pinjam->id }})">
                                    Hapus
                            </button>
                            <form id="delete-form-{{ $wajib_pinjam->id }}" action="{{ route('admin.wajib-pinjam.destroy', $wajib_pinjam->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr> 
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-3">Tidak ada data wajib pinjam.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $wajib_pinjams->links() }}
    </div>  
</div>
