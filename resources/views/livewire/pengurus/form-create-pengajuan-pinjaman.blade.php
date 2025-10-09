<div>
    <form action="{{ route('pengurus.pengajuan-pinjaman.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="requested_by" value="{{ auth()->guard('pengurus')->user()->nama }}" hidden>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">
                    Tanggal <span class="text-red-500">*</span>
                </label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input id="datepicker-pengajuan-pinjaman" name="tanggal" type="text" class="tanggal bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5" value="{{ old('tanggal', \Carbon\Carbon::now()->format('d-m-Y')) }}" placeholder="Pilih Tanggal" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">
                    Nama <span class="text-red-500">*</span>
                </label>
                <div wire:ignore>
                    <select wire:model.lazy="anggota_id" id="select_nama_kas_masuk" name="anggota_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                        <option value="" disabled {{ old('anggota_id') ? '' : 'selected' }}>Pilih Nama Anggota</option>
                        @foreach($namaList as $id => $nama)
                            <option value="{{ $id }}" {{ old('anggota_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                        @endforeach
                    </select>
                </div>
                <p class="text-red-500 text-xs mt-1">{{ $error_proses_pengajuan_pinjaman }}</p>
                @if($pinjamanAktif)
                    <p class="text-red-500 text-xs mt-1">* Anggota ini memiliki angsuran yang belum selesai.</p>
                @endif
            </div>
            @if ($pinjamanAktif)
                <div class="mb-3">
                    <label class="block mb-1 text-sm font-medium text-gray-900">Kurang Angsuran</label>
                    <input type="text" wire:model="kurangAngsuran" id="kurang_angsuran" name="kurang_angsuran" class="format-bulan bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Kurang Angsuran" inputmode="numeric" readonly/>
                </div>
            @endif
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">
                    Jumlah Pinjaman <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model.live="jumlah_pinjaman" id="jumlah_pinjaman" name="jumlah_pinjaman" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pinjaman" inputmode="numeric" value="{{ old('jumlah_pinjaman') }}" oninput="formatRupiah(this)" required/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900 sm:hidden">
                    Lama Angsuran <span class="text-red-500">*</span>
                </label>
                <label class="hidden sm:block mb-1 text-sm font-medium text-gray-900">
                    Lama Angsuran (Kali/Bulan) <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model.live="lama_angsuran" id="lama_angsuran" name="lama_angsuran" class="format-bulan bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Lama Angsuran" inputmode="numeric" value="{{ old('lama_angsuran') }}" required/>
                <p class="text-red-500 text-xs mt-1">{{ $error_lama_angsuran }}</p>
            </div>
            @if ($pinjamanAktif)
                <div class="mb-3">
                    <label class="block mb-1 text-sm font-medium text-gray-900">Kompen</label>
                    <input type="text" wire:model="kompen" id="kompen" name="kompen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Kompen" inputmode="numeric" value="{{ old('kompen') }}" readonly/>
                </div>
            @endif
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Pokok</label>
                <input type="text" wire:model="nominal_pokok" id="nominal_pokok" name="nominal_pokok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Nominal Pokok" inputmode="numeric" value="{{ old('nominal_pokok') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Biaya Admin</label>
                <input type="text" wire:model="biaya_admin" id="biaya_admin" name="biaya_admin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Biaya Admin" inputmode="numeric" value="{{ old('biaya_admin') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Jasa</label>
                <input type="text" wire:model="nominal_bunga" id="nominal_bunga" name="nominal_bunga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Nominal Jasa" inputmode="numeric" value="{{ old('nominal_bunga') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Uang Yang Diterima</label>
                <input type="text" wire:model="total_pinjaman" id="total_pinjaman" name="total_pinjaman" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Uang Yang Diterima" inputmode="numeric" value="{{ old('total_pinjaman') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Angsuran</label>
                <input type="text" wire:model="nominal_angsuran" id="nominal_angsuran" name="nominal_angsuran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Nominal Angsuran" inputmode="numeric" value="{{ old('nominal_angsuran') }}" readonly/>
            </div>
        </div>
        <div class="flex justify-start mt-2">
            <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md"  @if($disabled) disabled @endif>
                Simpan
            </button>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#datepicker-pengajuan-pinjaman", {
                dateFormat: "d-m-Y",
                allowInput: true,
                position: "below",
                locale: "id"
            });
        });
    </script>
@endpush
