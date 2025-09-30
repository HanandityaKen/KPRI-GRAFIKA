<body>
  <h3 class="mb-4" style="text-align: center;">
    KPRI "GRAFIKA" MALANG
  </h3>
  <br>
  <table style="width: 100%">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Perkiraan</th>
            <th colspan="2">Jumlah</th>
            <th rowspan="2">No</th>
            <th rowspan="2">Perkiraan</th>
            <th colspan="2">Jumlah</th>
        </tr>
        <tr>
            {{-- Neraca Awal --}}
            <th>{{ $tahunSebelumnya }}</th>
            <th>{{ $selectedYear }}</th>

            {{-- Neraca --}}
            <th>{{ $tahunSebelumnya }}</th>
            <th>{{ $selectedYear }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td><i>Aktiva Lancar</i></td>
            <td></td>
            <td></td>
            <td></td>
            <td><i>Kewajiban Lancar</i></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>1</td>
            <td>Kas</td>
            <td>{{ number_format($kasPrev, 0, ',', '.') }}</td> <!--2023 -->
            <td>{{ number_format($kasCurr, 0, ',', '.') }}</td> <!--2024 -->
            <td>1</td>
            <td>Pendapatan diterima lebih dahulu</td>
            <td>{{ number_format($pendapatanDiterimaLebihDahuluPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($pendapatanDiterimaLebihDahuluCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Bank</td>
            <td>{{ number_format($bankPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($bankCurr, 0, ',', '.') }}</td>
            <td>2</td>
            <td>Kewajiban Titipan</td>
            <td>{{ number_format($kewajibanTitipanPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($kewajibanTitipanCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Piutang</td>
            <td>{{ number_format($piutangPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($piutangCurr, 0, ',', '.') }}</td>
            <td>3</td>
            <td>Pajak YMH dibayar</td>
            <td>{{ number_format($pajakYmhDibayarPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($pajakYmhDibayarCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Persediaan Peralatan</td>
            <td>{{ number_format($persediaanPeralatanPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($persediaanPeralatanCurr, 0, ',', '.') }}</td>
            <td>4</td>
            <td>Jasa Partisipasi Anggota</td>
            <td>{{ number_format($jasaPartisipasiAnggotaPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($jasaPartisipasiAnggotaCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Akumulasi Penyusutan Peralatan</td>
            <td>{{ number_format($akumulasiPenyusutanPeralatanPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($akumulasiPenyusutanPeralatanCurr, 0, ',', '.') }}</td>
            <td>5</td>
            <td>Dana Pengurus</td>
            <td>{{ number_format($danaPengurusPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($danaPengurusCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>6</td>
            <td>Pendapatan YMH diterima</td>
            <td>{{ number_format($pendapatanYmhDiterimaPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($pendapatanYmhDiterimaCurr, 0, ',', '.') }}</td>
            <td>6</td>
            <td>Dana Karyawan</td>
            <td>{{ number_format($danaKaryawanPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($danaKaryawanCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>7</td>
            <td>Simp. Manasuka di PKPRI</td>
            <td>{{ number_format($simpManasukaDiPkpriPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($simpManasukaDiPkpriCurr, 0, ',', '.') }}</td>
            <td>7</td>
            <td>Dana Pendidikan</td>
            <td>{{ number_format($danaPendidikanPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($danaPendidikanCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>8</td>
            <td>Dana Sosial</td>
            <td>{{ number_format($danaSosialPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($danaSosialCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>9</td>
            <td>Tabungan Qurban</td>
            <td>{{ number_format($tabunganQurbanPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($tabunganQurbanCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>10</td>
            <td>Simp. Manasuka Anggota</td>
            <td>{{ number_format($simpManasukaAnggotaPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($simpManasukaAnggotaCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>11</td>
            <td>Simp. Wajib Pinjam anggota</td>
            <td>{{ number_format($simpWajibPinjamAnggotaPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($simpWajibPinjamAnggotaCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td></td>
            <td>Jumlah</td>
            <td>{{ number_format($jumlahAktivaLancarPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($jumlahAktivaLancarCurr, 0, ',', '.') }}</td>
            <td></td>
            <td>Jumlah</td>
            <td>{{ number_format($jumlahKewajibanLancarPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($jumlahKewajibanLancarCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td></td>
            <td><i>Penyertaan</i></td>
            <td></td>
            <td></td>
            <td></td>
            <td><i>Kekayaan</i></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>10</td>
            <td>Tabungan di PKPRI</td>
            <td>{{ number_format($tabunganDiPkpriPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($tabunganDiPkpriCurr, 0, ',', '.') }}</td>
            <td>12</td>
            <td>Donasi</td>
            <td>{{ number_format($donasiPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($donasiCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>11</td>
            <td>Simp. Pokok di PKPRI</td>
            <td>{{ number_format($simpPokokDiPkpriPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($simpPokokDiPkpriCurr, 0, ',', '.') }}</td>
            <td>13</td>
            <td>Simp. Pokok anggota</td>
            <td>{{ number_format($simpPokokAnggotaPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($simpPokokAnggotaCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>12</td>
            <td>Sip. Wajib di PKPRI</td>
            <td>{{ number_format($sipWajibDiPkpriPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($sipWajibDiPkpriCurr, 0, ',', '.') }}</td>
            <td>14</td>
            <td>Simp. Wajib Anggota</td>
            <td>{{ number_format($simpWajibAnggotaPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($simpWajibAnggotaCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>13</td>
            <td>Simp. Khusus di PKPRI</td>
            <td>{{ number_format($simpKhususDiPkpriPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($simpKhususDiPkpriCurr, 0, ',', '.') }}</td>
            <td>15</td>
            <td>Cadangan</td>
            <td>{{ number_format($cadanganPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($cadanganCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>14</td>
            <td>Simpanan Wajib Pinjam di PKPRI</td>
            <td>{{ number_format($simpWajibPinjamDiPkpriPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($simpWajibPinjamDiPkpriCurr, 0, ',', '.') }}</td>
            <td>16</td>
            <td>SHU</td>
            <td>{{ number_format($shuPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($shuCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>15</td>
            <td>SKPB</td>
            <td>{{ number_format($skpbPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($skpbCurr, 0, ',', '.') }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>16</td>
            <td>Penyertaan di Hotel PKPRI</td>
            <td>{{ number_format($penyertaanDiHotelPkpriPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($penyertaanDiHotelPkpriCurr, 0, ',', '.') }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>16</td>
            <td>Penyertaan di Kopen</td>
            <td>{{ number_format($penyertaanDiKopenPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($penyertaanDiKopenCurr, 0, ',', '.') }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>17</td>
            <td>Penyertaan Unit Konsumsi</td>
            <td>{{ number_format($penyertaanDiUnitKonsumsiPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($penyertaanDiUnitKonsumsiCurr, 0, ',', '.') }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>Jumlah</td>
            <td>{{ number_format($jumlahPenyertaanPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($jumlahPenyertaanCurr, 0, ',', '.') }}</td>
            <td></td>
            <td>Jumlah</td>
            <td>{{ number_format($jumlahKekayaanPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($jumlahKekayaanCurr, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td></td>
            <td><i>Aktiva Tetap</i></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>19</td>
            <td>Tanah</td>
            <td>{{ number_format($tanahPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($tanahCurr, 0, ',', '.') }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>Jumlah Total</td>
            <td>{{ number_format($jumlahTotalKiriPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($jumlahTotalKiriCurr, 0, ',', '.') }}</td>
            <td></td>
            <td>Jumlah Total</td>
            <td>{{ number_format($jumlahTotalKananPrev, 0, ',', '.') }}</td>
            <td>{{ number_format($jumlahTotalKananCurr, 0, ',', '.') }}</td>
        </tr>
    </tbody>
  </table>
</body>