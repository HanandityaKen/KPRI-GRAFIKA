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
    JKK {{ $namaBulan ? $namaBulan . ' ' . $selectedYear : $selectedYear }}
  </h3>
  <br>
  <table style="width: 100%">
      <thead>
          <tr>
              <th rowspan="2">Uraian</th>
              <th rowspan="2">Tanggal</th>
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
          @foreach ($transaksi as $jkk)
          <tr>
              <td>{{ $jkk->nama_anggota }}</td>
              <td>{{ \Carbon\Carbon::parse($jkk->tanggal)->translatedFormat('d-m-Y') }}</td>
              <td>- Rp {{ number_format($jkk->angsuran, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->pokok, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->wajib, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->manasuka, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->wajib_pinjam, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->qurban, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->lain_lain, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->piutang, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->hutang, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->hari_lembur, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->perjalanan_pengawas, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->thr, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->admin, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->iuran_dekopinda, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->rkrab, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->pembinaan, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->harkop, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->dandik, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->rapat, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->jasa_manasuka, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->pajak, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->tabungan_qurban, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->dekopinda, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->wajib_pkpri, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->dansos, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->shu, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->dana_pengurus, 0, ',', '.') }}</td>
              <td>- Rp {{ number_format($jkk->tnh_kav, 0, ',', '.') }}</td>
              <td>
                - Rp {{
                    number_format(
                        $jkk->angsuran + $jkk->pokok + $jkk->wajib + $jkk->manasuka + $jkk->wajib_pinjam +
                        $jkk->qurban + $jkk->lain_lain + $jkk->piutang + $jkk->hutang + $jkk->hari_lembur +
                        $jkk->perjalanan_pengawas + $jkk->thr + $jkk->admin + $jkk->iuran_dekopinda +
                        $jkk->rkrab + $jkk->pembinaan + $jkk->harkop + $jkk->dandik + $jkk->rapat +
                        $jkk->jasa_manasuka + $jkk->pajak + $jkk->tabungan_qurban + $jkk->dekopinda +
                        $jkk->wajib_pkpri + $jkk->dansos + $jkk->shu + $jkk->dana_pengurus + $jkk->tnh_kav,
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
                @if ($namaBulan && $selectedYear)
                    Total JKK {{ $namaBulan . ' ' . $selectedYear }}:
                @elseif ($selectedYear)
                    Total JKK Tahun {{ $selectedYear }}:
                @else
                    Total JKK Semua Periode:
                @endif
                - Rp {{ number_format($totalPerPeriode, 0, ',', '.') }}
            </td>
        </tr>
    </tfoot>    
  </table>
</body>
