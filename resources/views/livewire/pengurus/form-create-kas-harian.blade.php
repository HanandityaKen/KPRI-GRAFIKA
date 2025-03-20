<div>
    <form action="{{ route('pengurus.kas-harian.store') }}" id="formCreateJkm" method="POST">
        @csrf
        <input type="text" name="jenis_transaksi" class="hidden"  value="kas masuk"/>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Tanggal</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input id="datepicker-kas-masuk" name="tanggal" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5" value="{{ old('tanggal', \Carbon\Carbon::now()->format('d-m-Y')) }}" placeholder="Pilih Tanggal" required >
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
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Pokok</label>
            <input wire:model="pokok" type="text" id="pokok" name="pokok" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pokok" inputmode="numeric" readonly/>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Wajib</label>
            <select name="wajib" id="wajib" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
                <option value="">Pilih Nominal Wajib</option>
                <option value="250000" {{ old('wajib') == '250000' ? 'selected' : '' }}>Rp 250.000</option>
                <option value="150000" {{ old('wajib') == '150000' ? 'selected' : '' }}>Rp 150.000</option>
                <option value="100000" {{ old('wajib') == '100000' ? 'selected' : '' }}>Rp 100.000</option>
            </select>
            {{-- <input type="text" id="wajib" name="wajib" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Wajib" inputmode="numeric" value="{{ old('wajib') }}"/> --}}
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Manasuka</label>
            <input type="text" id="manasuka" name="manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Manasuka" inputmode="numeric" value="{{ old('manasuka') }}" />
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Wajib Pinjam</label>
            <select name="wajib_pinjam" id="wajib_pinjam" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
                <option value="">Pilih Nominal Wajib Pinjam</option>
                <option value="15000" {{ old('wajib_pinjam') == '15000' ? 'selected' : '' }}>Rp 15.000</option>
                <option value="10000" {{ old('wajib_pinjam') == '10000' ? 'selected' : '' }}>Rp 10.000</option>
                <option value="5000" {{ old('wajib_pinjam') == '5000' ? 'selected' : '' }}>Rp 5.000</option>
            </select>
            {{-- <input type="text" id="wajib pinjam" name="wajib_pinjam" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Wajib Pinjam" inputmode="numeric" value="{{ old('wajib pinjam') }}" /> --}}
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Qurban</label>
            <input type="text" id="qurban" name="qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Qurban" inputmode="numeric" value="{{ old('qurban') }}" />
        </div>
        @if ($hasAngsuran)    
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-900">Angsuran</label>
                <select wire:model="angsuran" name="angsuran" id="angsuran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
                    @foreach ($angsuranList as $value => $angsuran)
                        <option value="{{ $angsuran }}">{{ $angsuran }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-900">Jasa</label>
                <select wire:model="jasa" name="jasa" id="jasa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
                    @foreach ($jasaList as $value => $jasa)
                        <option value="{{ $jasa }}">{{ $jasa }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        {{-- <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Jasa Admin</label>
            <input type="text" id="jasa admin" name="js_admin" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Admin" inputmode="numeric" value="{{ old('jasa admin') }}" />
        </div> --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Lain-Lain</label>
            <input type="text" id="lain-lain" name="lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Lain-Lain" inputmode="numeric" value="{{ old('lain-lain') }}" />
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Barang Konsumsi</label>
            <input type="text" id="barang kons" name="barang_kons" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Barang Konsumsi" inputmode="numeric" value="{{ old('barang_kons') }}" />
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Keterangan</label>
            <input type="text" name="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Keterangan" value="{{ old('keterangan') }}"/>
        </div>
        <div class="flex justify-start">
            <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md">
                Simpan
            </button>
        </div>
    </form>
</div>
