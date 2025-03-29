<div>
    <form action="{{ route('pengurus.kas-harian.update', $kasHarian->id) }}" id="formCreateJkm" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="block mb-1 text-sm font-medium text-gray-900">Jenis Transaksi</label>
            <select name="jenis_transaksi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" disabled>
                <option selected disabled>Pilih Jenis Transaksi</option>
                <option value="kas masuk" {{ old('jenis_transaksi', $kasHarian->jenis_transaksi) == 'kas masuk' ? 'selected' : '' }}>Kas Masuk</option>
                <option value="kas keluar" {{ old('jenis_transaksi', $kasHarian->jenis_transaksi) == 'kas keluar' ? 'selected' : '' }}>Kas Keluar</option>
            </select>
            <input type="hidden" name="jenis_transaksi" value="{{ old('jenis_transaksi', $kasHarian->jenis_transaksi) }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Tanggal</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input id="datepicker-kas-masuk" name="tanggal" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5" value="{{ old('tanggal', \Carbon\Carbon::parse($kasHarian->tanggal)->format('d-m-Y')) }}" placeholder="Pilih Tanggal" required >
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
            <div wire:ignore>
                <select wire:model.lazy="anggota_id" id="select_nama_kas_masuk" name="anggota_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                    <option value="" disabled {{ old('anggota_id', $kasHarian->anggota_id) ? '' : 'selected' }}>Pilih Nama Anggota</option>
                    @foreach($namaList as $id => $nama)
                        <option value="{{ $id }}" {{ old('anggota_id', $kasHarian->anggota_id) == $id ? 'selected' : '' }}>{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Pokok</label>
            <input type="text" id="pokok" name="pokok" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pokok" inputmode="numeric" value="{{ old('pokok', $kasHarian->pokok) }}" readonly/>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Wajib</label>
            <select name="wajib" id="wajib" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
                <option value="0">Pilih Nominal Wajib</option>
                @foreach($wajibOptions as $wajib)
                    <option value="{{ $wajib }}" {{ old('wajib', $kasHarian->wajib) == $wajib ? 'selected' : '' }}>
                        Rp {{ number_format($wajib, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Manasuka</label>
            <input type="text" id="manasuka" name="manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Manasuka" inputmode="numeric" value="{{ old('manasuka', $kasHarian->manasuka) }}" />
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Wajib Pinjam</label>
            <select name="wajib_pinjam" id="wajib_pinjam" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
                <option value="">Pilih Nominal Wajib Pinjam</option>
                @foreach ($wajibPinjamList as $id => $nominal)
                    <option value="{{ $nominal }}" {{ old('wajib_pinjam', $kasHarian->wajib_pinjam) == $nominal ? 'selected' : '' }}>
                        Rp {{ number_format($nominal, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Qurban</label>
            <input type="text" id="qurban" name="qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Qurban" inputmode="numeric" value="{{ old('qurban', $kasHarian->qurban) }}" />
        </div>
        {{-- <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Angsuran</label>
            <input type="text" id="angsuran" name="angsuran" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Angsuran" inputmode="numeric" value="{{ old('angsuran', $kasHarian->angsuran) }}" />
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Jasa</label>
            <input type="text" id="jasa" name="jasa" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa" inputmode="numeric" value="{{ old('jasa', $kasHarian->jasa) }}" />
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Jasa Admin</label>
            <input type="text" id="jasa admin" name="js_admin" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Admin" inputmode="numeric" value="{{ old('js_admin', $kasHarian->js_admin) }}" />
        </div> --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Lain-Lain</label>
            <input type="text" id="lain_lain" name="lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Lain-Lain" inputmode="numeric" value="{{ old('lain_lain', $kasHarian->lain_lain) }}" />
        </div>
        {{-- <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Barang Konsumsi</label>
            <input type="text" id="barang kons" name="barang_kons" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Barang Konsumsi" inputmode="numeric" value="{{ old('barang_kons', $kasHarian->barang_kons) }}" />
        </div> --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Keterangan</label>
            <input type="text" name="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Keterangan" value="{{ old('keterangan', $kasHarian->keterangan) }}"/>
        </div>
        <div class="flex justify-start">
            <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md">
                Simpan
            </button>
        </div>
    </form>
</div>
