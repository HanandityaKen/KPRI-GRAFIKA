<div>
    <form action="{{ route('pengurus.kas-harian.update', $kasHarian->id) }}" id="formCreateJkk" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="block mb-1 text-sm font-medium text-gray-900">Jenis Transaksi</label>
            <select name="jenis_transaksi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" disabled>
                <option selected disabled>Pilih Jenis Transaksi</option>
                <option value="kas masuk" {{ old('jenis_transaksi', $kasHarian->jenis_transaksi) == 'kas masuk' ? 'selected' : '' }}>Kas Masuk</option>
                <option value="kas keluar" {{ old('jenis_transaksi', $kasHarian->jenis_transaksi) == 'kas keluar' ? 'selected' : '' }}>Kas Keluar</option>
                <input type="hidden" name="jenis_transaksi" value="{{ old('jenis_transaksi', $kasHarian->jenis_transaksi) }}">
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Tanggal</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input id="datepicker-kas-keluar" name="tanggal" type="text" class="tanggal bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5" value="{{ old('tanggal', \Carbon\Carbon::parse($kasHarian->tanggal)->format('d-m-Y')) }}"  placeholder="Pilih Tanggal" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
            <div wire:ignore>
                <select disabled wire:model.lazy="anggota_id" id="select_nama_kas_keluar" name="anggota_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                    <option value="" disabled>Pilih Nama Anggota</option>

                    {{-- Tampilkan opsi nama_anggota dari kasHarian jika tidak ada di namaList --}}
                    @if(!array_key_exists($kasHarian->anggota_id, $namaList))
                        <option value="{{ $kasHarian->anggota_id }}" selected>{{ $kasHarian->nama_anggota }}</option>
                    @endif

                    @foreach($namaList as $id => $nama)
                        <option value="{{ $id }}" {{ old('nama', $kasHarian->anggota_id) == $id ? 'selected' : '' }}>{{ $nama }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="anggota_id" value="{{ $kasHarian->anggota_id }}">
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Wajib Pinjam</label>
            <select wire:model.live="selectedWajibPinjam" name="wajib_pinjam" id="wajib_pinjam" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
                @foreach($wajibPinjamOption as $wajib_pinjam)
                    <option value="{{ $wajib_pinjam }}" {{ old('wajib_pinjam', $kasHarian->wajib_pinjam) == $wajib_pinjam ? 'selected' : '' }}>
                        Rp {{ number_format($wajib_pinjam, 0, ',', '.') }}
                    </option>
                @endforeach
                <option value="manual">Masukan Manual</option>
            </select>
            @if ($selectedWajibPinjam === 'manual')
                <div class="mt-4">
                    <input wire:model.live="wajib_pinjam_manual" type="text" id="wajib_pinjam_manual" name="wajib_pinjam_manual" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2 mt-2" placeholder="Masukan Nominal Wajib Pinjam" inputmode="numeric" value="{{ old('wajib_pinjam_manual') }}" />
                </div>
                <p class="text-red-500 text-xs mt-1">{{ $error_wajib_pinjam_manual }}</p>
            @endif
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Manasuka</label>
            <input wire:model.live="manasuka" type="text" id="manasuka" name="manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Manasuka" inputmode="numeric" value="{{ old('manasuka') }}" />
            <p class="text-red-500 text-xs mt-1">{{ $error_manasuka }}</p>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Qurban</label>
            <input wire:model.live="qurban" type="text" id="qurban" name="qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Qurban" inputmode="numeric" value="{{ old('qurban') }}" />
            <p class="text-red-500 text-xs mt-1">{{ $error_qurban }}</p>
        </div>
        <div class="{{ $bendahara ? '' : 'hidden' }}">
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-900">Lain-Lain</label>
                <input wire:model.live="lain_lain" type="text" id="lain_lain" name="lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Lain-Lain" inputmode="numeric" value="{{ old('lain_lain', $kasHarian->lain_lain) }}" />
            </div>
            {{-- Accordion --}}
            <div class="mb-4">
                <div id="accordion-collapse" data-accordion="open">
                    <!-- Accordion Item 1 -->
                    <div class="rounded-lg">
                        <h2 id="accordion-collapse-heading-2">
                        <button type="button" 
                            class="flex items-center justify-between w-full p-2 font-medium text-left text-gray-900 rounded-t-lg border transition-all duration-200 {{ ($hari_lembur > 0 || $perjalanan_pengawas > 0 || $thr > 0 || $admin > 0 || $iuran_dekopinda > 0 || $honor_pengurus > 0) ? 'bg-gray-100 border-gray-300' : 'border-gray-200 hover:bg-gray-100' }}"
                            data-accordion-target="#accordion-collapse-body-2" 
                            aria-expanded="{{ ($hari_lembur > 0 || $perjalanan_pengawas > 0 || $thr > 0 || $admin > 0 || $iuran_dekopinda > 0 || $honor_pengurus > 0) ? 'true' : 'false' }}"
                            aria-controls="accordion-collapse-body-2">
                            <span class="flex items-center text-sm text-gray-900">
                                Beban Umum
                            </span>
                            <div class="pr-0.5">
                                <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform duration-200 {{ !($hari_lembur > 0 || $perjalanan_pengawas > 0 || $thr > 0 || $admin > 0 || $iuran_dekopinda > 0 || $honor_pengurus > 0) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>      
                            </div>
                        </button>
                        </h2>
                        <div id="accordion-collapse-body-2" class="{{ ($hari_lembur > 0 || $perjalanan_pengawas > 0 || $thr > 0 || $admin > 0 || $iuran_dekopinda > 0 || $honor_pengurus > 0) ? '' : 'hidden' }}" aria-labelledby="accordion-collapse-heading-2">
                            <div class="p-5 border border-t-0 border-gray-200 bg-white">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="hari_lembur" class="block mb-2 text-sm font-medium text-gray-900">Hari Lembur</label>
                                        <input wire:model.live="hari_lembur" type="text" id="hari_lembur" name="hari_lembur" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Hari Lembur" inputmode="numeric" value="{{ old('hari_lembur') }}" />
                                    </div>
                                    <div>
                                        <label for="perjalanan_pengawas" class="block mb-2 text-sm font-medium text-gray-900">Perjalanan Pengawas</label>
                                        <input wire:model.live="perjalanan_pengawas" type="text" id="perjalanan_pengawas" name="perjalanan_pengawas" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Perjalanan Pengawas" inputmode="numeric" value="{{ old('perjalanan_pengawas') }}" />
                                    </div>
                                    <div>
                                        <label for="thr" class="block mb-2 text-sm font-medium text-gray-900">THR</label>
                                        <input wire:model.live="thr" type="text" id="thr" name="thr" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal THR" inputmode="numeric" value="{{ old('thr') }}" />
                                    </div>
                                    <div>
                                        <label for="admin" class="block mb-2 text-sm font-medium text-gray-900">Admin</label>
                                        <input wire:model.live="admin" type="text" id="admin" name="admin" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Admin" inputmode="numeric" value="{{ old('admin') }}" />
                                    </div>
                                    <div>
                                        <label for="iuran_dekopinda" class="block mb-2 text-sm font-medium text-gray-900">Iuran Dekopinda</label>
                                        <input wire:model.live="iuran_dekopinda" type="text" id="iuran_dekopinda" name="iuran_dekopinda" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Iuran Dekopinda" inputmode="numeric" value="{{ old('iuran_dekopinda') }}" />
                                    </div>
                                    <div>
                                        <label for="honor_pengurus" class="block mb-2 text-sm font-medium text-gray-900">Honor Pengurus</label>
                                        <input wire:model.live="honor_pengurus" type="text" id="honor_pengurus" name="honor_pengurus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Honor Pengurus" inputmode="numeric" value="{{ old('honor_pengurus') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg">
                        <h2 id="accordion-collapse-heading-3">
                        <button type="button" 
                            class="flex items-center justify-between w-full p-2 font-medium text-left text-gray-900 border border-gray-200 hover:bg-gray-100 transition-all duration-200 {{ ($rkrab > 0 || $pembinaan > 0 || $harkop > 0 || $dandik > 0) ? 'bg-gray-100 border-gray-300' : 'border-gray-200 hover:bg-gray-100' }}" 
                            data-accordion-target="#accordion-collapse-body-3" 
                            aria-expanded="{{ ($rkrab > 0 || $pembinaan > 0 || $harkop > 0 || $dandik > 0) ? 'true' : 'false' }}" 
                            aria-controls="accordion-collapse-body-3">
                            <span class="flex items-center text-sm text-gray-900">
                                Beban Organisasi
                            </span>
                            <div class="pr-0.5">
                                <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform duration-200 {{ !($rkrab > 0 || $pembinaan > 0 || $harkop > 0 || $dandik > 0) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg> 
                            </div>
                        </button>
                        </h2>
                        <div id="accordion-collapse-body-3" class="{{ ($rkrab > 0 || $pembinaan > 0 || $harkop > 0 || $dandik > 0) ? '' : 'hidden' }}" aria-labelledby="accordion-collapse-heading-3">
                            <div class="p-5 border border-t-0 border-gray-200 bg-white">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="rkrab" class="block mb-2 text-sm font-medium text-gray-900">RkRab</label>
                                        <input wire:model.live="rkrab" type="text" id="rkrab" name="rkrab" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal RkRab" inputmode="numeric" value="{{ old('rkrab') }}" />
                                    </div>
                                    <div>
                                        <label for="pembinaan" class="block mb-2 text-sm font-medium text-gray-900">Pembinaan</label>
                                        <input wire:model.live="pembinaan" type="text" id="pembinaan" name="pembinaan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pembinaan" inputmode="numeric" value="{{ old('pembinaan') }}" />
                                    </div>
                                    <div>
                                        <label for="harkop" class="block mb-2 text-sm font-medium text-gray-900">Harkop</label>
                                        <input wire:model.live="harkop" type="text" id="harkop" name="harkop" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Harkop" inputmode="numeric" value="{{ old('harkop') }}" />
                                    </div>
                                    <div>
                                        <label for="dandik" class="block mb-2 text-sm font-medium text-gray-900">Dandik</label>
                                        <input wire:model.live="dandik" type="text" id="dandik" name="dandik" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dandik" inputmode="numeric" value="{{ old('dandik') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg">
                        <h2 id="accordion-collapse-heading-4">
                        <button type="button" 
                            class="flex items-center justify-between w-full p-2 font-medium text-left text-gray-900 border border-gray-200 hover:bg-gray-100 transition-all duration-200 {{ ($rapat > 0 || $jasa_manasuka > 0) ? 'bg-gray-100 border-gray-300' : 'border-gray-200 hover:bg-gray-100' }}" 
                            data-accordion-target="#accordion-collapse-body-4" 
                            aria-expanded="{{ ($rapat > 0 || $jasa_manasuka > 0) ? 'true' : 'false' }}" 
                            aria-controls="accordion-collapse-body-4">
                            <span class="flex items-center text-sm text-gray-900">
                                Beban Operasional
                            </span>
                            <div class="pr-0.5">
                                <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform duration-200 {{ !($rapat > 0 || $jasa_manasuka > 0) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                        </h2>
                        <div id="accordion-collapse-body-4" class="{{ ($rapat > 0 || $jasa_manasuka > 0) ? '' : 'hidden' }}" aria-labelledby="accordion-collapse-heading-4">
                            <div class="p-5 border border-t-0 border-gray-200 bg-white">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="rapat" class="block mb-2 text-sm font-medium text-gray-900">Rapat</label>
                                        <input wire:model.live="rapat" type="text" id="rapat" name="rapat" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Rapat" inputmode="numeric" value="{{ old('rapat') }}" />
                                    </div>
                                    <div>
                                        <label for="jasa_manasuka" class="block mb-2 text-sm font-medium text-gray-900">Jasa Manasuka</label>
                                        <input wire:model.live="jasa_manasuka" type="text" id="jasa_manasuka" name="jasa_manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Manasuka" inputmode="numeric" value="{{ old('jasa_manasuka') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg">
                        <h2 id="accordion-collapse-heading-1">
                        <button type="button" 
                            class="flex items-center justify-between w-full p-2 font-medium text-left text-gray-900 border border-gray-200 hover:bg-gray-100 transition-all duration-200 {{ ($pajak > 0 || $tabungan_qurban > 0 || $dekopinda > 0 || $wajib_pkpri > 0 || $dansos > 0 || $shu > 0 || $dana_pengurus > 0 || $dana_kesejahteraan > 0 || $pembayaran_listrik_dan_air > 0) ? 'bg-gray-100 border-gray-300' : 'border-gray-200 hover:bg-gray-100' }}" 
                            data-accordion-target="#accordion-collapse-body-1" 
                            aria-expanded="{{ ($pajak > 0 || $tabungan_qurban > 0 || $dekopinda > 0 || $wajib_pkpri > 0 || $dansos > 0 || $shu > 0 || $dana_pengurus > 0 || $dana_kesejahteraan > 0 || $pembayaran_listrik_dan_air > 0) ? 'true' : 'false' }}" 
                            aria-controls="accordion-collapse-body-1">
                            <span class="flex items-center text-sm text-gray-900">
                                Beban Lain
                            </span>
                            <div class="pr-0.5">
                                <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform duration-200 {{ !($pajak > 0 || $tabungan_qurban > 0 || $dekopinda > 0 || $wajib_pkpri > 0 || $dansos > 0 || $shu > 0 || $dana_pengurus > 0 || $dana_kesejahteraan > 0 || $pembayaran_listrik_dan_air > 0) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                        </h2>
                        <div id="accordion-collapse-body-1" class="{{ ($pajak > 0 || $tabungan_qurban > 0 || $dekopinda > 0 || $wajib_pkpri > 0 || $dansos > 0 || $shu > 0 || $dana_pengurus > 0 || $dana_kesejahteraan > 0 || $pembayaran_listrik_dan_air > 0) ? '' : 'hidden' }}" aria-labelledby="accordion-collapse-heading-1">
                            <div class="p-5 border border-t-0 border-gray-200 bg-white">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="pajak" class="block mb-2 text-sm font-medium text-gray-900">Pajak</label>
                                        <input wire:model.live="pajak" type="text" id="pajak" name="pajak" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pajak" inputmode="numeric" value="{{ old('pajak') }}" />
                                    </div>
                                    <div>
                                        <label for="tabungan_qurban" class="block mb-2 text-sm font-medium text-gray-900">Tabungan Qurban</label>
                                        <input wire:model.live="tabungan_qurban" type="text" id="tabungan_qurban" name="tabungan_qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan Qurban" inputmode="numeric" value="{{ old('tabungan_qurban') }}" />
                                    </div>
                                    <div>
                                        <label for="dekopinda" class="block mb-2 text-sm font-medium text-gray-900">Dekopinda</label>
                                        <input wire:model.live="dekopinda" type="text" id="dekopinda" name="dekopinda" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dekopinda" inputmode="numeric" value="{{ old('dekopinda') }}" />
                                    </div>
                                    <div>
                                        <label for="wajib_pkpri" class="block mb-2 text-sm font-medium text-gray-900">Wajib PKPRI</label>
                                        <input wire:model.live="wajib_pkpri" type="text" id="wajib_pkpri" name="wajib_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Wajib PKPRI" inputmode="numeric" value="{{ old('wajib_pkpri') }}" />
                                    </div>
                                    <div>
                                        <label for="dansos" class="block mb-2 text-sm font-medium text-gray-900">Dansos</label>
                                        <input wire:model.live="dansos" type="text" id="dansos" name="dansos" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dansos" inputmode="numeric" value="{{ old('dansos') }}" />
                                    </div>
                                    <div>
                                        <label for="shu" class="block mb-2 text-sm font-medium text-gray-900">SHU</label>
                                        <input wire:model.live="shu" type="text" id="shu" name="shu" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal SHU" inputmode="numeric" value="{{ old('shu') }}" />
                                    </div>
                                    <div>
                                        <label for="dana_pengurus" class="block mb-2 text-sm font-medium text-gray-900">Dana Pengurus</label>
                                        <input wire:model.live="dana_pengurus" type="text" id="dana_pengurus" name="dana_pengurus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pengurus" inputmode="numeric" value="{{ old('dana_pengurus') }}" />
                                    </div>
                                    <div>
                                        <label for="dana_kesejahteraan" class="block mb-2 text-sm font-medium text-gray-900">Dana Kesejahteraan</label>
                                        <input wire:model.live="dana_kesejahteraan" type="text" id="dana_kesejahteraan" name="dana_kesejahteraan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Kesejahteraan" inputmode="numeric" value="{{ old('dana_kesejahteraan') }}" />
                                    </div>
                                    <div>
                                        <label for="pembayaran_listrik_dan_air" class="block mb-2 text-sm font-medium text-gray-900">Pembayaran Listrik dan Air</label>
                                        <input wire:model.live="pembayaran_listrik_dan_air" type="text" id="pembayaran_listrik_dan_air" name="pembayaran_listrik_dan_air" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pembayaran Listrik dan Air" inputmode="numeric" value="{{ old('pembayaran_listrik_dan_air') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>             
            </div>
            {{-- End Accordion --}}

            <div class="mb-4 mt-4">
                <label class="block mb-1 text-sm font-medium text-gray-900">Tanah Kavling</label>
                <input wire:model.live="tnh_kav" type="text" id="tnh_kav" name="tnh_kav" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tanah Kavling" inputmode="numeric" value="{{ old('tnh_kav') }}" />
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Keterangan</label>
            <input type="text" name="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Keterangan" value="{{ old('keterangan', $kasHarian->keterangan) }}" required/>
        </div>
        <div class="flex justify-start">
            <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md" @if($disabled) disabled @endif>
                Simpan
            </button>
        </div>
    </form>
</div>
