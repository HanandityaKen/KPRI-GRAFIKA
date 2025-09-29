<body>
  <h3 class="mb-4" style="text-align: center;">
    NERACA PER 31 DESEMBER {{ $selectedYear }} KPRI "GRAFIKA" MALANG
  </h3>
  <br>
  <table style="width: 100%">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Perkiraan Buku Besar</th>
            <th colspan="2">Neraca Awal {{ $tahunNeracaAwal }}</th>
            <th colspan="2">N. Perubahan</th>
            <th colspan="2">N. Percobaan</th>
            <th colspan="2">N. Saldo</th>
            <th colspan="2">A. Penyesuaian</th>
            <th colspan="2">NS. Disesuaikan</th>
            <th colspan="2">Rugi dan Laba</th>
            <th colspan="2">Neraca {{ $selectedYear }}</th>
        </tr>
        <tr>
            {{-- Neraca Awal --}}
            <th>D</th>
            <th>K</th>

            {{-- N. Perubahan --}}
            <th>D</th>
            <th>K</th>

            {{-- N. Percobaan --}}
            <th>D</th>
            <th>K</th>

            {{-- N. Saldo --}}
            <th>D</th>
            <th>K</th>

            {{-- A. Penyesuaian --}}
            <th>D</th>
            <th>K</th>

            {{-- NS. Disesuaikan --}}
            <th>D</th>
            <th>K</th>

            {{-- Rugi dan Laba --}}
            <th>D</th>
            <th>K</th>

            {{-- Neraca --}}
            <th>D</th>
            <th>K</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fields as $index => $field)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ ucwords(str_replace('_', ' ', $field)) }}</td>

                <td>{{ number_format($data[$field]['neraca_awal_d'], 0, ',', '.') }}</td>
                <td>{{ number_format($data[$field]['neraca_awal_k'], 0, ',', '.') }}</td>

                <td>{{ number_format($data[$field]['n_perubahan_d'], 0, ',', '.') }}</td>
                <td>{{ number_format($data[$field]['n_perubahan_k'], 0, ',', '.') }}</td>

                <td>{{ number_format($data[$field]['n_percobaan_d'], 0, ',', '.') }}</td>
                <td>{{ number_format($data[$field]['n_percobaan_k'], 0, ',', '.') }}</td>

                <td>{{ number_format($data[$field]['n_saldo_d'], 0, ',', '.') }}</td>
                <td>{{ number_format($data[$field]['n_saldo_k'], 0, ',', '.') }}</td>

                <td>{{ number_format($data[$field]['a_penyesuaian_d'], 0, ',', '.') }}</td>
                <td>{{ number_format($data[$field]['a_penyesuaian_k'], 0, ',', '.') }}</td>

                <td>{{ number_format($data[$field]['ns_disesuaikan_d'], 0, ',', '.') }}</td>
                <td>{{ number_format($data[$field]['ns_disesuaikan_k'], 0, ',', '.') }}</td>

                <td>{{ number_format($data[$field]['rugi_dan_laba_d'], 0, ',', '.') }}</td>
                <td>{{ number_format($data[$field]['rugi_dan_laba_k'], 0, ',', '.') }}</td>

                <td>{{ number_format($data[$field]['neraca_d'], 0, ',', '.') }}</td>
                <td>{{ number_format($data[$field]['neraca_k'], 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2">Jumlah</td>
    
            <td>{{ number_format($data['jumlah']['neraca_awal_d'], 0, ',', '.') }}</td>
            <td>{{ number_format($data['jumlah']['neraca_awal_k'], 0, ',', '.') }}</td>
    
            <td>{{ number_format($data['jumlah']['n_perubahan_d'], 0, ',', '.') }}</td>
            <td>{{ number_format($data['jumlah']['n_perubahan_k'], 0, ',', '.') }}</td>
    
            <td>{{ number_format($data['jumlah']['n_percobaan_d'], 0, ',', '.') }}</td>
            <td>{{ number_format($data['jumlah']['n_percobaan_k'], 0, ',', '.') }}</td>
    
            <td>{{ number_format($data['jumlah']['n_saldo_d'], 0, ',', '.') }}</td>
            <td>{{ number_format($data['jumlah']['n_saldo_k'], 0, ',', '.') }}</td>
    
            <td>{{ number_format($data['jumlah']['a_penyesuaian_d'], 0, ',', '.') }}</td>
            <td>{{ number_format($data['jumlah']['a_penyesuaian_k'], 0, ',', '.') }}</td>
    
            <td>{{ number_format($data['jumlah']['ns_disesuaikan_d'], 0, ',', '.') }}</td>
            <td>{{ number_format($data['jumlah']['ns_disesuaikan_k'], 0, ',', '.') }}</td>
    
            <td>{{ number_format($data['jumlah']['rugi_dan_laba_d'], 0, ',', '.') }}</td>
            <td>{{ number_format($data['jumlah']['rugi_dan_laba_k'], 0, ',', '.') }}</td>
    
            <td>{{ number_format($data['jumlah']['neraca_d'], 0, ',', '.') }}</td>
            <td>{{ number_format($data['jumlah']['neraca_k'], 0, ',', '.') }}</td>
        </tr>
    </tbody>
  </table>
</body>