<body>
    <h3 class="mb-4">Rekap JKM Tahun: {{ $selectedYear }}</h3>
    <table>
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
                <th>JS Admin</th>
                <th>Lain-lain</th>
                <th>Barang Kons</th>
                <th>Total</th>
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
    </table>
    <div class="mt-4">
        <h3 class="text-lg font-semibold">Total Tahun {{ $selectedYear }}: Rp {{ number_format($totalPerTahun, 0, ',', '.') }}</h3>
    </div>
</body>
