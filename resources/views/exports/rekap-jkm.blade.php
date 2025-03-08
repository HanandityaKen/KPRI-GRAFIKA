<body>
    <h3 class="mb-4">Rekap JKM Tahun: {{ $selectedYear }}</h3>
    <table style="width: 100%">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Angsuran</th>
                <th>Pokok</th>
                <th>Wajib</th>
                <th>M.Suka</th>
                <th>SWP</th>
                <th>Qurban</th>
                <th>Jasa</th>
                <th>J.Admin</th>
                <th>Lain-Lain</th>
                <th>Barang Konsumsi</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jkms as $jkm)
            <tr>
                <td>{{ $jkm['bulan'] }}</td>
                <td>Rp {{ number_format($jkm['total_angsuran'], 0, ',', '.') }}</td>
                <td>Rp {{ number_format($jkm['total_pokok'], 0, ',', '.') }}</td>
                <td>Rp {{ number_format($jkm['total_wajib'], 0, ',', '.') }}</td>
                <td>Rp {{ number_format($jkm['total_m_suka'], 0, ',', '.') }}</td>
                <td>Rp {{ number_format($jkm['total_swp'], 0, ',', '.') }}</td>
                <td>Rp {{ number_format($jkm['total_qurban'], 0, ',', '.') }}</td>
                <td>Rp {{ number_format($jkm['total_jasa'], 0, ',', '.') }}</td>
                <td>Rp {{ number_format($jkm['total_j_admin'], 0, ',', '.') }}</td>
                <td>Rp {{ number_format($jkm['total_lain_lain'], 0, ',', '.') }}</td>
                <td>Rp {{ number_format($jkm['total_barang_kons'], 0, ',', '.') }}</td>
                <td>Rp {{ number_format($jkm['total_jumlah'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="12" style="padding: 8px; font-weight: bold">
                    Total Tahun {{ $selectedYear }}: Rp {{ number_format($totalPerTahun, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
    </table>    
</body>
