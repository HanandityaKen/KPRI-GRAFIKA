<body>
    <h3 class="mb-4" style="text-align: center;">Rekap JKK Tahun: {{ $selectedYear }}</h3>
    <br>
    <table style="width: 100%">
        <thead>
            <tr>
                <th rowspan="2">Bulan</th>
                <th rowspan="2">Angsuran</th>
                <th rowspan="2">Pokok</th>
                <th rowspan="2">Wajib</th>
                <th rowspan="2">Manasuka</th>
                <th rowspan="2">Wajib Pinjam</th>
                <th rowspan="2">Qurban</th>
                <th rowspan="2">Lain-lain</th>
                <th rowspan="2">Piutang</th>
                <th rowspan="2">Hutang</th>
        
                <!-- Beban Umum -->
                <th colspan="5" style="text-align: center;">Beban Umum</th>
        
                <!-- Beban Organisasi -->
                <th colspan="4" style="text-align: center;">Beban Organisasi</th>
        
                <!-- Beban Operasional -->
                <th colspan="2" style="text-align: center;">Beban Operasional</th>
        
                <!-- Beban Lain -->
                <th colspan="7" style="text-align: center;">Beban Lain</th>
        
                <th rowspan="2">Tanah Kavling</th>
                <th rowspan="2">Jumlah</th>
            </tr>
            <tr>
                <!-- Subkolom Beban Umum -->
                <th>Hari Lembur</th>
                <th>Perjalanan Pengawas</th>
                <th>THR</th>
                <th>Admin</th>
                <th>Iuran Dekopinda</th>
        
                <!-- Subkolom Beban Organisasi -->
                <th>RkRab</th>
                <th>Pembinaan</th>
                <th>Harkop</th>
                <th>Dandik</th>
        
                <!-- Subkolom Beban Operasional -->
                <th>Rapat</th>
                <th>Jasa Manasuka</th>
        
                <!-- Subkolom Beban Lain -->
                <th>Pajak</th>
                <th>Tabungan Qurban</th>
                <th>Dekopinda</th>
                <th>Wajib PKPRI</th>
                <th>Dansos</th>
                <th>SHU</th>
                <th>Dana Pengurus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jkks as $jkk)
            <tr>
                <td>{{ $jkk['bulan'] }}</td>
                <td>- Rp {{ number_format($jkk['total_angsuran'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_pokok'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_wajib'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_m_suka'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_swp'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_qurban'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_lain_lain'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_piutang'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_hutang'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_hari_lembur'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_perjalanan_pengawas'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_thr'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_admin'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_iuran_dekopinda'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_rkrab'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_pembinaan'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_harkop'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_dandik'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_rapat'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_jasa_manasuka'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_pajak'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_tabungan_qurban'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_dekopinda'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_wajib_pkpri'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_dansos'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_shu'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_dana_pengurus'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_tnh_kav'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_jumlah'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="12" style="padding: 8px; font-weight: bold">
                    Total Tahun {{ $selectedYear }}: - Rp {{ number_format($totalPerTahun, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
    </table>
</body>
