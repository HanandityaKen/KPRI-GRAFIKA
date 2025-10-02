<div>
    {{-- Stop trying to control. --}}
    <div class="mb-8 flex justify-between items-center">
        <div class="relative w-2/3 sm:w-1/3">
            <div class="flex items-center">
                <select id="yearFilter" wire:model.change="selectedYear" class="p-2 bg-white border-2 border-[#6DA854] w-1/2 rounded-md">
                    @foreach ($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button wire:click="exportExcel" class="flex items-center px-4 py-2 bg-green-800 text-white rounded ml-4 whitespace-nowrap">
            <svg class="w-4 h-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="currentColor" d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM155.7 250.2L192 302.1l36.3-51.9c7.6-10.9 22.6-13.5 33.4-5.9s13.5 22.6 5.9 33.4L221.3 344l46.4 66.2c7.6 10.9 5 25.8-5.9 33.4s-25.8 5-33.4-5.9L192 385.8l-36.3 51.9c-7.6 10.9-22.6 13.5-33.4 5.9s-13.5-22.6-5.9-33.4L162.7 344l-46.4-66.2c-7.6-10.9-5-25.8 5.9-33.4s25.8-5 33.4 5.9z"/></svg>
            Ekspor Excel
        </button>
    </div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-center text-[#6DA854] border-r border-b border-[#6DA854]" rowspan="2">No</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Perkiraan</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" colspan="2">Jumlah</th>
                    <th class="p-3 text-center text-[#6DA854] whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">No</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-r border-b border-[#6DA854]" rowspan="2">Perkiraan</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-b border-[#6DA854]" colspan="2">Jumlah</th>
                </tr>
                <tr class="border-b border-[#6DA854]">
                    {{-- Neraca Awal --}}
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">{{ $tahunSebelumnya }}</th>
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">{{ $selectedYear }}</th>

                    {{-- Neraca --}}
                    <th class="p-3 text-center whitespace-nowrap border border-[#6DA854]">{{ $tahunSebelumnya }}</th>
                    <th class="p-3 text-center whitespace-nowrap border-l border-[#6DA854]">{{ $selectedYear }}</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] font-bold"><i>Aktiva Lancar</i></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] font-bold"><i>Kewajiban Lancar</i></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap"></td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">1</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Kas</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($kasPrev, 0, ',', '.') }}</td> <!--2023 -->
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($kasCurr, 0, ',', '.') }}</td> <!--2024 -->
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">1</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Pendapatan diterima lebih dahulu</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($pendapatanDiterimaLebihDahuluPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($pendapatanDiterimaLebihDahuluCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">2</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Bank</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($bankPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($bankCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">2</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Kewajiban Titipan</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($kewajibanTitipanPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($kewajibanTitipanCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">3</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Piutang</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($piutangPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($piutangCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">3</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Pajak YMH dibayar</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($pajakYmhDibayarPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($pajakYmhDibayarCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">4</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Persediaan Peralatan</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($persediaanPeralatanPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($persediaanPeralatanCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">4</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Jasa Partisipasi Anggota</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($jasaPartisipasiAnggotaPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($jasaPartisipasiAnggotaCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">5</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Akumulasi Penyusutan Peralatan</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($akumulasiPenyusutanPeralatanPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($akumulasiPenyusutanPeralatanCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">5</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Dana Pengurus</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($danaPengurusPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($danaPengurusCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">6</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Pendapatan YMH diterima</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($pendapatanYmhDiterimaPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($pendapatanYmhDiterimaCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">6</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Dana Karyawan</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($danaKaryawanPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($danaKaryawanCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">7</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Simp. Manasuka di PKPRI</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpManasukaDiPkpriPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpManasukaDiPkpriCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">7</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Dana Pendidikan</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($danaPendidikanPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($danaPendidikanCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">8</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Dana Sosial</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($danaSosialPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($danaSosialCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">9</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Tabungan Qurban</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($tabunganQurbanPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($tabunganQurbanCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">10</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Simp. Manasuka Anggota</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpManasukaAnggotaPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpManasukaAnggotaCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">11</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Simp. Wajib Pinjam anggota</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpWajibPinjamAnggotaPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpWajibPinjamAnggotaCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap font-bold">Jumlah</td>
                    <td class="p-3 border border-[#6DA854] text-right font-bold whitespace-nowrap">{{ number_format($jumlahAktivaLancarPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right font-bold whitespace-nowrap">{{ number_format($jumlahAktivaLancarCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap font-bold">Jumlah</td>
                    <td class="p-3 border border-[#6DA854] text-right font-bold whitespace-nowrap">{{ number_format($jumlahKewajibanLancarPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right font-bold whitespace-nowrap">{{ number_format($jumlahKewajibanLancarCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap font-bold"><i>Penyertaan</i></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap font-bold"><i>Kekayaan</i></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap"></td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">10</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Tabungan di PKPRI</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($tabunganDiPkpriPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($tabunganDiPkpriCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">12</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Donasi</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($donasiPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($donasiCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">11</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Simp. Pokok di PKPRI</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpPokokDiPkpriPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpPokokDiPkpriCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">13</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Simp. Pokok anggota</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpPokokAnggotaPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpPokokAnggotaCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">12</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Sip. Wajib di PKPRI</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($sipWajibDiPkpriPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($sipWajibDiPkpriCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">14</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Simp. Wajib Anggota</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpWajibAnggotaPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpWajibAnggotaCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">13</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Simp. Khusus di PKPRI</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpKhususDiPkpriPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpKhususDiPkpriCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">15</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Cadangan</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($cadanganPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($cadanganCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">14</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Simpanan Wajib Pinjam di PKPRI</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpWajibPinjamDiPkpriPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($simpWajibPinjamDiPkpriCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">16</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">SHU</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($shuPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap">{{ number_format($shuCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">15</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">SKPB</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($skpbPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($skpbCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap"></td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">16</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Penyertaan di Hotel PKPRI</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($penyertaanDiHotelPkpriPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($penyertaanDiHotelPkpriCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap"></td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">16</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Penyertaan di Kopen</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($penyertaanDiKopenPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($penyertaanDiKopenCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap"></td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">17</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Penyertaan Unit Konsumsi</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($penyertaanDiUnitKonsumsiPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($penyertaanDiUnitKonsumsiCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap"></td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap font-bold">Jumlah</td>
                    <td class="p-3 border border-[#6DA854] text-right font-bold text-bold whitespace-nowrap">{{ number_format($jumlahPenyertaanPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right font-bold text-bold whitespace-nowrap">{{ number_format($jumlahPenyertaanCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap font-bold">Jumlah</td>
                    <td class="p-3 border border-[#6DA854] text-right font-bold text-bold whitespace-nowrap">{{ number_format($jumlahKekayaanPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right font-bold text-bold whitespace-nowrap">{{ number_format($jumlahKekayaanCurr, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap font-bold"><i>Aktiva Tetap</i></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap"></td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center">19</td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap">Tanah</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($tanahPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap">{{ number_format($tanahCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap"></td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap"></td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap"></td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap font-bold">Jumlah Total</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap font-bold">{{ number_format($jumlahTotalKiriPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap font-bold">{{ number_format($jumlahTotalKiriCurr, 0, ',', '.') }}</td>
                    <td class="p-3 border-r border-b border-[#6DA854] text-center"></td>
                    <td class="p-3 border border-[#6DA854] whitespace-nowrap font-bold">Jumlah Total</td>
                    <td class="p-3 border border-[#6DA854] text-right whitespace-nowrap font-bold">{{ number_format($jumlahTotalKananPrev, 0, ',', '.') }}</td>
                    <td class="p-3 border-l border-t border-b border-[#6DA854] text-right whitespace-nowrap font-bold">{{ number_format($jumlahTotalKananCurr, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
