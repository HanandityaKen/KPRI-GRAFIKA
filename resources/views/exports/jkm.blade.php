@php
    use Carbon\Carbon;

    $namaBulan = null;

    if ($selectedMonth) {
        $namaBulan = Carbon::create(null, (int) $selectedMonth, 1)
            ->locale('id')
            ->translatedFormat('F');
    }
@endphp
<body>
  <h3 class="mb-4" style="text-align: center;">
    JKM {{ $namaBulan ? $namaBulan . ' ' . $selectedYear : $selectedYear }}
  </h3>
  <br>
  <table style="width: 100%">
      <thead>
          <tr>
              <th>Uraian</th>
              <th>Tanggal</th>
              <th>Angsuran</th>
              <th>Pokok</th>
              <th>Wajib</th>
              <th>Manasuka</th>
              <th>Wajib Pinjam</th>
              <th>Qurban</th>
              <th>Jasa</th>
              <th>J.Admin</th>
              <th>Lain-lain</th>
              <th>Barang Konsumsi</th>
              <th>Jumlah</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($transaksi as $jkm)
          <tr>
              <td>{{ $jkm->nama_anggota }}</td>
              <td>{{ \Carbon\Carbon::parse($jkm->tanggal)->translatedFormat('d-m-Y') }}</td>
              <td>Rp {{ number_format($jkm->angsuran, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($jkm->pokok, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($jkm->wajib, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($jkm->manasuka, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($jkm->wajib_pinjam, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($jkm->qurban, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($jkm->jasa, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($jkm->js_admin, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($jkm->lain_lain, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($jkm->barang_kons, 0, ',', '.') }}</td>
              <td>
                  Rp {{
                      number_format(
                          $jkm->angsuran + $jkm->pokok + $jkm->wajib + $jkm->manasuka + $jkm->wajib_pinjam +
                          $jkm->qurban + $jkm->jasa + $jkm->js_admin + $jkm->lain_lain + $jkm->barang_kons,
                          0, ',', '.'
                      )
                  }}
              </td>            
          </tr>
          @endforeach
      </tbody>
      <tfoot>
        <tr>
            <td colspan="12" style="padding: 8px; font-weight: bold">
                Total JKM {{ $namaBulan ? $namaBulan . ' ' . $selectedYear : 'Tahun ' . $selectedYear }}:
                Rp {{ number_format($totalPerPeriode, 0, ',', '.') }}
            </td>
        </tr>
      </tfoot>
  </table>
</body>
