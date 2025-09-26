<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.neraca.update-perhitungan-neraca', $perhitunganNeraca->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">
                Tahun <span class="text-red-500">*</span>
            </label>
            <input type="number" wire:model.live="tahun" id="tahun" name="tahun" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Tahun" inputmode="numeric" min="2024" value="{{ old('tahun') }}" readonly/>
        </div>
        {{-- accordion test --}}
        <div id="accordion-collapse" data-accordion="open">
            {{-- Neraca Awal D --}}
            <div class="rounded-lg">
                <h2 id="accordion-collapse-heading-neraca-awal-d">
                    <button wire:ignore.self type="button" 
                        class="flex items-center justify-between w-full p-2 font-medium text-left text-gray-900 rounded-t-lg border border-gray-200 transition-all duration-200" 
                        data-accordion-target="#accordion-collapse-body-neraca-awal-d" 
                        aria-expanded="true" 
                        aria-controls="accordion-collapse-body-neraca-awal-d">
                        <span class="flex items-center text-sm text-gray-900">
                            Neraca Awal {{ $tahunNeracaAwal }} (D)
                        </span>
                        <div wire:ignore class="pr-0.5">
                            <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                </h2>
                <div wire:ignore.self id="accordion-collapse-body-neraca-awal-d" class="hidden" aria-labelledby="accordion-collapse-heading-neraca-awal-d">
                    <div class="p-5 border border-t-0 border-gray-200 bg-white">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kas <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_kas" id="neraca_awal_d_kas" name="neraca_awal_d_kas" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kas" inputmode="numeric" value="{{ old('neraca_awal_d_kas') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Bank <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_bank" id="neraca_awal_d_bank" name="neraca_awal_d_bank" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Bank" inputmode="numeric" value="{{ old('neraca_awal_d_bank') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_piutang" id="neraca_awal_d_piutang" name="neraca_awal_d_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang" inputmode="numeric" value="{{ old('neraca_awal_d_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_piutang_tanah" id="neraca_awal_d_piutang_tanah" name="neraca_awal_d_piutang_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Tanah" inputmode="numeric" value="{{ old('neraca_awal_d_piutang_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Lain Pada Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_piutang_lain_pada_anggota" id="neraca_awal_d_piutang_lain_pada_anggota" name="neraca_awal_d_piutang_lain_pada_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Lain Pada Anggota" inputmode="numeric" value="{{ old('neraca_awal_d_piutang_lain_pada_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyisihan Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_penyisihan_piutang" id="neraca_awal_d_penyisihan_piutang" name="neraca_awal_d_penyisihan_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penyisihan Piutang" inputmode="numeric" value="{{ old('neraca_awal_d_penyisihan_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_piutang_barang" id="neraca_awal_d_piutang_barang" name="neraca_awal_d_piutang_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Barang" inputmode="numeric" value="{{ old('neraca_awal_d_piutang_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_persediaan_barang" id="neraca_awal_d_persediaan_barang" name="neraca_awal_d_persediaan_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Barang" inputmode="numeric" value="{{ old('neraca_awal_d_persediaan_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_persediaan_peralatan" id="neraca_awal_d_persediaan_peralatan" name="neraca_awal_d_persediaan_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Peralatan" inputmode="numeric" value="{{ old('neraca_awal_d_persediaan_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Akumulasi Peny. Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_akumulasi_peny_peralatan" id="neraca_awal_d_akumulasi_peny_peralatan" name="neraca_awal_d_akumulasi_peny_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Akumulasi Peny. Peralatan" inputmode="numeric" value="{{ old('neraca_awal_d_akumulasi_peny_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Ymh. Diterima <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_pendapatan_ymh_diterima" id="neraca_awal_d_pendapatan_ymh_diterima" name="neraca_awal_d_pendapatan_ymh_diterima" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Ymh. Diterima" inputmode="numeric" value="{{ old('neraca_awal_d_pendapatan_ymh_diterima') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_simpanan_manasuka_pkpri" id="neraca_awal_d_simpanan_manasuka_pkpri" name="neraca_awal_d_simpanan_manasuka_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka PKPRI" inputmode="numeric" value="{{ old('neraca_awal_d_simpanan_manasuka_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan di PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_tabungan_di_pkpri" id="neraca_awal_d_tabungan_di_pkpri" name="neraca_awal_d_tabungan_di_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan di PKPRI" inputmode="numeric" value="{{ old('neraca_awal_d_tabungan_di_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_simpanan_pokok_pkpri" id="neraca_awal_d_simpanan_pokok_pkpri" name="neraca_awal_d_simpanan_pokok_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok PKPRI" inputmode="numeric" value="{{ old('neraca_awal_d_simpanan_pokok_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_simpanan_wajib_pkpri" id="neraca_awal_d_simpanan_wajib_pkpri" name="neraca_awal_d_simpanan_wajib_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib PKPRI" inputmode="numeric" value="{{ old('neraca_awal_d_simpanan_wajib_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_simp_khusus_pkpri" id="neraca_awal_d_simp_khusus_pkpri" name="neraca_awal_d_simp_khusus_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus PKPRI" inputmode="numeric" value="{{ old('neraca_awal_d_simp_khusus_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_simp_khusus_swp" id="neraca_awal_d_simp_khusus_swp" name="neraca_awal_d_simp_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('neraca_awal_d_simp_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SKPB <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_skpb" id="neraca_awal_d_skpb" name="neraca_awal_d_skpb" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('neraca_awal_d_skpb') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di Hotel PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_penyertaan_di_hotel_pkpri" id="neraca_awal_d_penyertaan_di_hotel_pkpri" name="neraca_awal_d_penyertaan_di_hotel_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di Hotel PKPRI" inputmode="numeric" value="{{ old('neraca_awal_d_penyertaan_di_hotel_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di KOPEN <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_penyertaan_di_kopen" id="neraca_awal_d_penyertaan_di_kopen" name="neraca_awal_d_penyertaan_di_kopen" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('neraca_awal_d_penyertaan_di_kopen') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_penyertaan_unit_konsumsi" id="neraca_awal_d_penyertaan_unit_konsumsi" name="neraca_awal_d_penyertaan_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('neraca_awal_d_penyertaan_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_tanah" id="neraca_awal_d_tanah" name="neraca_awal_d_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tanah" inputmode="numeric" value="{{ old('neraca_awal_d_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kewajiban Titipan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_kewajiban_titipan" id="neraca_awal_d_kewajiban_titipan" name="neraca_awal_d_kewajiban_titipan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kewajiban Titipan" inputmode="numeric" value="{{ old('neraca_awal_d_kewajiban_titipan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Biaya yang Masih Harus Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_biaya_yang_masih_harus_dibayar" id="neraca_awal_d_biaya_yang_masih_harus_dibayar" name="neraca_awal_d_biaya_yang_masih_harus_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Biaya yang Masih Harus Dibayar" inputmode="numeric" value="{{ old('neraca_awal_d_biaya_yang_masih_harus_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Partisipasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_jasa_partisipasi" id="neraca_awal_d_jasa_partisipasi" name="neraca_awal_d_jasa_partisipasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Partisipasi" inputmode="numeric" value="{{ old('neraca_awal_d_jasa_partisipasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pengurus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_dana_pengurus" id="neraca_awal_d_dana_pengurus" name="neraca_awal_d_dana_pengurus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pengurus" inputmode="numeric" value="{{ old('neraca_awal_d_dana_pengurus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Karyawan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_dana_karyawan" id="neraca_awal_d_dana_karyawan" name="neraca_awal_d_dana_karyawan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Karyawan" inputmode="numeric" value="{{ old('neraca_awal_d_dana_karyawan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pendidikan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_dana_pendidikan" id="neraca_awal_d_dana_pendidikan" name="neraca_awal_d_dana_pendidikan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pendidikan" inputmode="numeric" value="{{ old('neraca_awal_d_dana_pendidikan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Sosial <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_dana_sosial" id="neraca_awal_d_dana_sosial" name="neraca_awal_d_dana_sosial" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Sosial" inputmode="numeric" value="{{ old('neraca_awal_d_dana_sosial') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Utang ke PKPRI/BNI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_utang_ke_pkpri_atau_bni" id="neraca_awal_d_utang_ke_pkpri_atau_bni" name="neraca_awal_d_utang_ke_pkpri_atau_bni" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Utang ke PKPRI/BNI" inputmode="numeric" value="{{ old('neraca_awal_d_utang_ke_pkpri_atau_bni') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan Qurban <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_tabungan_qurban" id="neraca_awal_d_tabungan_qurban" name="neraca_awal_d_tabungan_qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan Qurban" inputmode="numeric" value="{{ old('neraca_awal_d_tabungan_qurban') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_simpanan_khusus_swp" id="neraca_awal_d_simpanan_khusus_swp" name="neraca_awal_d_simpanan_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Khusus SWP" inputmode="numeric" value="{{ old('neraca_awal_d_simpanan_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_simpanan_manasuka" id="neraca_awal_d_simpanan_manasuka" name="neraca_awal_d_simpanan_manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka" inputmode="numeric" value="{{ old('neraca_awal_d_simpanan_manasuka') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Donasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_donasi" id="neraca_awal_d_donasi" name="neraca_awal_d_donasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Donasi" inputmode="numeric" value="{{ old('neraca_awal_d_donasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_simpanan_pokok_anggota" id="neraca_awal_d_simpanan_pokok_anggota" name="neraca_awal_d_simpanan_pokok_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok Anggota" inputmode="numeric" value="{{ old('neraca_awal_d_simpanan_pokok_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_simpanan_wajib_anggota" id="neraca_awal_d_simpanan_wajib_anggota" name="neraca_awal_d_simpanan_wajib_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib Anggota" inputmode="numeric" value="{{ old('neraca_awal_d_simpanan_wajib_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Cadangan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_cadangan" id="neraca_awal_d_cadangan" name="neraca_awal_d_cadangan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Cadangan" inputmode="numeric" value="{{ old('neraca_awal_d_cadangan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SHU <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_shu" id="neraca_awal_d_shu" name="neraca_awal_d_shu" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal SHU" inputmode="numeric" value="{{ old('neraca_awal_d_shu') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa dari Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_jasa_dari_anggota" id="neraca_awal_d_jasa_dari_anggota" name="neraca_awal_d_jasa_dari_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa dari Anggota" inputmode="numeric" value="{{ old('neraca_awal_d_jasa_dari_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Administrasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_jasa_administrasi" id="neraca_awal_d_jasa_administrasi" name="neraca_awal_d_jasa_administrasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Administrasi" inputmode="numeric" value="{{ old('neraca_awal_d_jasa_administrasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pembelian <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_pembelian" id="neraca_awal_d_pembelian" name="neraca_awal_d_pembelian" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pembelian" inputmode="numeric" value="{{ old('neraca_awal_d_pembelian') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_penjualan" id="neraca_awal_d_penjualan" name="neraca_awal_d_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penjualan" inputmode="numeric" value="{{ old('neraca_awal_d_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    HPP Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_hpp_penjualan" id="neraca_awal_d_hpp_penjualan" name="neraca_awal_d_hpp_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal HPP Penjualan" inputmode="numeric" value="{{ old('neraca_awal_d_hpp_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Organisasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_beban_organisasi" id="neraca_awal_d_beban_organisasi" name="neraca_awal_d_beban_organisasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Organisasi" inputmode="numeric" value="{{ old('neraca_awal_d_beban_organisasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Operasional <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_beban_operasional" id="neraca_awal_d_beban_operasional" name="neraca_awal_d_beban_operasional" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Operasional" inputmode="numeric" value="{{ old('neraca_awal_d_beban_operasional') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Umum <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_beban_umum" id="neraca_awal_d_beban_umum" name="neraca_awal_d_beban_umum" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Umum" inputmode="numeric" value="{{ old('neraca_awal_d_beban_umum') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_beban_lain_lain" id="neraca_awal_d_beban_lain_lain" name="neraca_awal_d_beban_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Lain-lain" inputmode="numeric" value="{{ old('neraca_awal_d_beban_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_jasa_unit_konsumsi" id="neraca_awal_d_jasa_unit_konsumsi" name="neraca_awal_d_jasa_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Unit Konsumsi" inputmode="numeric" value="{{ old('neraca_awal_d_jasa_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_pendapatan_lain_lain" id="neraca_awal_d_pendapatan_lain_lain" name="neraca_awal_d_pendapatan_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Lain-lain" inputmode="numeric" value="{{ old('neraca_awal_d_pendapatan_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Tanah Kavling <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_pendapatan_tanah_kavling" id="neraca_awal_d_pendapatan_tanah_kavling" name="neraca_awal_d_pendapatan_tanah_kavling" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Tanah Kavling" inputmode="numeric" value="{{ old('neraca_awal_d_pendapatan_tanah_kavling') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Khusus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_piutang_khusus" id="neraca_awal_d_piutang_khusus" name="neraca_awal_d_piutang_khusus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Khusus" inputmode="numeric" value="{{ old('neraca_awal_d_piutang_khusus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Pajak belum Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_beban_pajak_belum_dibayar" id="neraca_awal_d_beban_pajak_belum_dibayar" name="neraca_awal_d_beban_pajak_belum_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Pajak belum Dibayar" inputmode="numeric" value="{{ old('neraca_awal_d_beban_pajak_belum_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pajak <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_pajak" id="neraca_awal_d_pajak" name="neraca_awal_d_pajak" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pajak" inputmode="numeric" value="{{ old('neraca_awal_d_pajak') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Simp. Mana suka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_d_jasa_simp_mana_suka" id="neraca_awal_d_jasa_simp_mana_suka" name="neraca_awal_d_jasa_simp_mana_suka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Simp. Mana suka" inputmode="numeric" value="{{ old('neraca_awal_d_jasa_simp_mana_suka') }}" required/>
                            </div>
                        </div>
                        <hr class="mt-4 my-2 border-t-[1px] border-green-800 opacity-20">
                        <div class="mt-4">
                            <label class="block mb-1 text-sm font-medium text-gray-900">Jumlah</label>
                            <input type="text" wire:model="neraca_awal_d" id="neraca_awal_d" name="" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Jumlah" inputmode="numeric" value="" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Neraca Awal K --}}
            <div class="rounded-lg">
                <h2 id="accordion-collapse-heading-neraca-awal-k">
                    <button wire:ignore.self type="button" 
                        class="flex items-center justify-between w-full p-2 font-medium text-left text-gray-900 border border-gray-200 transition-all duration-200" 
                        data-accordion-target="#accordion-collapse-body-neraca-awal-k" 
                        aria-expanded="false" 
                        aria-controls="accordion-collapse-body-neraca-awal-k">
                        <span class="flex items-center text-sm text-gray-900">
                            Neraca Awal {{ $tahunNeracaAwal }} (K)
                        </span>
                        <div wire:ignore class="pr-0.5">
                            <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                </h2>
                <div wire:ignore.self id="accordion-collapse-body-neraca-awal-k" class="hidden" aria-labelledby="accordion-collapse-heading-neraca-awal-k">
                    <div class="p-5 border border-t-0 border-gray-200 bg-white">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kas <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_kas" id="neraca_awal_k_kas" name="neraca_awal_k_kas" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kas" inputmode="numeric" value="{{ old('neraca_awal_k_kas') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Bank <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_bank" id="neraca_awal_k_bank" name="neraca_awal_k_bank" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Bank" inputmode="numeric" value="{{ old('neraca_awal_k_bank') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_piutang" id="neraca_awal_k_piutang" name="neraca_awal_k_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang" inputmode="numeric" value="{{ old('neraca_awal_k_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_piutang_tanah" id="neraca_awal_k_piutang_tanah" name="neraca_awal_k_piutang_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Tanah" inputmode="numeric" value="{{ old('neraca_awal_k_piutang_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Lain Pada Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_piutang_lain_pada_anggota" id="neraca_awal_k_piutang_lain_pada_anggota" name="neraca_awal_k_piutang_lain_pada_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Lain Pada Anggota" inputmode="numeric" value="{{ old('neraca_awal_k_piutang_lain_pada_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyisihan Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_penyisihan_piutang" id="neraca_awal_k_penyisihan_piutang" name="neraca_awal_k_penyisihan_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penyisihan Piutang" inputmode="numeric" value="{{ old('neraca_awal_k_penyisihan_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_piutang_barang" id="neraca_awal_k_piutang_barang" name="neraca_awal_k_piutang_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Barang" inputmode="numeric" value="{{ old('neraca_awal_k_piutang_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_persediaan_barang" id="neraca_awal_k_persediaan_barang" name="neraca_awal_k_persediaan_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Barang" inputmode="numeric" value="{{ old('neraca_awal_k_persediaan_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_persediaan_peralatan" id="neraca_awal_k_persediaan_peralatan" name="neraca_awal_k_persediaan_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Peralatan" inputmode="numeric" value="{{ old('neraca_awal_k_persediaan_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Akumulasi Peny. Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_akumulasi_peny_peralatan" id="neraca_awal_k_akumulasi_peny_peralatan" name="neraca_awal_k_akumulasi_peny_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Akumulasi Peny. Peralatan" inputmode="numeric" value="{{ old('neraca_awal_k_akumulasi_peny_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Ymh. Diterima <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_pendapatan_ymh_diterima" id="neraca_awal_k_pendapatan_ymh_diterima" name="neraca_awal_k_pendapatan_ymh_diterima" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Ymh. Diterima" inputmode="numeric" value="{{ old('neraca_awal_k_pendapatan_ymh_diterima') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_simpanan_manasuka_pkpri" id="neraca_awal_k_simpanan_manasuka_pkpri" name="neraca_awal_k_simpanan_manasuka_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka PKPRI" inputmode="numeric" value="{{ old('neraca_awal_k_simpanan_manasuka_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan di PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_tabungan_di_pkpri" id="neraca_awal_k_tabungan_di_pkpri" name="neraca_awal_k_tabungan_di_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan di PKPRI" inputmode="numeric" value="{{ old('neraca_awal_k_tabungan_di_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_simpanan_pokok_pkpri" id="neraca_awal_k_simpanan_pokok_pkpri" name="neraca_awal_k_simpanan_pokok_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok PKPRI" inputmode="numeric" value="{{ old('neraca_awal_k_simpanan_pokok_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_simpanan_wajib_pkpri" id="neraca_awal_k_simpanan_wajib_pkpri" name="neraca_awal_k_simpanan_wajib_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib PKPRI" inputmode="numeric" value="{{ old('neraca_awal_k_simpanan_wajib_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_simp_khusus_pkpri" id="neraca_awal_k_simp_khusus_pkpri" name="neraca_awal_k_simp_khusus_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus PKPRI" inputmode="numeric" value="{{ old('neraca_awal_k_simp_khusus_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_simp_khusus_swp" id="neraca_awal_k_simp_khusus_swp" name="neraca_awal_k_simp_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('neraca_awal_k_simp_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SKPB <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_skpb" id="neraca_awal_k_skpb" name="neraca_awal_k_skpb" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('neraca_awal_k_skpb') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di Hotel PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_penyertaan_di_hotel_pkpri" id="neraca_awal_k_penyertaan_di_hotel_pkpri" name="neraca_awal_k_penyertaan_di_hotel_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di Hotel PKPRI" inputmode="numeric" value="{{ old('neraca_awal_k_penyertaan_di_hotel_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di KOPEN <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_penyertaan_di_kopen" id="neraca_awal_k_penyertaan_di_kopen" name="neraca_awal_k_penyertaan_di_kopen" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('neraca_awal_k_penyertaan_di_kopen') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_penyertaan_unit_konsumsi" id="neraca_awal_k_penyertaan_unit_konsumsi" name="neraca_awal_k_penyertaan_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('neraca_awal_k_penyertaan_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_tanah" id="neraca_awal_k_tanah" name="neraca_awal_k_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tanah" inputmode="numeric" value="{{ old('neraca_awal_k_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kewajiban Titipan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_kewajiban_titipan" id="neraca_awal_k_kewajiban_titipan" name="neraca_awal_k_kewajiban_titipan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kewajiban Titipan" inputmode="numeric" value="{{ old('neraca_awal_k_kewajiban_titipan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Biaya yang Masih Harus Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_biaya_yang_masih_harus_dibayar" id="neraca_awal_k_biaya_yang_masih_harus_dibayar" name="neraca_awal_k_biaya_yang_masih_harus_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Biaya yang Masih Harus Dibayar" inputmode="numeric" value="{{ old('neraca_awal_k_biaya_yang_masih_harus_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Partisipasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_jasa_partisipasi" id="neraca_awal_k_jasa_partisipasi" name="neraca_awal_k_jasa_partisipasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Partisipasi" inputmode="numeric" value="{{ old('neraca_awal_k_jasa_partisipasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pengurus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_dana_pengurus" id="neraca_awal_k_dana_pengurus" name="neraca_awal_k_dana_pengurus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pengurus" inputmode="numeric" value="{{ old('neraca_awal_k_dana_pengurus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Karyawan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_dana_karyawan" id="neraca_awal_k_dana_karyawan" name="neraca_awal_k_dana_karyawan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Karyawan" inputmode="numeric" value="{{ old('neraca_awal_k_dana_karyawan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pendidikan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_dana_pendidikan" id="neraca_awal_k_dana_pendidikan" name="neraca_awal_k_dana_pendidikan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pendidikan" inputmode="numeric" value="{{ old('neraca_awal_k_dana_pendidikan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Sosial <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_dana_sosial" id="neraca_awal_k_dana_sosial" name="neraca_awal_k_dana_sosial" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Sosial" inputmode="numeric" value="{{ old('neraca_awal_k_dana_sosial') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Utang ke PKPRI/BNI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_utang_ke_pkpri_atau_bni" id="neraca_awal_k_utang_ke_pkpri_atau_bni" name="neraca_awal_k_utang_ke_pkpri_atau_bni" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Utang ke PKPRI/BNI" inputmode="numeric" value="{{ old('neraca_awal_k_utang_ke_pkpri_atau_bni') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan Qurban <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_tabungan_qurban" id="neraca_awal_k_tabungan_qurban" name="neraca_awal_k_tabungan_qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan Qurban" inputmode="numeric" value="{{ old('neraca_awal_k_tabungan_qurban') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_simpanan_khusus_swp" id="neraca_awal_k_simpanan_khusus_swp" name="neraca_awal_k_simpanan_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Khusus SWP" inputmode="numeric" value="{{ old('neraca_awal_k_simpanan_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_simpanan_manasuka" id="neraca_awal_k_simpanan_manasuka" name="neraca_awal_k_simpanan_manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka" inputmode="numeric" value="{{ old('neraca_awal_k_simpanan_manasuka') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Donasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_donasi" id="neraca_awal_k_donasi" name="neraca_awal_k_donasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Donasi" inputmode="numeric" value="{{ old('neraca_awal_k_donasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_simpanan_pokok_anggota" id="neraca_awal_k_simpanan_pokok_anggota" name="neraca_awal_k_simpanan_pokok_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok Anggota" inputmode="numeric" value="{{ old('neraca_awal_k_simpanan_pokok_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_simpanan_wajib_anggota" id="neraca_awal_k_simpanan_wajib_anggota" name="neraca_awal_k_simpanan_wajib_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib Anggota" inputmode="numeric" value="{{ old('neraca_awal_k_simpanan_wajib_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Cadangan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_cadangan" id="neraca_awal_k_cadangan" name="neraca_awal_k_cadangan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Cadangan" inputmode="numeric" value="{{ old('neraca_awal_k_cadangan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SHU <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_shu" id="neraca_awal_k_shu" name="neraca_awal_k_shu" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal SHU" inputmode="numeric" value="{{ old('neraca_awal_k_shu') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa dari Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_jasa_dari_anggota" id="neraca_awal_k_jasa_dari_anggota" name="neraca_awal_k_jasa_dari_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa dari Anggota" inputmode="numeric" value="{{ old('neraca_awal_k_jasa_dari_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Administrasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_jasa_administrasi" id="neraca_awal_k_jasa_administrasi" name="neraca_awal_k_jasa_administrasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Administrasi" inputmode="numeric" value="{{ old('neraca_awal_k_jasa_administrasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pembelian <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_pembelian" id="neraca_awal_k_pembelian" name="neraca_awal_k_pembelian" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pembelian" inputmode="numeric" value="{{ old('neraca_awal_k_pembelian') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_penjualan" id="neraca_awal_k_penjualan" name="neraca_awal_k_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penjualan" inputmode="numeric" value="{{ old('neraca_awal_k_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    HPP Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_hpp_penjualan" id="neraca_awal_k_hpp_penjualan" name="neraca_awal_k_hpp_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal HPP Penjualan" inputmode="numeric" value="{{ old('neraca_awal_k_hpp_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Organisasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_beban_organisasi" id="neraca_awal_k_beban_organisasi" name="neraca_awal_k_beban_organisasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Organisasi" inputmode="numeric" value="{{ old('neraca_awal_k_beban_organisasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Operasional <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_beban_operasional" id="neraca_awal_k_beban_operasional" name="neraca_awal_k_beban_operasional" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Operasional" inputmode="numeric" value="{{ old('neraca_awal_k_beban_operasional') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Umum <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_beban_umum" id="neraca_awal_k_beban_umum" name="neraca_awal_k_beban_umum" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Umum" inputmode="numeric" value="{{ old('neraca_awal_k_beban_umum') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_beban_lain_lain" id="neraca_awal_k_beban_lain_lain" name="neraca_awal_k_beban_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Lain-lain" inputmode="numeric" value="{{ old('neraca_awal_k_beban_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_jasa_unit_konsumsi" id="neraca_awal_k_jasa_unit_konsumsi" name="neraca_awal_k_jasa_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Unit Konsumsi" inputmode="numeric" value="{{ old('neraca_awal_k_jasa_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_pendapatan_lain_lain" id="neraca_awal_k_pendapatan_lain_lain" name="neraca_awal_k_pendapatan_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Lain-lain" inputmode="numeric" value="{{ old('neraca_awal_k_pendapatan_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Tanah Kavling <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_pendapatan_tanah_kavling" id="neraca_awal_k_pendapatan_tanah_kavling" name="neraca_awal_k_pendapatan_tanah_kavling" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Tanah Kavling" inputmode="numeric" value="{{ old('neraca_awal_k_pendapatan_tanah_kavling') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Khusus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_piutang_khusus" id="neraca_awal_k_piutang_khusus" name="neraca_awal_k_piutang_khusus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Khusus" inputmode="numeric" value="{{ old('neraca_awal_k_piutang_khusus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Pajak belum Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_beban_pajak_belum_dibayar" id="neraca_awal_k_beban_pajak_belum_dibayar" name="neraca_awal_k_beban_pajak_belum_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Pajak belum Dibayar" inputmode="numeric" value="{{ old('neraca_awal_k_beban_pajak_belum_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pajak <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_pajak" id="neraca_awal_k_pajak" name="neraca_awal_k_pajak" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pajak" inputmode="numeric" value="{{ old('neraca_awal_k_pajak') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Simp. Mana suka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="neraca_awal_k_jasa_simp_mana_suka" id="neraca_awal_k_jasa_simp_mana_suka" name="neraca_awal_k_jasa_simp_mana_suka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Simp. Mana suka" inputmode="numeric" value="{{ old('neraca_awal_k_jasa_simp_mana_suka') }}" required/>
                            </div>
                        </div>
                        <hr class="mt-4 my-2 border-t-[1px] border-green-800 opacity-20">
                        <div class="mt-4">
                            <label class="block mb-1 text-sm font-medium text-gray-900">Jumlah</label>
                            <input type="text" wire:model="neraca_awal_k" id="neraca_awal_k" name="" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Jumlah" inputmode="numeric" value="" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            {{-- N. Perubahan (D) --}}
            <div class="rounded-lg">
                <h2 id="accordion-collapse-heading-n-perubahan-d">
                    <button wire:ignore.self type="button" 
                        class="flex items-center justify-between w-full p-2 font-medium text-left text-gray-900 border border-gray-200 transition-all duration-200" 
                        data-accordion-target="#accordion-collapse-body-n-perubahan-d" 
                        aria-expanded="false" 
                        aria-controls="accordion-collapse-body-n-perubahan-d">
                        <span class="flex items-center text-sm text-gray-900">
                            N. Perubahan (D)
                        </span>
                        <div wire:ignore class="pr-0.5">
                            <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                </h2>
                <div wire:ignore.self id="accordion-collapse-body-n-perubahan-d" class="hidden" aria-labelledby="accordion-collapse-heading-n-perubahan-d">
                    <div class="p-5 border border-t-0 border-gray-200 bg-white">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kas <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_kas" id="n_perubahan_d_kas" name="n_perubahan_d_kas" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kas" inputmode="numeric" value="{{ old('n_perubahan_d_kas') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Bank <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_bank" id="n_perubahan_d_bank" name="n_perubahan_d_bank" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Bank" inputmode="numeric" value="{{ old('n_perubahan_d_bank') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_piutang" id="n_perubahan_d_piutang" name="n_perubahan_d_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang" inputmode="numeric" value="{{ old('n_perubahan_d_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_piutang_tanah" id="n_perubahan_d_piutang_tanah" name="n_perubahan_d_piutang_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Tanah" inputmode="numeric" value="{{ old('n_perubahan_d_piutang_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Lain Pada Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_piutang_lain_pada_anggota" id="n_perubahan_d_piutang_lain_pada_anggota" name="n_perubahan_d_piutang_lain_pada_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Lain Pada Anggota" inputmode="numeric" value="{{ old('n_perubahan_d_piutang_lain_pada_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyisihan Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_penyisihan_piutang" id="n_perubahan_d_penyisihan_piutang" name="n_perubahan_d_penyisihan_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penyisihan Piutang" inputmode="numeric" value="{{ old('n_perubahan_d_penyisihan_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_piutang_barang" id="n_perubahan_d_piutang_barang" name="n_perubahan_d_piutang_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Barang" inputmode="numeric" value="{{ old('n_perubahan_d_piutang_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_persediaan_barang" id="n_perubahan_d_persediaan_barang" name="n_perubahan_d_persediaan_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Barang" inputmode="numeric" value="{{ old('n_perubahan_d_persediaan_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_persediaan_peralatan" id="n_perubahan_d_persediaan_peralatan" name="n_perubahan_d_persediaan_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Peralatan" inputmode="numeric" value="{{ old('n_perubahan_d_persediaan_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Akumulasi Peny. Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_akumulasi_peny_peralatan" id="n_perubahan_d_akumulasi_peny_peralatan" name="n_perubahan_d_akumulasi_peny_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Akumulasi Peny. Peralatan" inputmode="numeric" value="{{ old('n_perubahan_d_akumulasi_peny_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Ymh. Diterima <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_pendapatan_ymh_diterima" id="n_perubahan_d_pendapatan_ymh_diterima" name="n_perubahan_d_pendapatan_ymh_diterima" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Ymh. Diterima" inputmode="numeric" value="{{ old('n_perubahan_d_pendapatan_ymh_diterima') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_simpanan_manasuka_pkpri" id="n_perubahan_d_simpanan_manasuka_pkpri" name="n_perubahan_d_simpanan_manasuka_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka PKPRI" inputmode="numeric" value="{{ old('n_perubahan_d_simpanan_manasuka_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan di PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_tabungan_di_pkpri" id="n_perubahan_d_tabungan_di_pkpri" name="n_perubahan_d_tabungan_di_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan di PKPRI" inputmode="numeric" value="{{ old('n_perubahan_d_tabungan_di_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_simpanan_pokok_pkpri" id="n_perubahan_d_simpanan_pokok_pkpri" name="n_perubahan_d_simpanan_pokok_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok PKPRI" inputmode="numeric" value="{{ old('n_perubahan_d_simpanan_pokok_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_simpanan_wajib_pkpri" id="n_perubahan_d_simpanan_wajib_pkpri" name="n_perubahan_d_simpanan_wajib_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib PKPRI" inputmode="numeric" value="{{ old('n_perubahan_d_simpanan_wajib_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_simp_khusus_pkpri" id="n_perubahan_d_simp_khusus_pkpri" name="n_perubahan_d_simp_khusus_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus PKPRI" inputmode="numeric" value="{{ old('n_perubahan_d_simp_khusus_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_simp_khusus_swp" id="n_perubahan_d_simp_khusus_swp" name="n_perubahan_d_simp_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('n_perubahan_d_simp_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SKPB <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_skpb" id="n_perubahan_d_skpb" name="n_perubahan_d_skpb" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('n_perubahan_d_skpb') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di Hotel PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_penyertaan_di_hotel_pkpri" id="n_perubahan_d_penyertaan_di_hotel_pkpri" name="n_perubahan_d_penyertaan_di_hotel_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di Hotel PKPRI" inputmode="numeric" value="{{ old('n_perubahan_d_penyertaan_di_hotel_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di KOPEN <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_penyertaan_di_kopen" id="n_perubahan_d_penyertaan_di_kopen" name="n_perubahan_d_penyertaan_di_kopen" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('n_perubahan_d_penyertaan_di_kopen') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_penyertaan_unit_konsumsi" id="n_perubahan_d_penyertaan_unit_konsumsi" name="n_perubahan_d_penyertaan_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('n_perubahan_d_penyertaan_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_tanah" id="n_perubahan_d_tanah" name="n_perubahan_d_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tanah" inputmode="numeric" value="{{ old('n_perubahan_d_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kewajiban Titipan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_kewajiban_titipan" id="n_perubahan_d_kewajiban_titipan" name="n_perubahan_d_kewajiban_titipan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kewajiban Titipan" inputmode="numeric" value="{{ old('n_perubahan_d_kewajiban_titipan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Biaya yang Masih Harus Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_biaya_yang_masih_harus_dibayar" id="n_perubahan_d_biaya_yang_masih_harus_dibayar" name="n_perubahan_d_biaya_yang_masih_harus_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Biaya yang Masih Harus Dibayar" inputmode="numeric" value="{{ old('n_perubahan_d_biaya_yang_masih_harus_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Partisipasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_jasa_partisipasi" id="n_perubahan_d_jasa_partisipasi" name="n_perubahan_d_jasa_partisipasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Partisipasi" inputmode="numeric" value="{{ old('n_perubahan_d_jasa_partisipasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pengurus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_dana_pengurus" id="n_perubahan_d_dana_pengurus" name="n_perubahan_d_dana_pengurus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pengurus" inputmode="numeric" value="{{ old('n_perubahan_d_dana_pengurus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Karyawan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_dana_karyawan" id="n_perubahan_d_dana_karyawan" name="n_perubahan_d_dana_karyawan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Karyawan" inputmode="numeric" value="{{ old('n_perubahan_d_dana_karyawan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pendidikan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_dana_pendidikan" id="n_perubahan_d_dana_pendidikan" name="n_perubahan_d_dana_pendidikan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pendidikan" inputmode="numeric" value="{{ old('n_perubahan_d_dana_pendidikan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Sosial <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_dana_sosial" id="n_perubahan_d_dana_sosial" name="n_perubahan_d_dana_sosial" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Sosial" inputmode="numeric" value="{{ old('n_perubahan_d_dana_sosial') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Utang ke PKPRI/BNI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_utang_ke_pkpri_atau_bni" id="n_perubahan_d_utang_ke_pkpri_atau_bni" name="n_perubahan_d_utang_ke_pkpri_atau_bni" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Utang ke PKPRI/BNI" inputmode="numeric" value="{{ old('n_perubahan_d_utang_ke_pkpri_atau_bni') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan Qurban <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_tabungan_qurban" id="n_perubahan_d_tabungan_qurban" name="n_perubahan_d_tabungan_qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan Qurban" inputmode="numeric" value="{{ old('n_perubahan_d_tabungan_qurban') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_simpanan_khusus_swp" id="n_perubahan_d_simpanan_khusus_swp" name="n_perubahan_d_simpanan_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Khusus SWP" inputmode="numeric" value="{{ old('n_perubahan_d_simpanan_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_simpanan_manasuka" id="n_perubahan_d_simpanan_manasuka" name="n_perubahan_d_simpanan_manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka" inputmode="numeric" value="{{ old('n_perubahan_d_simpanan_manasuka') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Donasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_donasi" id="n_perubahan_d_donasi" name="n_perubahan_d_donasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Donasi" inputmode="numeric" value="{{ old('n_perubahan_d_donasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_simpanan_pokok_anggota" id="n_perubahan_d_simpanan_pokok_anggota" name="n_perubahan_d_simpanan_pokok_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok Anggota" inputmode="numeric" value="{{ old('n_perubahan_d_simpanan_pokok_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_simpanan_wajib_anggota" id="n_perubahan_d_simpanan_wajib_anggota" name="n_perubahan_d_simpanan_wajib_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib Anggota" inputmode="numeric" value="{{ old('n_perubahan_d_simpanan_wajib_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Cadangan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_cadangan" id="n_perubahan_d_cadangan" name="n_perubahan_d_cadangan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Cadangan" inputmode="numeric" value="{{ old('n_perubahan_d_cadangan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SHU <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_shu" id="n_perubahan_d_shu" name="n_perubahan_d_shu" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal SHU" inputmode="numeric" value="{{ old('n_perubahan_d_shu') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa dari Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_jasa_dari_anggota" id="n_perubahan_d_jasa_dari_anggota" name="n_perubahan_d_jasa_dari_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa dari Anggota" inputmode="numeric" value="{{ old('n_perubahan_d_jasa_dari_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Administrasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_jasa_administrasi" id="n_perubahan_d_jasa_administrasi" name="n_perubahan_d_jasa_administrasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Administrasi" inputmode="numeric" value="{{ old('n_perubahan_d_jasa_administrasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pembelian <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_pembelian" id="n_perubahan_d_pembelian" name="n_perubahan_d_pembelian" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pembelian" inputmode="numeric" value="{{ old('n_perubahan_d_pembelian') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_penjualan" id="n_perubahan_d_penjualan" name="n_perubahan_d_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penjualan" inputmode="numeric" value="{{ old('n_perubahan_d_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    HPP Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_hpp_penjualan" id="n_perubahan_d_hpp_penjualan" name="n_perubahan_d_hpp_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal HPP Penjualan" inputmode="numeric" value="{{ old('n_perubahan_d_hpp_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Organisasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_beban_organisasi" id="n_perubahan_d_beban_organisasi" name="n_perubahan_d_beban_organisasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Organisasi" inputmode="numeric" value="{{ old('n_perubahan_d_beban_organisasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Operasional <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_beban_operasional" id="n_perubahan_d_beban_operasional" name="n_perubahan_d_beban_operasional" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Operasional" inputmode="numeric" value="{{ old('n_perubahan_d_beban_operasional') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Umum <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_beban_umum" id="n_perubahan_d_beban_umum" name="n_perubahan_d_beban_umum" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Umum" inputmode="numeric" value="{{ old('n_perubahan_d_beban_umum') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_beban_lain_lain" id="n_perubahan_d_beban_lain_lain" name="n_perubahan_d_beban_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Lain-lain" inputmode="numeric" value="{{ old('n_perubahan_d_beban_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_jasa_unit_konsumsi" id="n_perubahan_d_jasa_unit_konsumsi" name="n_perubahan_d_jasa_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Unit Konsumsi" inputmode="numeric" value="{{ old('n_perubahan_d_jasa_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_pendapatan_lain_lain" id="n_perubahan_d_pendapatan_lain_lain" name="n_perubahan_d_pendapatan_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Lain-lain" inputmode="numeric" value="{{ old('n_perubahan_d_pendapatan_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Tanah Kavling <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_pendapatan_tanah_kavling" id="n_perubahan_d_pendapatan_tanah_kavling" name="n_perubahan_d_pendapatan_tanah_kavling" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Tanah Kavling" inputmode="numeric" value="{{ old('n_perubahan_d_pendapatan_tanah_kavling') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Khusus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_piutang_khusus" id="n_perubahan_d_piutang_khusus" name="n_perubahan_d_piutang_khusus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Khusus" inputmode="numeric" value="{{ old('n_perubahan_d_piutang_khusus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Pajak belum Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_beban_pajak_belum_dibayar" id="n_perubahan_d_beban_pajak_belum_dibayar" name="n_perubahan_d_beban_pajak_belum_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Pajak belum Dibayar" inputmode="numeric" value="{{ old('n_perubahan_d_beban_pajak_belum_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pajak <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_pajak" id="n_perubahan_d_pajak" name="n_perubahan_d_pajak" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pajak" inputmode="numeric" value="{{ old('n_perubahan_d_pajak') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Simp. Mana suka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_d_jasa_simp_mana_suka" id="n_perubahan_d_jasa_simp_mana_suka" name="n_perubahan_d_jasa_simp_mana_suka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Simp. Mana suka" inputmode="numeric" value="{{ old('n_perubahan_d_jasa_simp_mana_suka') }}" required/>
                            </div>
                        </div>
                        <hr class="mt-4 my-2 border-t-[1px] border-green-800 opacity-20">
                        <div class="mt-4">
                            <label class="block mb-1 text-sm font-medium text-gray-900">Jumlah</label>
                            <input type="text" wire:model="n_perubahan_d" id="n_perubahan_d" name="" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Jumlah" inputmode="numeric" value="" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            {{-- N. Perubahan (K) --}}
            <div class="rounded-lg">
                <h2 id="accordion-collapse-heading-n-perubahan-k">
                    <button wire:ignore.self type="button" 
                        class="flex items-center justify-between w-full p-2 font-medium text-left text-gray-900 border border-gray-200 transition-all duration-200" 
                        data-accordion-target="#accordion-collapse-body-n-perubahan-k" 
                        aria-expanded="false" 
                        aria-controls="accordion-collapse-body-n-perubahan-k">
                        <span class="flex items-center text-sm text-gray-900">
                            N. Perubahan (K)
                        </span>
                        <div wire:ignore class="pr-0.5">
                            <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                </h2>
                <div wire:ignore.self id="accordion-collapse-body-n-perubahan-k" class="hidden" aria-labelledby="accordion-collapse-heading-n-perubahan-k">
                    <div class="p-5 border border-t-0 border-gray-200 bg-white">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kas <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_kas" id="n_perubahan_k_kas" name="n_perubahan_k_kas" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kas" inputmode="numeric" value="{{ old('n_perubahan_k_kas') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Bank <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_bank" id="n_perubahan_k_bank" name="n_perubahan_k_bank" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Bank" inputmode="numeric" value="{{ old('n_perubahan_k_bank') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_piutang" id="n_perubahan_k_piutang" name="n_perubahan_k_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang" inputmode="numeric" value="{{ old('n_perubahan_k_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_piutang_tanah" id="n_perubahan_k_piutang_tanah" name="n_perubahan_k_piutang_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Tanah" inputmode="numeric" value="{{ old('n_perubahan_k_piutang_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Lain Pada Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_piutang_lain_pada_anggota" id="n_perubahan_k_piutang_lain_pada_anggota" name="n_perubahan_k_piutang_lain_pada_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Lain Pada Anggota" inputmode="numeric" value="{{ old('n_perubahan_k_piutang_lain_pada_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyisihan Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_penyisihan_piutang" id="n_perubahan_k_penyisihan_piutang" name="n_perubahan_k_penyisihan_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penyisihan Piutang" inputmode="numeric" value="{{ old('neraca_awal_d_penyisihan_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_piutang_barang" id="n_perubahan_k_piutang_barang" name="n_perubahan_k_piutang_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Barang" inputmode="numeric" value="{{ old('n_perubahan_k_piutang_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_persediaan_barang" id="n_perubahan_k_persediaan_barang" name="n_perubahan_k_persediaan_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Barang" inputmode="numeric" value="{{ old('n_perubahan_k_persediaan_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_persediaan_peralatan" id="n_perubahan_k_persediaan_peralatan" name="n_perubahan_k_persediaan_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Peralatan" inputmode="numeric" value="{{ old('n_perubahan_k_persediaan_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Akumulasi Peny. Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_akumulasi_peny_peralatan" id="n_perubahan_k_akumulasi_peny_peralatan" name="n_perubahan_k_akumulasi_peny_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Akumulasi Peny. Peralatan" inputmode="numeric" value="{{ old('n_perubahan_k_akumulasi_peny_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Ymh. Diterima <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_pendapatan_ymh_diterima" id="n_perubahan_k_pendapatan_ymh_diterima" name="n_perubahan_k_pendapatan_ymh_diterima" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Ymh. Diterima" inputmode="numeric" value="{{ old('n_perubahan_k_pendapatan_ymh_diterima') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_simpanan_manasuka_pkpri" id="n_perubahan_k_simpanan_manasuka_pkpri" name="n_perubahan_k_simpanan_manasuka_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka PKPRI" inputmode="numeric" value="{{ old('n_perubahan_k_simpanan_manasuka_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan di PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_tabungan_di_pkpri" id="n_perubahan_k_tabungan_di_pkpri" name="n_perubahan_k_tabungan_di_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan di PKPRI" inputmode="numeric" value="{{ old('n_perubahan_k_tabungan_di_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_simpanan_pokok_pkpri" id="n_perubahan_k_simpanan_pokok_pkpri" name="n_perubahan_k_simpanan_pokok_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok PKPRI" inputmode="numeric" value="{{ old('n_perubahan_k_simpanan_pokok_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_simpanan_wajib_pkpri" id="n_perubahan_k_simpanan_wajib_pkpri" name="n_perubahan_k_simpanan_wajib_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib PKPRI" inputmode="numeric" value="{{ old('n_perubahan_k_simpanan_wajib_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_simp_khusus_pkpri" id="n_perubahan_k_simp_khusus_pkpri" name="n_perubahan_k_simp_khusus_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus PKPRI" inputmode="numeric" value="{{ old('n_perubahan_k_simp_khusus_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_simp_khusus_swp" id="n_perubahan_k_simp_khusus_swp" name="n_perubahan_k_simp_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('n_perubahan_k_simp_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SKPB <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_skpb" id="n_perubahan_k_skpb" name="n_perubahan_k_skpb" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('n_perubahan_k_skpb') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di Hotel PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_penyertaan_di_hotel_pkpri" id="n_perubahan_k_penyertaan_di_hotel_pkpri" name="n_perubahan_k_penyertaan_di_hotel_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di Hotel PKPRI" inputmode="numeric" value="{{ old('n_perubahan_k_penyertaan_di_hotel_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di KOPEN <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_penyertaan_di_kopen" id="n_perubahan_k_penyertaan_di_kopen" name="n_perubahan_k_penyertaan_di_kopen" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('n_perubahan_k_penyertaan_di_kopen') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_penyertaan_unit_konsumsi" id="n_perubahan_k_penyertaan_unit_konsumsi" name="n_perubahan_k_penyertaan_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('n_perubahan_k_penyertaan_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_tanah" id="n_perubahan_k_tanah" name="n_perubahan_k_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tanah" inputmode="numeric" value="{{ old('n_perubahan_k_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kewajiban Titipan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_kewajiban_titipan" id="n_perubahan_k_kewajiban_titipan" name="n_perubahan_k_kewajiban_titipan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kewajiban Titipan" inputmode="numeric" value="{{ old('n_perubahan_k_kewajiban_titipan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Biaya yang Masih Harus Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_biaya_yang_masih_harus_dibayar" id="n_perubahan_k_biaya_yang_masih_harus_dibayar" name="n_perubahan_k_biaya_yang_masih_harus_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Biaya yang Masih Harus Dibayar" inputmode="numeric" value="{{ old('n_perubahan_k_biaya_yang_masih_harus_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Partisipasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_jasa_partisipasi" id="n_perubahan_k_jasa_partisipasi" name="n_perubahan_k_jasa_partisipasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Partisipasi" inputmode="numeric" value="{{ old('n_perubahan_k_jasa_partisipasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pengurus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_dana_pengurus" id="n_perubahan_k_dana_pengurus" name="n_perubahan_k_dana_pengurus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pengurus" inputmode="numeric" value="{{ old('n_perubahan_k_dana_pengurus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Karyawan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_dana_karyawan" id="n_perubahan_k_dana_karyawan" name="n_perubahan_k_dana_karyawan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Karyawan" inputmode="numeric" value="{{ old('n_perubahan_k_dana_karyawan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pendidikan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_dana_pendidikan" id="n_perubahan_k_dana_pendidikan" name="n_perubahan_k_dana_pendidikan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pendidikan" inputmode="numeric" value="{{ old('n_perubahan_k_dana_pendidikan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Sosial <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_dana_sosial" id="n_perubahan_k_dana_sosial" name="n_perubahan_k_dana_sosial" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Sosial" inputmode="numeric" value="{{ old('n_perubahan_k_dana_sosial') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Utang ke PKPRI/BNI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_utang_ke_pkpri_atau_bni" id="n_perubahan_k_utang_ke_pkpri_atau_bni" name="n_perubahan_k_utang_ke_pkpri_atau_bni" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Utang ke PKPRI/BNI" inputmode="numeric" value="{{ old('n_perubahan_k_utang_ke_pkpri_atau_bni') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan Qurban <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_tabungan_qurban" id="n_perubahan_k_tabungan_qurban" name="n_perubahan_k_tabungan_qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan Qurban" inputmode="numeric" value="{{ old('n_perubahan_k_tabungan_qurban') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_simpanan_khusus_swp" id="n_perubahan_k_simpanan_khusus_swp" name="n_perubahan_k_simpanan_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Khusus SWP" inputmode="numeric" value="{{ old('n_perubahan_k_simpanan_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_simpanan_manasuka" id="n_perubahan_k_simpanan_manasuka" name="n_perubahan_k_simpanan_manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka" inputmode="numeric" value="{{ old('n_perubahan_k_simpanan_manasuka') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Donasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_donasi" id="n_perubahan_k_donasi" name="n_perubahan_k_donasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Donasi" inputmode="numeric" value="{{ old('n_perubahan_k_donasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_simpanan_pokok_anggota" id="n_perubahan_k_simpanan_pokok_anggota" name="n_perubahan_k_simpanan_pokok_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok Anggota" inputmode="numeric" value="{{ old('n_perubahan_k_simpanan_pokok_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_simpanan_wajib_anggota" id="n_perubahan_k_simpanan_wajib_anggota" name="n_perubahan_k_simpanan_wajib_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib Anggota" inputmode="numeric" value="{{ old('n_perubahan_k_simpanan_wajib_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Cadangan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_cadangan" id="n_perubahan_k_cadangan" name="n_perubahan_k_cadangan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Cadangan" inputmode="numeric" value="{{ old('n_perubahan_k_cadangan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SHU <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_shu" id="n_perubahan_k_shu" name="n_perubahan_k_shu" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal SHU" inputmode="numeric" value="{{ old('n_perubahan_k_shu') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa dari Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_jasa_dari_anggota" id="n_perubahan_k_jasa_dari_anggota" name="n_perubahan_k_jasa_dari_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa dari Anggota" inputmode="numeric" value="{{ old('n_perubahan_k_jasa_dari_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Administrasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_jasa_administrasi" id="n_perubahan_k_jasa_administrasi" name="n_perubahan_k_jasa_administrasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Administrasi" inputmode="numeric" value="{{ old('n_perubahan_k_jasa_administrasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pembelian <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_pembelian" id="n_perubahan_k_pembelian" name="n_perubahan_k_pembelian" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pembelian" inputmode="numeric" value="{{ old('n_perubahan_k_pembelian') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_penjualan" id="n_perubahan_k_penjualan" name="n_perubahan_k_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penjualan" inputmode="numeric" value="{{ old('n_perubahan_k_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    HPP Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_hpp_penjualan" id="n_perubahan_k_hpp_penjualan" name="n_perubahan_k_hpp_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal HPP Penjualan" inputmode="numeric" value="{{ old('n_perubahan_k_hpp_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Organisasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_beban_organisasi" id="n_perubahan_k_beban_organisasi" name="n_perubahan_k_beban_organisasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Organisasi" inputmode="numeric" value="{{ old('n_perubahan_k_beban_organisasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Operasional <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_beban_operasional" id="n_perubahan_k_beban_operasional" name="n_perubahan_k_beban_operasional" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Operasional" inputmode="numeric" value="{{ old('n_perubahan_k_beban_operasional') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Umum <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_beban_umum" id="n_perubahan_k_beban_umum" name="n_perubahan_k_beban_umum" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Umum" inputmode="numeric" value="{{ old('n_perubahan_k_beban_umum') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_beban_lain_lain" id="n_perubahan_k_beban_lain_lain" name="n_perubahan_k_beban_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Lain-lain" inputmode="numeric" value="{{ old('n_perubahan_k_beban_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_jasa_unit_konsumsi" id="n_perubahan_k_jasa_unit_konsumsi" name="n_perubahan_k_jasa_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Unit Konsumsi" inputmode="numeric" value="{{ old('n_perubahan_k_jasa_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_pendapatan_lain_lain" id="n_perubahan_k_pendapatan_lain_lain" name="n_perubahan_k_pendapatan_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Lain-lain" inputmode="numeric" value="{{ old('n_perubahan_k_pendapatan_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Tanah Kavling <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_pendapatan_tanah_kavling" id="n_perubahan_k_pendapatan_tanah_kavling" name="n_perubahan_k_pendapatan_tanah_kavling" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Tanah Kavling" inputmode="numeric" value="{{ old('n_perubahan_k_pendapatan_tanah_kavling') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Khusus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_piutang_khusus" id="n_perubahan_k_piutang_khusus" name="n_perubahan_k_piutang_khusus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Khusus" inputmode="numeric" value="{{ old('n_perubahan_k_piutang_khusus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Pajak belum Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_beban_pajak_belum_dibayar" id="n_perubahan_k_beban_pajak_belum_dibayar" name="n_perubahan_k_beban_pajak_belum_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Pajak belum Dibayar" inputmode="numeric" value="{{ old('n_perubahan_k_beban_pajak_belum_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pajak <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_pajak" id="n_perubahan_k_pajak" name="n_perubahan_k_pajak" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pajak" inputmode="numeric" value="{{ old('n_perubahan_k_pajak') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Simp. Mana suka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="n_perubahan_k_jasa_simp_mana_suka" id="n_perubahan_k_jasa_simp_mana_suka" name="n_perubahan_k_jasa_simp_mana_suka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Simp. Mana suka" inputmode="numeric" value="{{ old('n_perubahan_k_jasa_simp_mana_suka') }}" required/>
                            </div>
                        </div>
                        <hr class="mt-4 my-2 border-t-[1px] border-green-800 opacity-20">
                        <div class="mt-4">
                            <label class="block mb-1 text-sm font-medium text-gray-900">Jumlah</label>
                            <input type="text" wire:model="n_perubahan_k" id="n_perubahan_k" name="" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Jumlah" inputmode="numeric" value="" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            {{-- A. Penyesuaian (D) --}}
            <div class="rounded-lg">
                <h2 id="accordion-collapse-heading-a-penyesuaian-d">
                    <button wire:ignore.self type="button" 
                        class="flex items-center justify-between w-full p-2 font-medium text-left text-gray-900 border border-gray-200 transition-all duration-200" 
                        data-accordion-target="#accordion-collapse-body-a-penyesuaian-d" 
                        aria-expanded="false" 
                        aria-controls="accordion-collapse-body-a-penyesuaian-d">
                        <span class="flex items-center text-sm text-gray-900">
                            A. Penyesuaian (D)
                        </span>
                        <div wire:ignore class="pr-0.5">
                            <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                </h2>
                <div wire:ignore.self id="accordion-collapse-body-a-penyesuaian-d" class="hidden" aria-labelledby="accordion-collapse-heading-a-penyesuaian-d">
                    <div class="p-5 border border-t-0 border-gray-200 bg-white">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kas <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_kas" id="a_penyesuaian_d_kas" name="a_penyesuaian_d_kas" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kas" inputmode="numeric" value="{{ old('a_penyesuaian_d_kas') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Bank <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_bank" id="a_penyesuaian_d_bank" name="a_penyesuaian_d_bank" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Bank" inputmode="numeric" value="{{ old('a_penyesuaian_d_bank') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_piutang" id="a_penyesuaian_d_piutang" name="a_penyesuaian_d_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang" inputmode="numeric" value="{{ old('a_penyesuaian_d_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_piutang_tanah" id="a_penyesuaian_d_piutang_tanah" name="a_penyesuaian_d_piutang_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Tanah" inputmode="numeric" value="{{ old('a_penyesuaian_d_piutang_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Lain Pada Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_piutang_lain_pada_anggota" id="a_penyesuaian_d_piutang_lain_pada_anggota" name="a_penyesuaian_d_piutang_lain_pada_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Lain Pada Anggota" inputmode="numeric" value="{{ old('a_penyesuaian_d_piutang_lain_pada_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyisihan Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_penyisihan_piutang" id="a_penyesuaian_d_penyisihan_piutang" name="a_penyesuaian_d_penyisihan_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penyisihan Piutang" inputmode="numeric" value="{{ old('a_penyesuaian_d_penyisihan_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_piutang_barang" id="a_penyesuaian_d_piutang_barang" name="a_penyesuaian_d_piutang_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Barang" inputmode="numeric" value="{{ old('a_penyesuaian_d_piutang_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_persediaan_barang" id="a_penyesuaian_d_persediaan_barang" name="a_penyesuaian_d_persediaan_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Barang" inputmode="numeric" value="{{ old('a_penyesuaian_d_persediaan_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_persediaan_peralatan" id="a_penyesuaian_d_persediaan_peralatan" name="a_penyesuaian_d_persediaan_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Peralatan" inputmode="numeric" value="{{ old('a_penyesuaian_d_persediaan_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Akumulasi Peny. Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_akumulasi_peny_peralatan" id="a_penyesuaian_d_akumulasi_peny_peralatan" name="a_penyesuaian_d_akumulasi_peny_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Akumulasi Peny. Peralatan" inputmode="numeric" value="{{ old('a_penyesuaian_d_akumulasi_peny_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Ymh. Diterima <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_pendapatan_ymh_diterima" id="a_penyesuaian_d_pendapatan_ymh_diterima" name="a_penyesuaian_d_pendapatan_ymh_diterima" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Ymh. Diterima" inputmode="numeric" value="{{ old('a_penyesuaian_d_pendapatan_ymh_diterima') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_simpanan_manasuka_pkpri" id="a_penyesuaian_d_simpanan_manasuka_pkpri" name="a_penyesuaian_d_simpanan_manasuka_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka PKPRI" inputmode="numeric" value="{{ old('a_penyesuaian_d_simpanan_manasuka_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan di PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_tabungan_di_pkpri" id="a_penyesuaian_d_tabungan_di_pkpri" name="a_penyesuaian_d_tabungan_di_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan di PKPRI" inputmode="numeric" value="{{ old('a_penyesuaian_d_tabungan_di_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_simpanan_pokok_pkpri" id="a_penyesuaian_d_simpanan_pokok_pkpri" name="a_penyesuaian_d_simpanan_pokok_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok PKPRI" inputmode="numeric" value="{{ old('a_penyesuaian_d_simpanan_pokok_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_simpanan_wajib_pkpri" id="a_penyesuaian_d_simpanan_wajib_pkpri" name="a_penyesuaian_d_simpanan_wajib_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib PKPRI" inputmode="numeric" value="{{ old('a_penyesuaian_d_simpanan_wajib_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_simp_khusus_pkpri" id="a_penyesuaian_d_simp_khusus_pkpri" name="a_penyesuaian_d_simp_khusus_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus PKPRI" inputmode="numeric" value="{{ old('a_penyesuaian_d_simp_khusus_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_simp_khusus_swp" id="a_penyesuaian_d_simp_khusus_swp" name="a_penyesuaian_d_simp_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('a_penyesuaian_d_simp_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SKPB <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_skpb" id="a_penyesuaian_d_skpb" name="a_penyesuaian_d_skpb" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('a_penyesuaian_d_skpb') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di Hotel PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_penyertaan_di_hotel_pkpri" id="a_penyesuaian_d_penyertaan_di_hotel_pkpri" name="a_penyesuaian_d_penyertaan_di_hotel_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di Hotel PKPRI" inputmode="numeric" value="{{ old('a_penyesuaian_d_penyertaan_di_hotel_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di KOPEN <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_penyertaan_di_kopen" id="a_penyesuaian_d_penyertaan_di_kopen" name="a_penyesuaian_d_penyertaan_di_kopen" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('a_penyesuaian_d_penyertaan_di_kopen') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_penyertaan_unit_konsumsi" id="a_penyesuaian_d_penyertaan_unit_konsumsi" name="a_penyesuaian_d_penyertaan_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('a_penyesuaian_d_penyertaan_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_tanah" id="a_penyesuaian_d_tanah" name="a_penyesuaian_d_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tanah" inputmode="numeric" value="{{ old('a_penyesuaian_d_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kewajiban Titipan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_kewajiban_titipan" id="a_penyesuaian_d_kewajiban_titipan" name="a_penyesuaian_d_kewajiban_titipan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kewajiban Titipan" inputmode="numeric" value="{{ old('a_penyesuaian_d_kewajiban_titipan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Biaya yang Masih Harus Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_biaya_yang_masih_harus_dibayar" id="a_penyesuaian_d_biaya_yang_masih_harus_dibayar" name="a_penyesuaian_d_biaya_yang_masih_harus_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Biaya yang Masih Harus Dibayar" inputmode="numeric" value="{{ old('a_penyesuaian_d_biaya_yang_masih_harus_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Partisipasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_jasa_partisipasi" id="a_penyesuaian_d_jasa_partisipasi" name="a_penyesuaian_d_jasa_partisipasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Partisipasi" inputmode="numeric" value="{{ old('a_penyesuaian_d_jasa_partisipasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pengurus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_dana_pengurus" id="a_penyesuaian_d_dana_pengurus" name="a_penyesuaian_d_dana_pengurus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pengurus" inputmode="numeric" value="{{ old('a_penyesuaian_d_dana_pengurus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Karyawan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_dana_karyawan" id="a_penyesuaian_d_dana_karyawan" name="a_penyesuaian_d_dana_karyawan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Karyawan" inputmode="numeric" value="{{ old('a_penyesuaian_d_dana_karyawan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pendidikan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_dana_pendidikan" id="a_penyesuaian_d_dana_pendidikan" name="a_penyesuaian_d_dana_pendidikan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pendidikan" inputmode="numeric" value="{{ old('a_penyesuaian_d_dana_pendidikan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Sosial <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_dana_sosial" id="a_penyesuaian_d_dana_sosial" name="a_penyesuaian_d_dana_sosial" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Sosial" inputmode="numeric" value="{{ old('a_penyesuaian_d_dana_sosial') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Utang ke PKPRI/BNI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_utang_ke_pkpri_atau_bni" id="a_penyesuaian_d_utang_ke_pkpri_atau_bni" name="a_penyesuaian_d_utang_ke_pkpri_atau_bni" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Utang ke PKPRI/BNI" inputmode="numeric" value="{{ old('a_penyesuaian_d_utang_ke_pkpri_atau_bni') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan Qurban <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_tabungan_qurban" id="a_penyesuaian_d_tabungan_qurban" name="a_penyesuaian_d_tabungan_qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan Qurban" inputmode="numeric" value="{{ old('a_penyesuaian_d_tabungan_qurban') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_simpanan_khusus_swp" id="a_penyesuaian_d_simpanan_khusus_swp" name="a_penyesuaian_d_simpanan_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Khusus SWP" inputmode="numeric" value="{{ old('a_penyesuaian_d_simpanan_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_simpanan_manasuka" id="a_penyesuaian_d_simpanan_manasuka" name="a_penyesuaian_d_simpanan_manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka" inputmode="numeric" value="{{ old('a_penyesuaian_d_simpanan_manasuka') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Donasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_donasi" id="a_penyesuaian_d_donasi" name="a_penyesuaian_d_donasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Donasi" inputmode="numeric" value="{{ old('a_penyesuaian_d_donasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_simpanan_pokok_anggota" id="a_penyesuaian_d_simpanan_pokok_anggota" name="a_penyesuaian_d_simpanan_pokok_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok Anggota" inputmode="numeric" value="{{ old('a_penyesuaian_d_simpanan_pokok_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_simpanan_wajib_anggota" id="a_penyesuaian_d_simpanan_wajib_anggota" name="a_penyesuaian_d_simpanan_wajib_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib Anggota" inputmode="numeric" value="{{ old('a_penyesuaian_d_simpanan_wajib_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Cadangan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_cadangan" id="a_penyesuaian_d_cadangan" name="a_penyesuaian_d_cadangan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Cadangan" inputmode="numeric" value="{{ old('a_penyesuaian_d_cadangan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SHU <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_shu" id="a_penyesuaian_d_shu" name="a_penyesuaian_d_shu" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal SHU" inputmode="numeric" value="{{ old('a_penyesuaian_d_shu') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa dari Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_jasa_dari_anggota" id="a_penyesuaian_d_jasa_dari_anggota" name="a_penyesuaian_d_jasa_dari_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa dari Anggota" inputmode="numeric" value="{{ old('a_penyesuaian_d_jasa_dari_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Administrasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_jasa_administrasi" id="a_penyesuaian_d_jasa_administrasi" name="a_penyesuaian_d_jasa_administrasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Administrasi" inputmode="numeric" value="{{ old('a_penyesuaian_d_jasa_administrasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pembelian <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_pembelian" id="a_penyesuaian_d_pembelian" name="a_penyesuaian_d_pembelian" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pembelian" inputmode="numeric" value="{{ old('a_penyesuaian_d_pembelian') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_penjualan" id="a_penyesuaian_d_penjualan" name="a_penyesuaian_d_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penjualan" inputmode="numeric" value="{{ old('a_penyesuaian_d_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    HPP Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_hpp_penjualan" id="a_penyesuaian_d_hpp_penjualan" name="a_penyesuaian_d_hpp_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal HPP Penjualan" inputmode="numeric" value="{{ old('a_penyesuaian_d_hpp_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Organisasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_beban_organisasi" id="a_penyesuaian_d_beban_organisasi" name="a_penyesuaian_d_beban_organisasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Organisasi" inputmode="numeric" value="{{ old('a_penyesuaian_d_beban_organisasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Operasional <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_beban_operasional" id="a_penyesuaian_d_beban_operasional" name="a_penyesuaian_d_beban_operasional" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Operasional" inputmode="numeric" value="{{ old('a_penyesuaian_d_beban_operasional') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Umum <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_beban_umum" id="a_penyesuaian_d_beban_umum" name="a_penyesuaian_d_beban_umum" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Umum" inputmode="numeric" value="{{ old('a_penyesuaian_d_beban_umum') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_beban_lain_lain" id="a_penyesuaian_d_beban_lain_lain" name="a_penyesuaian_d_beban_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Lain-lain" inputmode="numeric" value="{{ old('a_penyesuaian_d_beban_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_jasa_unit_konsumsi" id="a_penyesuaian_d_jasa_unit_konsumsi" name="a_penyesuaian_d_jasa_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Unit Konsumsi" inputmode="numeric" value="{{ old('a_penyesuaian_d_jasa_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_pendapatan_lain_lain" id="a_penyesuaian_d_pendapatan_lain_lain" name="a_penyesuaian_d_pendapatan_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Lain-lain" inputmode="numeric" value="{{ old('a_penyesuaian_d_pendapatan_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Tanah Kavling <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_pendapatan_tanah_kavling" id="a_penyesuaian_d_pendapatan_tanah_kavling" name="a_penyesuaian_d_pendapatan_tanah_kavling" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Tanah Kavling" inputmode="numeric" value="{{ old('a_penyesuaian_d_pendapatan_tanah_kavling') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Khusus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_piutang_khusus" id="a_penyesuaian_d_piutang_khusus" name="a_penyesuaian_d_piutang_khusus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Khusus" inputmode="numeric" value="{{ old('a_penyesuaian_d_piutang_khusus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Pajak belum Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_beban_pajak_belum_dibayar" id="a_penyesuaian_d_beban_pajak_belum_dibayar" name="a_penyesuaian_d_beban_pajak_belum_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Pajak belum Dibayar" inputmode="numeric" value="{{ old('a_penyesuaian_d_beban_pajak_belum_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pajak <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_pajak" id="a_penyesuaian_d_pajak" name="a_penyesuaian_d_pajak" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pajak" inputmode="numeric" value="{{ old('a_penyesuaian_d_pajak') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Simp. Mana suka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_d_jasa_simp_mana_suka" id="a_penyesuaian_d_jasa_simp_mana_suka" name="a_penyesuaian_d_jasa_simp_mana_suka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Simp. Mana suka" inputmode="numeric" value="{{ old('a_penyesuaian_d_jasa_simp_mana_suka') }}" required/>
                            </div>
                        </div>
                        <hr class="mt-4 my-2 border-t-[1px] border-green-800 opacity-20">
                        <div class="mt-4">
                            <label class="block mb-1 text-sm font-medium text-gray-900">Jumlah</label>
                            <input type="text" wire:model="a_penyesuaian_d" id="a_penyesuaian_d" name="" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Jumlah" inputmode="numeric" value="" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            {{-- A. Penyesuaian (K) --}}
            <div class="rounded-lg">
                <h2 id="accordion-collapse-heading-a-penyesuaian-k">
                    <button wire:ignore.self type="button" 
                        class="flex items-center justify-between w-full p-2 font-medium text-left text-gray-900 border border-gray-200 transition-all duration-200" 
                        data-accordion-target="#accordion-collapse-body-a-penyesuaian-k" 
                        aria-expanded="false" 
                        aria-controls="accordion-collapse-body-a-penyesuaian-k">
                        <span class="flex items-center text-sm text-gray-900">
                            A. Penyesuaian (K)
                        </span>
                        <div wire:ignore class="pr-0.5">
                            <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                </h2>
                <div wire:ignore.self id="accordion-collapse-body-a-penyesuaian-k" class="hidden" aria-labelledby="accordion-collapse-heading-a-penyesuaian-k">
                    <div class="p-5 border border-t-0 border-gray-200 bg-white">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kas <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_kas" id="a_penyesuaian_k_kas" name="a_penyesuaian_k_kas" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kas" inputmode="numeric" value="{{ old('a_penyesuaian_k_kas') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Bank <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_bank" id="a_penyesuaian_k_bank" name="a_penyesuaian_k_bank" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Bank" inputmode="numeric" value="{{ old('a_penyesuaian_k_bank') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_piutang" id="a_penyesuaian_k_piutang" name="a_penyesuaian_k_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang" inputmode="numeric" value="{{ old('a_penyesuaian_k_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_piutang_tanah" id="a_penyesuaian_k_piutang_tanah" name="a_penyesuaian_k_piutang_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Tanah" inputmode="numeric" value="{{ old('a_penyesuaian_k_piutang_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Lain Pada Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_piutang_lain_pada_anggota" id="a_penyesuaian_k_piutang_lain_pada_anggota" name="a_penyesuaian_k_piutang_lain_pada_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Lain Pada Anggota" inputmode="numeric" value="{{ old('a_penyesuaian_k_piutang_lain_pada_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyisihan Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_penyisihan_piutang" id="a_penyesuaian_k_penyisihan_piutang" name="a_penyesuaian_k_penyisihan_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penyisihan Piutang" inputmode="numeric" value="{{ old('a_penyesuaian_k_penyisihan_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_piutang_barang" id="a_penyesuaian_k_piutang_barang" name="a_penyesuaian_k_piutang_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Barang" inputmode="numeric" value="{{ old('a_penyesuaian_k_piutang_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_persediaan_barang" id="a_penyesuaian_k_persediaan_barang" name="a_penyesuaian_k_persediaan_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Barang" inputmode="numeric" value="{{ old('a_penyesuaian_k_persediaan_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_persediaan_peralatan" id="a_penyesuaian_k_persediaan_peralatan" name="a_penyesuaian_k_persediaan_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Peralatan" inputmode="numeric" value="{{ old('a_penyesuaian_k_persediaan_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Akumulasi Peny. Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_akumulasi_peny_peralatan" id="a_penyesuaian_k_akumulasi_peny_peralatan" name="a_penyesuaian_k_akumulasi_peny_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Akumulasi Peny. Peralatan" inputmode="numeric" value="{{ old('a_penyesuaian_k_akumulasi_peny_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Ymh. Diterima <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_pendapatan_ymh_diterima" id="a_penyesuaian_k_pendapatan_ymh_diterima" name="a_penyesuaian_k_pendapatan_ymh_diterima" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Ymh. Diterima" inputmode="numeric" value="{{ old('a_penyesuaian_k_pendapatan_ymh_diterima') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_simpanan_manasuka_pkpri" id="a_penyesuaian_k_simpanan_manasuka_pkpri" name="a_penyesuaian_k_simpanan_manasuka_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka PKPRI" inputmode="numeric" value="{{ old('a_penyesuaian_k_simpanan_manasuka_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan di PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_tabungan_di_pkpri" id="a_penyesuaian_k_tabungan_di_pkpri" name="a_penyesuaian_k_tabungan_di_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan di PKPRI" inputmode="numeric" value="{{ old('a_penyesuaian_k_tabungan_di_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_simpanan_pokok_pkpri" id="a_penyesuaian_k_simpanan_pokok_pkpri" name="a_penyesuaian_k_simpanan_pokok_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok PKPRI" inputmode="numeric" value="{{ old('a_penyesuaian_k_simpanan_pokok_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_simpanan_wajib_pkpri" id="a_penyesuaian_k_simpanan_wajib_pkpri" name="a_penyesuaian_k_simpanan_wajib_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib PKPRI" inputmode="numeric" value="{{ old('a_penyesuaian_k_simpanan_wajib_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_simp_khusus_pkpri" id="a_penyesuaian_k_simp_khusus_pkpri" name="a_penyesuaian_k_simp_khusus_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus PKPRI" inputmode="numeric" value="{{ old('a_penyesuaian_k_simp_khusus_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_simp_khusus_swp" id="a_penyesuaian_k_simp_khusus_swp" name="a_penyesuaian_k_simp_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('a_penyesuaian_k_simp_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SKPB <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_skpb" id="a_penyesuaian_k_skpb" name="a_penyesuaian_k_skpb" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('a_penyesuaian_k_skpb') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di Hotel PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_penyertaan_di_hotel_pkpri" id="a_penyesuaian_k_penyertaan_di_hotel_pkpri" name="a_penyesuaian_k_penyertaan_di_hotel_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di Hotel PKPRI" inputmode="numeric" value="{{ old('a_penyesuaian_k_penyertaan_di_hotel_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di KOPEN <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_penyertaan_di_kopen" id="a_penyesuaian_k_penyertaan_di_kopen" name="a_penyesuaian_k_penyertaan_di_kopen" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('a_penyesuaian_k_penyertaan_di_kopen') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_penyertaan_unit_konsumsi" id="a_penyesuaian_k_penyertaan_unit_konsumsi" name="a_penyesuaian_k_penyertaan_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('a_penyesuaian_k_penyertaan_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_tanah" id="a_penyesuaian_k_tanah" name="a_penyesuaian_k_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tanah" inputmode="numeric" value="{{ old('a_penyesuaian_k_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kewajiban Titipan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_kewajiban_titipan" id="a_penyesuaian_k_kewajiban_titipan" name="a_penyesuaian_k_kewajiban_titipan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kewajiban Titipan" inputmode="numeric" value="{{ old('a_penyesuaian_k_kewajiban_titipan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Biaya yang Masih Harus Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_biaya_yang_masih_harus_dibayar" id="a_penyesuaian_k_biaya_yang_masih_harus_dibayar" name="a_penyesuaian_k_biaya_yang_masih_harus_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Biaya yang Masih Harus Dibayar" inputmode="numeric" value="{{ old('a_penyesuaian_k_biaya_yang_masih_harus_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Partisipasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_jasa_partisipasi" id="a_penyesuaian_k_jasa_partisipasi" name="a_penyesuaian_k_jasa_partisipasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Partisipasi" inputmode="numeric" value="{{ old('a_penyesuaian_k_jasa_partisipasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pengurus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_dana_pengurus" id="a_penyesuaian_k_dana_pengurus" name="a_penyesuaian_k_dana_pengurus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pengurus" inputmode="numeric" value="{{ old('a_penyesuaian_k_dana_pengurus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Karyawan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_dana_karyawan" id="a_penyesuaian_k_dana_karyawan" name="a_penyesuaian_k_dana_karyawan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Karyawan" inputmode="numeric" value="{{ old('a_penyesuaian_k_dana_karyawan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pendidikan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_dana_pendidikan" id="a_penyesuaian_k_dana_pendidikan" name="a_penyesuaian_k_dana_pendidikan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pendidikan" inputmode="numeric" value="{{ old('a_penyesuaian_k_dana_pendidikan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Sosial <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_dana_sosial" id="a_penyesuaian_k_dana_sosial" name="a_penyesuaian_k_dana_sosial" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Sosial" inputmode="numeric" value="{{ old('a_penyesuaian_k_dana_sosial') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Utang ke PKPRI/BNI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_utang_ke_pkpri_atau_bni" id="a_penyesuaian_k_utang_ke_pkpri_atau_bni" name="a_penyesuaian_k_utang_ke_pkpri_atau_bni" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Utang ke PKPRI/BNI" inputmode="numeric" value="{{ old('a_penyesuaian_k_utang_ke_pkpri_atau_bni') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan Qurban <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_tabungan_qurban" id="a_penyesuaian_k_tabungan_qurban" name="a_penyesuaian_k_tabungan_qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan Qurban" inputmode="numeric" value="{{ old('a_penyesuaian_k_tabungan_qurban') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_simpanan_khusus_swp" id="a_penyesuaian_k_simpanan_khusus_swp" name="a_penyesuaian_k_simpanan_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Khusus SWP" inputmode="numeric" value="{{ old('a_penyesuaian_k_simpanan_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_simpanan_manasuka" id="a_penyesuaian_k_simpanan_manasuka" name="a_penyesuaian_k_simpanan_manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka" inputmode="numeric" value="{{ old('a_penyesuaian_k_simpanan_manasuka') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Donasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_donasi" id="a_penyesuaian_k_donasi" name="a_penyesuaian_k_donasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Donasi" inputmode="numeric" value="{{ old('a_penyesuaian_k_donasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_simpanan_pokok_anggota" id="a_penyesuaian_k_simpanan_pokok_anggota" name="a_penyesuaian_k_simpanan_pokok_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok Anggota" inputmode="numeric" value="{{ old('a_penyesuaian_k_simpanan_pokok_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_simpanan_wajib_anggota" id="a_penyesuaian_k_simpanan_wajib_anggota" name="a_penyesuaian_k_simpanan_wajib_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib Anggota" inputmode="numeric" value="{{ old('a_penyesuaian_k_simpanan_wajib_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Cadangan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_cadangan" id="a_penyesuaian_k_cadangan" name="a_penyesuaian_k_cadangan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Cadangan" inputmode="numeric" value="{{ old('a_penyesuaian_k_cadangan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SHU <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_shu" id="a_penyesuaian_k_shu" name="a_penyesuaian_k_shu" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal SHU" inputmode="numeric" value="{{ old('a_penyesuaian_k_shu') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa dari Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_jasa_dari_anggota" id="a_penyesuaian_k_jasa_dari_anggota" name="a_penyesuaian_k_jasa_dari_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa dari Anggota" inputmode="numeric" value="{{ old('a_penyesuaian_k_jasa_dari_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Administrasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_jasa_administrasi" id="a_penyesuaian_k_jasa_administrasi" name="a_penyesuaian_k_jasa_administrasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Administrasi" inputmode="numeric" value="{{ old('a_penyesuaian_k_jasa_administrasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pembelian <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_pembelian" id="a_penyesuaian_k_pembelian" name="a_penyesuaian_k_pembelian" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pembelian" inputmode="numeric" value="{{ old('a_penyesuaian_k_pembelian') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_penjualan" id="a_penyesuaian_k_penjualan" name="a_penyesuaian_k_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penjualan" inputmode="numeric" value="{{ old('a_penyesuaian_k_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    HPP Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_hpp_penjualan" id="a_penyesuaian_k_hpp_penjualan" name="a_penyesuaian_k_hpp_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal HPP Penjualan" inputmode="numeric" value="{{ old('a_penyesuaian_k_hpp_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Organisasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_beban_organisasi" id="a_penyesuaian_k_beban_organisasi" name="a_penyesuaian_k_beban_organisasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Organisasi" inputmode="numeric" value="{{ old('a_penyesuaian_k_beban_organisasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Operasional <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_beban_operasional" id="a_penyesuaian_k_beban_operasional" name="a_penyesuaian_k_beban_operasional" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Operasional" inputmode="numeric" value="{{ old('a_penyesuaian_k_beban_operasional') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Umum <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_beban_umum" id="a_penyesuaian_k_beban_umum" name="a_penyesuaian_k_beban_umum" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Umum" inputmode="numeric" value="{{ old('a_penyesuaian_k_beban_umum') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_beban_lain_lain" id="a_penyesuaian_k_beban_lain_lain" name="a_penyesuaian_k_beban_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Lain-lain" inputmode="numeric" value="{{ old('a_penyesuaian_k_beban_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_jasa_unit_konsumsi" id="a_penyesuaian_k_jasa_unit_konsumsi" name="a_penyesuaian_k_jasa_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Unit Konsumsi" inputmode="numeric" value="{{ old('a_penyesuaian_k_jasa_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_pendapatan_lain_lain" id="a_penyesuaian_k_pendapatan_lain_lain" name="a_penyesuaian_k_pendapatan_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Lain-lain" inputmode="numeric" value="{{ old('a_penyesuaian_k_pendapatan_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Tanah Kavling <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_pendapatan_tanah_kavling" id="a_penyesuaian_k_pendapatan_tanah_kavling" name="a_penyesuaian_k_pendapatan_tanah_kavling" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Tanah Kavling" inputmode="numeric" value="{{ old('a_penyesuaian_k_pendapatan_tanah_kavling') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Khusus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_piutang_khusus" id="a_penyesuaian_k_piutang_khusus" name="a_penyesuaian_k_piutang_khusus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Khusus" inputmode="numeric" value="{{ old('a_penyesuaian_k_piutang_khusus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Pajak belum Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_beban_pajak_belum_dibayar" id="a_penyesuaian_k_beban_pajak_belum_dibayar" name="a_penyesuaian_k_beban_pajak_belum_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Pajak belum Dibayar" inputmode="numeric" value="{{ old('a_penyesuaian_k_beban_pajak_belum_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pajak <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_pajak" id="a_penyesuaian_k_pajak" name="a_penyesuaian_k_pajak" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pajak" inputmode="numeric" value="{{ old('a_penyesuaian_k_pajak') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Simp. Mana suka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="a_penyesuaian_k_jasa_simp_mana_suka" id="a_penyesuaian_k_jasa_simp_mana_suka" name="a_penyesuaian_k_jasa_simp_mana_suka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Simp. Mana suka" inputmode="numeric" value="{{ old('a_penyesuaian_k_jasa_simp_mana_suka') }}" required/>
                            </div>
                        </div>
                        <hr class="mt-4 my-2 border-t-[1px] border-green-800 opacity-20">
                        <div class="mt-4">
                            <label class="block mb-1 text-sm font-medium text-gray-900">Jumlah</label>
                            <input type="text" wire:model="a_penyesuaian_k" id="a_penyesuaian_k" name="" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Jumlah" inputmode="numeric" value="" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Rugi dan Laba (D) --}}
            <div class="rounded-lg">
                <h2 id="accordion-collapse-heading-rugi-dan-laba-d">
                    <button wire:ignore.self type="button" 
                        class="flex items-center justify-between w-full p-2 font-medium text-left text-gray-900 border border-gray-200 transition-all duration-200" 
                        data-accordion-target="#accordion-collapse-body-rugi-dan-laba-d" 
                        aria-expanded="false" 
                        aria-controls="accordion-collapse-body-rugi-dan-laba-d">
                        <span class="flex items-center text-sm text-gray-900">
                            Rugi dan Laba (D)
                        </span>
                        <div wire:ignore class="pr-0.5">
                            <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                </h2>
                <div wire:ignore.self id="accordion-collapse-body-rugi-dan-laba-d" class="hidden" aria-labelledby="accordion-collapse-heading-rugi-dan-laba-d">
                    <div class="p-5 border border-t-0 border-gray-200 bg-white">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kas <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_kas" id="rugi_dan_laba_d_kas" name="rugi_dan_laba_d_kas" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kas" inputmode="numeric" value="{{ old('rugi_dan_laba_d_kas') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Bank <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_bank" id="rugi_dan_laba_d_bank" name="rugi_dan_laba_d_bank" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Bank" inputmode="numeric" value="{{ old('rugi_dan_laba_d_bank') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_piutang" id="rugi_dan_laba_d_piutang" name="rugi_dan_laba_d_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang" inputmode="numeric" value="{{ old('rugi_dan_laba_d_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_piutang_tanah" id="rugi_dan_laba_d_piutang_tanah" name="rugi_dan_laba_d_piutang_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Tanah" inputmode="numeric" value="{{ old('rugi_dan_laba_d_piutang_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Lain Pada Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_piutang_lain_pada_anggota" id="rugi_dan_laba_d_piutang_lain_pada_anggota" name="rugi_dan_laba_d_piutang_lain_pada_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Lain Pada Anggota" inputmode="numeric" value="{{ old('rugi_dan_laba_d_piutang_lain_pada_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyisihan Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_penyisihan_piutang" id="rugi_dan_laba_d_penyisihan_piutang" name="rugi_dan_laba_d_penyisihan_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penyisihan Piutang" inputmode="numeric" value="{{ old('rugi_dan_laba_d_penyisihan_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_piutang_barang" id="rugi_dan_laba_d_piutang_barang" name="rugi_dan_laba_d_piutang_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Barang" inputmode="numeric" value="{{ old('rugi_dan_laba_d_piutang_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_persediaan_barang" id="rugi_dan_laba_d_persediaan_barang" name="rugi_dan_laba_d_persediaan_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Barang" inputmode="numeric" value="{{ old('rugi_dan_laba_d_persediaan_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_persediaan_peralatan" id="rugi_dan_laba_d_persediaan_peralatan" name="rugi_dan_laba_d_persediaan_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Peralatan" inputmode="numeric" value="{{ old('rugi_dan_laba_d_persediaan_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Akumulasi Peny. Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_akumulasi_peny_peralatan" id="rugi_dan_laba_d_akumulasi_peny_peralatan" name="rugi_dan_laba_d_akumulasi_peny_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Akumulasi Peny. Peralatan" inputmode="numeric" value="{{ old('rugi_dan_laba_d_akumulasi_peny_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Ymh. Diterima <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_pendapatan_ymh_diterima" id="rugi_dan_laba_d_pendapatan_ymh_diterima" name="rugi_dan_laba_d_pendapatan_ymh_diterima" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Ymh. Diterima" inputmode="numeric" value="{{ old('rugi_dan_laba_d_pendapatan_ymh_diterima') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_simpanan_manasuka_pkpri" id="rugi_dan_laba_d_simpanan_manasuka_pkpri" name="rugi_dan_laba_d_simpanan_manasuka_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka PKPRI" inputmode="numeric" value="{{ old('rugi_dan_laba_d_simpanan_manasuka_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan di PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_tabungan_di_pkpri" id="rugi_dan_laba_d_tabungan_di_pkpri" name="rugi_dan_laba_d_tabungan_di_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan di PKPRI" inputmode="numeric" value="{{ old('rugi_dan_laba_d_tabungan_di_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_simpanan_pokok_pkpri" id="rugi_dan_laba_d_simpanan_pokok_pkpri" name="rugi_dan_laba_d_simpanan_pokok_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok PKPRI" inputmode="numeric" value="{{ old('rugi_dan_laba_d_simpanan_pokok_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_simpanan_wajib_pkpri" id="rugi_dan_laba_d_simpanan_wajib_pkpri" name="rugi_dan_laba_d_simpanan_wajib_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib PKPRI" inputmode="numeric" value="{{ old('rugi_dan_laba_d_simpanan_wajib_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_simp_khusus_pkpri" id="rugi_dan_laba_d_simp_khusus_pkpri" name="rugi_dan_laba_d_simp_khusus_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus PKPRI" inputmode="numeric" value="{{ old('rugi_dan_laba_d_simp_khusus_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_simp_khusus_swp" id="rugi_dan_laba_d_simp_khusus_swp" name="rugi_dan_laba_d_simp_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('rugi_dan_laba_d_simp_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SKPB <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_skpb" id="rugi_dan_laba_d_skpb" name="rugi_dan_laba_d_skpb" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('rugi_dan_laba_d_skpb') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di Hotel PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_penyertaan_di_hotel_pkpri" id="rugi_dan_laba_d_penyertaan_di_hotel_pkpri" name="rugi_dan_laba_d_penyertaan_di_hotel_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di Hotel PKPRI" inputmode="numeric" value="{{ old('rugi_dan_laba_d_penyertaan_di_hotel_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di KOPEN <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_penyertaan_di_kopen" id="rugi_dan_laba_d_penyertaan_di_kopen" name="rugi_dan_laba_d_penyertaan_di_kopen" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('rugi_dan_laba_d_penyertaan_di_kopen') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_penyertaan_unit_konsumsi" id="rugi_dan_laba_d_penyertaan_unit_konsumsi" name="rugi_dan_laba_d_penyertaan_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('rugi_dan_laba_d_penyertaan_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_tanah" id="rugi_dan_laba_d_tanah" name="rugi_dan_laba_d_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tanah" inputmode="numeric" value="{{ old('rugi_dan_laba_d_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kewajiban Titipan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_kewajiban_titipan" id="rugi_dan_laba_d_kewajiban_titipan" name="rugi_dan_laba_d_kewajiban_titipan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kewajiban Titipan" inputmode="numeric" value="{{ old('rugi_dan_laba_d_kewajiban_titipan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Biaya yang Masih Harus Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_biaya_yang_masih_harus_dibayar" id="rugi_dan_laba_d_biaya_yang_masih_harus_dibayar" name="rugi_dan_laba_d_biaya_yang_masih_harus_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Biaya yang Masih Harus Dibayar" inputmode="numeric" value="{{ old('rugi_dan_laba_d_biaya_yang_masih_harus_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Partisipasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_jasa_partisipasi" id="rugi_dan_laba_d_jasa_partisipasi" name="rugi_dan_laba_d_jasa_partisipasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Partisipasi" inputmode="numeric" value="{{ old('rugi_dan_laba_d_jasa_partisipasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pengurus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_dana_pengurus" id="rugi_dan_laba_d_dana_pengurus" name="rugi_dan_laba_d_dana_pengurus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pengurus" inputmode="numeric" value="{{ old('rugi_dan_laba_d_dana_pengurus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Karyawan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_dana_karyawan" id="rugi_dan_laba_d_dana_karyawan" name="rugi_dan_laba_d_dana_karyawan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Karyawan" inputmode="numeric" value="{{ old('rugi_dan_laba_d_dana_karyawan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pendidikan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_dana_pendidikan" id="rugi_dan_laba_d_dana_pendidikan" name="rugi_dan_laba_d_dana_pendidikan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pendidikan" inputmode="numeric" value="{{ old('rugi_dan_laba_d_dana_pendidikan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Sosial <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_dana_sosial" id="rugi_dan_laba_d_dana_sosial" name="rugi_dan_laba_d_dana_sosial" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Sosial" inputmode="numeric" value="{{ old('rugi_dan_laba_d_dana_sosial') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Utang ke PKPRI/BNI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_utang_ke_pkpri_atau_bni" id="rugi_dan_laba_d_utang_ke_pkpri_atau_bni" name="rugi_dan_laba_d_utang_ke_pkpri_atau_bni" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Utang ke PKPRI/BNI" inputmode="numeric" value="{{ old('rugi_dan_laba_d_utang_ke_pkpri_atau_bni') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan Qurban <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_tabungan_qurban" id="rugi_dan_laba_d_tabungan_qurban" name="rugi_dan_laba_d_tabungan_qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan Qurban" inputmode="numeric" value="{{ old('rugi_dan_laba_d_tabungan_qurban') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_simpanan_khusus_swp" id="rugi_dan_laba_d_simpanan_khusus_swp" name="rugi_dan_laba_d_simpanan_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Khusus SWP" inputmode="numeric" value="{{ old('rugi_dan_laba_d_simpanan_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_simpanan_manasuka" id="rugi_dan_laba_d_simpanan_manasuka" name="rugi_dan_laba_d_simpanan_manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka" inputmode="numeric" value="{{ old('rugi_dan_laba_d_simpanan_manasuka') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Donasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_donasi" id="rugi_dan_laba_d_donasi" name="rugi_dan_laba_d_donasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Donasi" inputmode="numeric" value="{{ old('rugi_dan_laba_d_donasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_simpanan_pokok_anggota" id="rugi_dan_laba_d_simpanan_pokok_anggota" name="rugi_dan_laba_d_simpanan_pokok_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok Anggota" inputmode="numeric" value="{{ old('rugi_dan_laba_d_simpanan_pokok_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_simpanan_wajib_anggota" id="rugi_dan_laba_d_simpanan_wajib_anggota" name="rugi_dan_laba_d_simpanan_wajib_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib Anggota" inputmode="numeric" value="{{ old('rugi_dan_laba_d_simpanan_wajib_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Cadangan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_cadangan" id="rugi_dan_laba_d_cadangan" name="rugi_dan_laba_d_cadangan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Cadangan" inputmode="numeric" value="{{ old('rugi_dan_laba_d_cadangan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SHU <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_shu" id="rugi_dan_laba_d_shu" name="rugi_dan_laba_d_shu" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal SHU" inputmode="numeric" value="{{ old('rugi_dan_laba_d_shu') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa dari Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_jasa_dari_anggota" id="rugi_dan_laba_d_jasa_dari_anggota" name="rugi_dan_laba_d_jasa_dari_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa dari Anggota" inputmode="numeric" value="{{ old('rugi_dan_laba_d_jasa_dari_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Administrasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_jasa_administrasi" id="rugi_dan_laba_d_jasa_administrasi" name="rugi_dan_laba_d_jasa_administrasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Administrasi" inputmode="numeric" value="{{ old('rugi_dan_laba_d_jasa_administrasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pembelian <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_pembelian" id="rugi_dan_laba_d_pembelian" name="rugi_dan_laba_d_pembelian" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pembelian" inputmode="numeric" value="{{ old('rugi_dan_laba_d_pembelian') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_penjualan" id="rugi_dan_laba_d_penjualan" name="rugi_dan_laba_d_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penjualan" inputmode="numeric" value="{{ old('rugi_dan_laba_d_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    HPP Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_hpp_penjualan" id="rugi_dan_laba_d_hpp_penjualan" name="rugi_dan_laba_d_hpp_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal HPP Penjualan" inputmode="numeric" value="{{ old('rugi_dan_laba_d_hpp_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Organisasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_beban_organisasi" id="rugi_dan_laba_d_beban_organisasi" name="rugi_dan_laba_d_beban_organisasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Organisasi" inputmode="numeric" value="{{ old('rugi_dan_laba_d_beban_organisasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Operasional <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_beban_operasional" id="rugi_dan_laba_d_beban_operasional" name="rugi_dan_laba_d_beban_operasional" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Operasional" inputmode="numeric" value="{{ old('rugi_dan_laba_d_beban_operasional') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Umum <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_beban_umum" id="rugi_dan_laba_d_beban_umum" name="rugi_dan_laba_d_beban_umum" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Umum" inputmode="numeric" value="{{ old('rugi_dan_laba_d_beban_umum') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_beban_lain_lain" id="rugi_dan_laba_d_beban_lain_lain" name="rugi_dan_laba_d_beban_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Lain-lain" inputmode="numeric" value="{{ old('rugi_dan_laba_d_beban_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_jasa_unit_konsumsi" id="rugi_dan_laba_d_jasa_unit_konsumsi" name="rugi_dan_laba_d_jasa_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Unit Konsumsi" inputmode="numeric" value="{{ old('rugi_dan_laba_d_jasa_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_pendapatan_lain_lain" id="rugi_dan_laba_d_pendapatan_lain_lain" name="rugi_dan_laba_d_pendapatan_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Lain-lain" inputmode="numeric" value="{{ old('rugi_dan_laba_d_pendapatan_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Tanah Kavling <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_pendapatan_tanah_kavling" id="rugi_dan_laba_d_pendapatan_tanah_kavling" name="rugi_dan_laba_d_pendapatan_tanah_kavling" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Tanah Kavling" inputmode="numeric" value="{{ old('rugi_dan_laba_d_pendapatan_tanah_kavling') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Khusus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_piutang_khusus" id="rugi_dan_laba_d_piutang_khusus" name="rugi_dan_laba_d_piutang_khusus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Khusus" inputmode="numeric" value="{{ old('rugi_dan_laba_d_piutang_khusus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Pajak belum Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_beban_pajak_belum_dibayar" id="rugi_dan_laba_d_beban_pajak_belum_dibayar" name="rugi_dan_laba_d_beban_pajak_belum_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Pajak belum Dibayar" inputmode="numeric" value="{{ old('rugi_dan_laba_d_beban_pajak_belum_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pajak <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_pajak" id="rugi_dan_laba_d_pajak" name="rugi_dan_laba_d_pajak" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pajak" inputmode="numeric" value="{{ old('rugi_dan_laba_d_pajak') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Simp. Mana suka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_d_jasa_simp_mana_suka" id="rugi_dan_laba_d_jasa_simp_mana_suka" name="rugi_dan_laba_d_jasa_simp_mana_suka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Simp. Mana suka" inputmode="numeric" value="{{ old('rugi_dan_laba_d_jasa_simp_mana_suka') }}" required/>
                            </div>
                        </div>
                        <hr class="mt-4 my-2 border-t-[1px] border-green-800 opacity-20">
                        <div class="mt-4">
                            <label class="block mb-1 text-sm font-medium text-gray-900">Jumlah</label>
                            <input type="text" wire:model="rugi_dan_laba_d" id="rugi_dan_laba_d" name="" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Jumlah" inputmode="numeric" value="" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Rugi dan Laba (K) --}}
            <div class="rounded-lg">
                <h2 id="accordion-collapse-heading-rugi-dan-laba-k">
                    <button wire:ignore.self type="button" 
                        class="flex items-center justify-between w-full p-2 font-medium text-left text-gray-900 border border-gray-200 transition-all duration-200" 
                        data-accordion-target="#accordion-collapse-body-rugi-dan-laba-k" 
                        aria-expanded="false" 
                        aria-controls="accordion-collapse-body-rugi-dan-laba-k">
                        <span class="flex items-center text-sm text-gray-900">
                            Rugi dan Laba (K)
                        </span>
                        <div wire:ignore class="pr-0.5">
                            <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform duration-200 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                </h2>
                <div wire:ignore.self id="accordion-collapse-body-rugi-dan-laba-k" class="hidden" aria-labelledby="accordion-collapse-heading-rugi-dan-laba-k">
                    <div class="p-5 border border-t-0 border-gray-200 bg-white">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kas <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_kas" id="rugi_dan_laba_k_kas" name="rugi_dan_laba_k_kas" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kas" inputmode="numeric" value="{{ old('rugi_dan_laba_k_kas') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Bank <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_bank" id="rugi_dan_laba_k_bank" name="rugi_dan_laba_k_bank" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Bank" inputmode="numeric" value="{{ old('rugi_dan_laba_k_bank') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_piutang" id="rugi_dan_laba_k_piutang" name="rugi_dan_laba_k_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang" inputmode="numeric" value="{{ old('rugi_dan_laba_k_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_piutang_tanah" id="rugi_dan_laba_k_piutang_tanah" name="rugi_dan_laba_k_piutang_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Tanah" inputmode="numeric" value="{{ old('rugi_dan_laba_k_piutang_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Lain Pada Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_piutang_lain_pada_anggota" id="rugi_dan_laba_k_piutang_lain_pada_anggota" name="rugi_dan_laba_k_piutang_lain_pada_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Lain Pada Anggota" inputmode="numeric" value="{{ old('rugi_dan_laba_k_piutang_lain_pada_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyisihan Piutang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_penyisihan_piutang" id="rugi_dan_laba_k_penyisihan_piutang" name="rugi_dan_laba_k_penyisihan_piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penyisihan Piutang" inputmode="numeric" value="{{ old('rugi_dan_laba_k_penyisihan_piutang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_piutang_barang" id="rugi_dan_laba_k_piutang_barang" name="rugi_dan_laba_k_piutang_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Barang" inputmode="numeric" value="{{ old('rugi_dan_laba_k_piutang_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_persediaan_barang" id="rugi_dan_laba_k_persediaan_barang" name="rugi_dan_laba_k_persediaan_barang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Barang" inputmode="numeric" value="{{ old('rugi_dan_laba_k_persediaan_barang') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Persediaan Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_persediaan_peralatan" id="rugi_dan_laba_k_persediaan_peralatan" name="rugi_dan_laba_k_persediaan_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Persediaan Peralatan" inputmode="numeric" value="{{ old('rugi_dan_laba_k_persediaan_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Akumulasi Peny. Peralatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_akumulasi_peny_peralatan" id="rugi_dan_laba_k_akumulasi_peny_peralatan" name="rugi_dan_laba_k_akumulasi_peny_peralatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Akumulasi Peny. Peralatan" inputmode="numeric" value="{{ old('rugi_dan_laba_k_akumulasi_peny_peralatan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Ymh. Diterima <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_pendapatan_ymh_diterima" id="rugi_dan_laba_k_pendapatan_ymh_diterima" name="rugi_dan_laba_k_pendapatan_ymh_diterima" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Ymh. Diterima" inputmode="numeric" value="{{ old('rugi_dan_laba_k_pendapatan_ymh_diterima') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_simpanan_manasuka_pkpri" id="rugi_dan_laba_k_simpanan_manasuka_pkpri" name="rugi_dan_laba_k_simpanan_manasuka_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka PKPRI" inputmode="numeric" value="{{ old('rugi_dan_laba_k_simpanan_manasuka_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan di PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_tabungan_di_pkpri" id="rugi_dan_laba_k_tabungan_di_pkpri" name="rugi_dan_laba_k_tabungan_di_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan di PKPRI" inputmode="numeric" value="{{ old('rugi_dan_laba_k_tabungan_di_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_simpanan_pokok_pkpri" id="rugi_dan_laba_k_simpanan_pokok_pkpri" name="rugi_dan_laba_k_simpanan_pokok_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok PKPRI" inputmode="numeric" value="{{ old('rugi_dan_laba_k_simpanan_pokok_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_simpanan_wajib_pkpri" id="rugi_dan_laba_k_simpanan_wajib_pkpri" name="rugi_dan_laba_k_simpanan_wajib_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib PKPRI" inputmode="numeric" value="{{ old('rugi_dan_laba_k_simpanan_wajib_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_simp_khusus_pkpri" id="rugi_dan_laba_k_simp_khusus_pkpri" name="rugi_dan_laba_k_simp_khusus_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus PKPRI" inputmode="numeric" value="{{ old('rugi_dan_laba_k_simp_khusus_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simp Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_simp_khusus_swp" id="rugi_dan_laba_k_simp_khusus_swp" name="rugi_dan_laba_k_simp_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('rugi_dan_laba_k_simp_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SKPB <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_skpb" id="rugi_dan_laba_k_skpb" name="rugi_dan_laba_k_skpb" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simp Khusus SWP" inputmode="numeric" value="{{ old('rugi_dan_laba_k_skpb') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di Hotel PKPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_penyertaan_di_hotel_pkpri" id="rugi_dan_laba_k_penyertaan_di_hotel_pkpri" name="rugi_dan_laba_k_penyertaan_di_hotel_pkpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di Hotel PKPRI" inputmode="numeric" value="{{ old('rugi_dan_laba_k_penyertaan_di_hotel_pkpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan di KOPEN <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_penyertaan_di_kopen" id="rugi_dan_laba_k_penyertaan_di_kopen" name="rugi_dan_laba_k_penyertaan_di_kopen" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('rugi_dan_laba_k_penyertaan_di_kopen') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penyertaan Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_penyertaan_unit_konsumsi" id="rugi_dan_laba_k_penyertaan_unit_konsumsi" name="rugi_dan_laba_k_penyertaan_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pernyetaan di KOPEN" inputmode="numeric" value="{{ old('rugi_dan_laba_k_penyertaan_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tanah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_tanah" id="rugi_dan_laba_k_tanah" name="rugi_dan_laba_k_tanah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tanah" inputmode="numeric" value="{{ old('rugi_dan_laba_k_tanah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Kewajiban Titipan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_kewajiban_titipan" id="rugi_dan_laba_k_kewajiban_titipan" name="rugi_dan_laba_k_kewajiban_titipan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Kewajiban Titipan" inputmode="numeric" value="{{ old('rugi_dan_laba_k_kewajiban_titipan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Biaya yang Masih Harus Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_biaya_yang_masih_harus_dibayar" id="rugi_dan_laba_k_biaya_yang_masih_harus_dibayar" name="rugi_dan_laba_k_biaya_yang_masih_harus_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Biaya yang Masih Harus Dibayar" inputmode="numeric" value="{{ old('rugi_dan_laba_k_biaya_yang_masih_harus_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Partisipasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_jasa_partisipasi" id="rugi_dan_laba_k_jasa_partisipasi" name="rugi_dan_laba_k_jasa_partisipasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Partisipasi" inputmode="numeric" value="{{ old('rugi_dan_laba_k_jasa_partisipasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pengurus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_dana_pengurus" id="rugi_dan_laba_k_dana_pengurus" name="rugi_dan_laba_k_dana_pengurus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pengurus" inputmode="numeric" value="{{ old('rugi_dan_laba_k_dana_pengurus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Karyawan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_dana_karyawan" id="rugi_dan_laba_k_dana_karyawan" name="rugi_dan_laba_k_dana_karyawan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Karyawan" inputmode="numeric" value="{{ old('rugi_dan_laba_k_dana_karyawan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Pendidikan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_dana_pendidikan" id="rugi_dan_laba_k_dana_pendidikan" name="rugi_dan_laba_k_dana_pendidikan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Pendidikan" inputmode="numeric" value="{{ old('rugi_dan_laba_k_dana_pendidikan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Dana Sosial <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_dana_sosial" id="rugi_dan_laba_k_dana_sosial" name="rugi_dan_laba_k_dana_sosial" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Dana Sosial" inputmode="numeric" value="{{ old('rugi_dan_laba_k_dana_sosial') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Utang ke PKPRI/BNI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_utang_ke_pkpri_atau_bni" id="rugi_dan_laba_k_utang_ke_pkpri_atau_bni" name="rugi_dan_laba_k_utang_ke_pkpri_atau_bni" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Utang ke PKPRI/BNI" inputmode="numeric" value="{{ old('rugi_dan_laba_k_utang_ke_pkpri_atau_bni') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Tabungan Qurban <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_tabungan_qurban" id="rugi_dan_laba_k_tabungan_qurban" name="rugi_dan_laba_k_tabungan_qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tabungan Qurban" inputmode="numeric" value="{{ old('rugi_dan_laba_k_tabungan_qurban') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Khusus SWP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_simpanan_khusus_swp" id="rugi_dan_laba_k_simpanan_khusus_swp" name="rugi_dan_laba_k_simpanan_khusus_swp" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Khusus SWP" inputmode="numeric" value="{{ old('rugi_dan_laba_k_simpanan_khusus_swp') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Manasuka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_simpanan_manasuka" id="rugi_dan_laba_k_simpanan_manasuka" name="rugi_dan_laba_k_simpanan_manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Manasuka" inputmode="numeric" value="{{ old('rugi_dan_laba_k_simpanan_manasuka') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Donasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_donasi" id="rugi_dan_laba_k_donasi" name="rugi_dan_laba_k_donasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Donasi" inputmode="numeric" value="{{ old('rugi_dan_laba_k_donasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Pokok Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_simpanan_pokok_anggota" id="rugi_dan_laba_k_simpanan_pokok_anggota" name="rugi_dan_laba_k_simpanan_pokok_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Pokok Anggota" inputmode="numeric" value="{{ old('rugi_dan_laba_k_simpanan_pokok_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Simpanan Wajib Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_simpanan_wajib_anggota" id="rugi_dan_laba_k_simpanan_wajib_anggota" name="rugi_dan_laba_k_simpanan_wajib_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Simpanan Wajib Anggota" inputmode="numeric" value="{{ old('rugi_dan_laba_k_simpanan_wajib_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Cadangan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_cadangan" id="rugi_dan_laba_k_cadangan" name="rugi_dan_laba_k_cadangan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Cadangan" inputmode="numeric" value="{{ old('rugi_dan_laba_k_cadangan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SHU <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_shu" id="rugi_dan_laba_k_shu" name="rugi_dan_laba_k_shu" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal SHU" inputmode="numeric" value="{{ old('rugi_dan_laba_k_shu') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa dari Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_jasa_dari_anggota" id="rugi_dan_laba_k_jasa_dari_anggota" name="rugi_dan_laba_k_jasa_dari_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa dari Anggota" inputmode="numeric" value="{{ old('rugi_dan_laba_k_jasa_dari_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Administrasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_jasa_administrasi" id="rugi_dan_laba_k_jasa_administrasi" name="rugi_dan_laba_k_jasa_administrasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Administrasi" inputmode="numeric" value="{{ old('rugi_dan_laba_k_jasa_administrasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pembelian <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_pembelian" id="rugi_dan_laba_k_pembelian" name="rugi_dan_laba_k_pembelian" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pembelian" inputmode="numeric" value="{{ old('rugi_dan_laba_k_pembelian') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_penjualan" id="rugi_dan_laba_k_penjualan" name="rugi_dan_laba_k_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Penjualan" inputmode="numeric" value="{{ old('rugi_dan_laba_k_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    HPP Penjualan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_hpp_penjualan" id="rugi_dan_laba_k_hpp_penjualan" name="rugi_dan_laba_k_hpp_penjualan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal HPP Penjualan" inputmode="numeric" value="{{ old('rugi_dan_laba_k_hpp_penjualan') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Organisasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_beban_organisasi" id="rugi_dan_laba_k_beban_organisasi" name="rugi_dan_laba_k_beban_organisasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Organisasi" inputmode="numeric" value="{{ old('rugi_dan_laba_k_beban_organisasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Operasional <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_beban_operasional" id="rugi_dan_laba_k_beban_operasional" name="rugi_dan_laba_k_beban_operasional" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Operasional" inputmode="numeric" value="{{ old('rugi_dan_laba_k_beban_operasional') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Umum <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_beban_umum" id="rugi_dan_laba_k_beban_umum" name="rugi_dan_laba_k_beban_umum" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Umum" inputmode="numeric" value="{{ old('rugi_dan_laba_k_beban_umum') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_beban_lain_lain" id="rugi_dan_laba_k_beban_lain_lain" name="rugi_dan_laba_k_beban_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Lain-lain" inputmode="numeric" value="{{ old('rugi_dan_laba_k_beban_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_jasa_unit_konsumsi" id="rugi_dan_laba_k_jasa_unit_konsumsi" name="rugi_dan_laba_k_jasa_unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Unit Konsumsi" inputmode="numeric" value="{{ old('rugi_dan_laba_k_jasa_unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Lain-lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_pendapatan_lain_lain" id="rugi_dan_laba_k_pendapatan_lain_lain" name="rugi_dan_laba_k_pendapatan_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Lain-lain" inputmode="numeric" value="{{ old('rugi_dan_laba_k_pendapatan_lain_lain') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pendapatan Tanah Kavling <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_pendapatan_tanah_kavling" id="rugi_dan_laba_k_pendapatan_tanah_kavling" name="rugi_dan_laba_k_pendapatan_tanah_kavling" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pendapatan Tanah Kavling" inputmode="numeric" value="{{ old('rugi_dan_laba_k_pendapatan_tanah_kavling') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Piutang Khusus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_piutang_khusus" id="rugi_dan_laba_k_piutang_khusus" name="rugi_dan_laba_k_piutang_khusus" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang Khusus" inputmode="numeric" value="{{ old('rugi_dan_laba_k_piutang_khusus') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Pajak belum Dibayar <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_beban_pajak_belum_dibayar" id="rugi_dan_laba_k_beban_pajak_belum_dibayar" name="rugi_dan_laba_k_beban_pajak_belum_dibayar" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Pajak belum Dibayar" inputmode="numeric" value="{{ old('rugi_dan_laba_k_beban_pajak_belum_dibayar') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Pajak <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_pajak" id="rugi_dan_laba_k_pajak" name="rugi_dan_laba_k_pajak" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pajak" inputmode="numeric" value="{{ old('rugi_dan_laba_k_pajak') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Simp. Mana suka <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="rugi_dan_laba_k_jasa_simp_mana_suka" id="rugi_dan_laba_k_jasa_simp_mana_suka" name="rugi_dan_laba_k_jasa_simp_mana_suka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Simp. Mana suka" inputmode="numeric" value="{{ old('rugi_dan_laba_k_jasa_simp_mana_suka') }}" required/>
                            </div>
                        </div>
                        <hr class="mt-4 my-2 border-t-[1px] border-green-800 opacity-20">
                        <div class="mt-4">
                            <label class="block mb-1 text-sm font-medium text-gray-900">Jumlah</label>
                            <input type="text" wire:model="rugi_dan_laba_k" id="rugi_dan_laba_k" name="" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Jumlah" inputmode="numeric" value="" readonly/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-start mt-4">
            <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md">
                Simpan
            </button>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        document.body.addEventListener("input", function (e) {
            if (e.target.classList.contains("format-rupiah")) {
                let value = e.target.value.replace(/\D/g, ""); // Hapus semua non-digit
                let formatted = new Intl.NumberFormat("id-ID").format(value);
                e.target.value = value ? `Rp ${formatted}` : "";
            }
        });
        
    </script>
@endpush
