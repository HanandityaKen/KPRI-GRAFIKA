<body>
  <h3 class="mb-4" style="text-align: center;">Daftar Anggota</h3>
  <br>
  <table style="width: 100%">
    <thead>
        <tr>
            <th>No</th>
            <th>No Anggota</th>
            <th>Nama Anggota</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($anggotas as $key => $anggota)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $anggota->no_anggota ?? '-' }}</td>
                <td>{{ $anggota->nama ?? '-' }}</td>
                <td>123456789</td>
            </tr>
        @endforeach
    </tbody>
  </table>
</body>
