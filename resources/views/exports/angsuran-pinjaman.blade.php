<body>
  <h3 class="mb-4" style="text-align: center;">Angsuran Pinjaman</h3>
  <br>
  <table style="width: 100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Anggota</th>
            <th>Totak Pinjaman</th>
            <th>Lama Angsuran</th>
            <th>Nominal Angsuran</th>
            <th>Nominal Pokok</th>
            <th>Nominal Jasa</th>
            <th>Kurang Angsuran</th>
            <th>Kurang Jasa</th>
            <th>Tunggakan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($angsurans as $key => $angsuran)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $angsuran->pinjaman->pengajuan_pinjaman->nama_anggota }}</td>
                <td>Rp {{ number_format($angsuran->pinjaman->pengajuan_pinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
                <td>{{ ucwords($angsuran->pinjaman->pengajuan_pinjaman->lama_angsuran) }}</td>
                <td>Rp {{ number_format($angsuran->pinjaman->pengajuan_pinjaman->nominal_angsuran, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($angsuran->pinjaman->pengajuan_pinjaman->nominal_pokok, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($angsuran->pinjaman->pengajuan_pinjaman->nominal_bunga, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($angsuran->kurang_angsuran, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($angsuran->kurang_jasa, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($angsuran->tunggakan, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
</body>
