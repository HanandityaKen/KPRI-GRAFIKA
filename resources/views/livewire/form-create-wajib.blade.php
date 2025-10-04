<div>
    <form action="{{ route('admin.wajib.store') }}" method="POST">
        @csrf
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium text-gray-900">
                Jenis Pegawai <span class="text-red-500">*</span>
            </label>
            <input wire:model.live="jenis_pegawai" type="text" name="jenis_pegawai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('jenis_pegawai') }}" placeholder="Masukan Nama Jenis Pegawai" required/>
            <p class="text-red-500 text-xs mt-1">{{ $error_jenis_pegawai }}</p>
        </div>
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium text-gray-900">
                Nominal <span class="text-red-500">*</span>
            </label>
            <input type="text" id="nominal" name="nominal" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('nominal') }}" inputmode="numeric" placeholder="Masukan Nominal" required/>
        </div>
        <div class="flex justify-start">
            <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md" @if($disabled) disabled @endif>
                Simpan
            </button>
        </div>
    </form>
</div>
