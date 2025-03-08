<body>
    <h3 class="mb-4">Rekap JKK Tahun: {{ $selectedYear }}</h3>
    <table style="width: 100%">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Angsuran</th>
                <th>Pokok</th>
                <th>Wajib</th>
                <th>Manasuka</th>
                <th>Wajib Pinjam</th>
                <th>Qurban</th>
                <th>Jasa</th>
                <th>J. Admin</th>
                <th>Lain-lain</th>
                <th>Piutang</th>
                <th>Hutang</th>
                <th>Biaya Umum</th>
                <th>Biaya Organisasi</th>
                <th>Biaya Operasional</th>
                <th>Tanah Kavling</th>
                <th>Jumlah</th>
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
                <td>- Rp {{ number_format($jkk['total_jasa'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_j_admin'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_lain_lain'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_piutang'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_hutang'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_b_umum'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_b_orgns'], 0, ',', '.') }}</td>
                <td>- Rp {{ number_format($jkk['total_b_oprs'], 0, ',', '.') }}</td>
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
