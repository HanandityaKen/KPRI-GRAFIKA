<body>
  <h3 class="mb-4" style="text-align: center;">Angsuran Unit Konsumsi</h3>
  <br>
  <table style="width: 100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Nama Barang</th>
            <th>Nominal</th>
            <th>Lama Angsuran</th>
            <th>Nominal Pokok</th>
            <th>Nominal Jasa</th>
            <th>Kurang Angsuran</th>
            <th>Kurang Jasa</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($angsurans as $key => $angsuran)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $angsuran->unit_konsumsi->pengajuan_unit_konsumsi->anggota->nama }}</td>
                <td>{{ $angsuran->unit_konsumsi->pengajuan_unit_konsumsi->nama_barang }}</td>
                <td>Rp {{ number_format($angsuran->unit_konsumsi->pengajuan_unit_konsumsi->nominal, 0, ',', '.') }}</td>
                <td>{{ ucwords($angsuran->unit_konsumsi->pengajuan_unit_konsumsi->lama_angsuran) }}</td>
                <td>Rp {{ number_format($angsuran->unit_konsumsi->pengajuan_unit_konsumsi->nominal_pokok, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($angsuran->unit_konsumsi->pengajuan_unit_konsumsi->nominal_bunga, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($angsuran->kurang_angsuran, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($angsuran->kurang_jasa, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
</body>
