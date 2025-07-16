<div>
    <!-- Form Tambah Unit Konsumsi -->
    <form action="{{ route('pengurus.pengajuan-unit-konsumsi.store') }}" method="POST">
        @csrf
        <input type="hidden" name="requested_by" value="{{ auth()->guard('pengurus')->user()->nama }}"/>
        <div class="mb-3">
            <label class="block mb-1 text-sm font-medium text-gray-900">Tanggal</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input id="datepicker-pengajuan-unit-konsumsi" name="tanggal" type="text" class="tanggal bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5" value="{{ old('tanggal', \Carbon\Carbon::now()->format('d-m-Y')) }}" placeholder="Pilih Tanggal" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
            <div wire:ignore>
                <select wire:model.lazy="anggota_id" id="select_nama_kas_masuk" name="anggota_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                    <option value="" disabled {{ old('anggota_id') ? '' : 'selected' }}>Pilih Nama Anggota</option>
                    @foreach($namaList as $id => $nama)
                        <option value="{{ $id }}" {{ old('anggota_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <p class="text-red-500 text-xs mt-1">{{ $error_proses_pengajuan_unit_konsumsi }}</p>
            @if($unitKonsumsiAktif)
                    <p class="text-red-500 text-xs mt-1">* Anggota ini memiliki angsuran yang belum selesai.</p>
            @endif
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Barang</label>
            <input type="text" name="nama_barang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nama Barang" value="{{ old('nama_barang') }}" required/>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Unit Konsumsi</label>
            <input type="text" wire:model.live="nominal" name="nominal" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Konsumsi" inputmode="numeric" value="{{ old('nominal') }}" required/>
            <p class="text-red-500 text-xs mt-1">{{ $error_nominal }}</p>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Lama Angsuran (Kali/Bulan)</label>
            <input type="text" wire:model.live="lama_angsuran" id="lama_angsuran" name="lama_angsuran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Lama Angsuran" value="{{ old('lama_angsuran') }}" required/>
            <p class="text-red-500 text-xs mt-1">{{ $error_lama_angsuran }}</p>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Pokok</label>
            <input type="text" wire:model="nominal_pokok" name="nominal_pokok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('nominal_pokok') }}" placeholder="Nominal Pokok" readonly/>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Jasa</label>
            <input type="text" wire:model="nominal_bunga" name="nominal_bunga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('nominal_bunga') }}" placeholder="Nominal Jasa" readonly/>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Angsuran</label>
            <input type="text" wire:model="jumlah_nominal" name="jumlah_nominal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('jumlah_nominal') }}" placeholder="Nominal Angsuran" readonly/>
        </div>
        <div class="flex justify-start">
            <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md" @if($disabled) disabled @elseif($unitKonsumsiAktif) disabled @endif>
                Simpan
            </button>
        </div>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#datepicker-pengajuan-unit-konsumsi", {
                dateFormat: "d-m-Y",
                allowInput: true,
                position: "below",
                locale: "id"
            });
        });
    </script>
@endpush

