<body>
  <h3 class="mb-4" style="text-align: center;">Simpanan Anggota</h3>
  <br>
  <table style="width: 100%">
    <thead>
        <tr>
            <th>No</th>
            <th>No Anggota</th>
            <th>Nama Anggota</th>
            <th>Pokok</th>
            <th>Wajib</th>
            <th>Manasuka</th>
            <th>Wajib Pinjam</th>
            <th>Qurban</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($simpanans as $key => $simpanan)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $simpanan->anggota->no_anggota ?? '-' }}</td>
                <td>{{ $simpanan->anggota->nama ?? '-' }}</td>
                <td>Rp {{ number_format($simpanan->total_pokok, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($simpanan->total_wajib, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($simpanan->total_manasuka, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($simpanan->total_wp, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($simpanan->total_qurban, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($simpanan->total_pokok + $simpanan->total_wajib + $simpanan->total_manasuka + $simpanan->total_wajib_pinjam + $simpanan->total_qurban, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
</body>
