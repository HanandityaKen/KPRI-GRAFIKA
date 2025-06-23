<div>
    <div class="mb-8 flex justify-between items-center">
        <div class="relative w-1/3">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" wire:model.live="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500" placeholder="Search">
        </div>
    </div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="p-3 text-left text-[#6DA854]" rowspan="2">No</th>
                    <th class="p-3 text-left whitespace-nowrap" rowspan="2">Uraian</th>
                    <th class="p-3 text-left whitespace-nowrap" rowspan="2">Tanggal</th>
                    <th class="p-3 text-center whitespace-nowrap" rowspan="2">Angsuran</th>
                    <th class="p-3 text-center whitespace-nowrap" rowspan="2">Pokok</th>
                    <th class="p-3 text-center whitespace-nowrap" rowspan="2">Wajib</th>
                    <th class="p-3 text-center whitespace-nowrap" rowspan="2">M.Suka</th>
                    <th class="p-3 text-center whitespace-nowrap" rowspan="2">SWP</th>
                    <th class="p-3 text-center whitespace-nowrap" rowspan="2">Qurban</th>
                    <th class="p-3 text-center whitespace-nowrap" rowspan="2">Lain-Lain</th>
                    <th class="p-3 text-center whitespace-nowrap" rowspan="2">Piutang</th>
                    <th class="p-3 text-center whitespace-nowrap" rowspan="2">Hutang</th>
            
                    <!-- Header Gabungan -->
                    <th class="p-3 text-center whitespace-nowrap" colspan="5">Beban Umum</th>
                    <th class="p-3 text-center whitespace-nowrap" colspan="4">Beban Organisasi</th>
                    <th class="p-3 text-center whitespace-nowrap" colspan="2">Beban Operasional</th>
                    <th class="p-3 text-center whitespace-nowrap" colspan="7">Beban Lain</th>
            
                    <th class="p-3 text-center whitespace-nowrap" rowspan="2">Tanah Kavling</th>
                    <th class="p-3 text-center whitespace-nowrap" rowspan="2">Jumlah</th>
                </tr>
                <tr>
                    <!-- Beban Umum -->
                    <th class="p-3 text-center whitespace-nowrap">Hari Lembur</th>
                    <th class="p-3 text-center whitespace-nowrap">Perjalanan Pengawas</th>
                    <th class="p-3 text-center whitespace-nowrap">THR</th>
                    <th class="p-3 text-center whitespace-nowrap">Admin</th>
                    <th class="p-3 text-center whitespace-nowrap">Iuran Dekopinda</th>
            
                    <!-- Beban Organisasi -->
                    <th class="p-3 text-center whitespace-nowrap">RkRab</th>
                    <th class="p-3 text-center whitespace-nowrap">Pembinaan</th>
                    <th class="p-3 text-center whitespace-nowrap">Harkop</th>
                    <th class="p-3 text-center whitespace-nowrap">Dandik</th>
            
                    <!-- Beban Operasional -->
                    <th class="p-3 text-center whitespace-nowrap">Rapat</th>
                    <th class="p-3 text-center whitespace-nowrap">Jasa Manasuka</th>
            
                    <!-- Beban Lain -->
                    <th class="p-3 text-center whitespace-nowrap">Pajak</th>
                    <th class="p-3 text-center whitespace-nowrap">Tabungan Qurban</th>
                    <th class="p-3 text-center whitespace-nowrap">Dekopinda</th>
                    <th class="p-3 text-center whitespace-nowrap">Wajib PKPRI</th>
                    <th class="p-3 text-center whitespace-nowrap">Dansos</th>
                    <th class="p-3 text-center whitespace-nowrap">SHU</th>
                    <th class="p-3 text-center whitespace-nowrap">Dana Pengurus</th>
                </tr>         
            </thead>
            <tbody>
                @forelse ($jkks as $index => $jkk)     
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="pl-5 text-[#6DA854]">{{ $jkks->firstItem() + $index }}</td>
                        <td class="p-3">{{ $jkk->nama_anggota }}</td>
                        <td class="p-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($jkk->tanggal)->translatedFormat('d-m-y') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_angsuran, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_pokok, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_wajib, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_manasuka, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_swp, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_qurban, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_lain_lain, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_piutang, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_hutang, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_hari_lembur, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_perjalanan_pengawas, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_thr, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_admin, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_iuran_dekopinda, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_rkrab, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_pembinaan, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_harkop, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_dandik, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_rapat, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_jasa_manasuka, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_pajak, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_tabungan_qurban, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_dekopinda, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_wajib_pkpri, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_dansos, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_shu, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_dana_pengurus, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap">- Rp {{ number_format($jkk->total_tnh_kav, 0, ',', '.') }}</td>
                        <td class="p-3 whitespace-nowrap font-bold">- Rp {{ number_format($jkk->total_jumlah, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14" class="text-center py-4">Tidak ada data kas keluar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 pl-2 pr-4">
        {{ $jkks->links() }}
    </div>   
</div>

