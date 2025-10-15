<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('storage/logo-koperasi/' . $logoKoperasi->logo ) }}">
    <title>Struk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* font-size: 12px; */
            margin: 20px;
        }
        .header {
            text-align: center;
            line-height: 1.4;
        }
        hr {
            border: none;
            border-top: 1px solid #000;
            margin: 8px 0;
        }
        section{
            font-size: 15px;
        }
    </style>
</head>
<body>
    <article>
        <header class="container">
            <div class="header">
                <p style="font-size: 26px; font-weight: bold; margin: 0;">KPRI "GRAFIKA" MALANG</p>
                <p style="font-size: 16px; margin: 2px 0 0 0;">Jl. Tanimbar 22 Malang Telp. 0341-353798</p>
            </div>
        </header>
        <hr style="border: none; border-top: 2px solid #000;">
        <section style="margin-top: 25px;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="font-size: 16px; font-weight: bold; text-align: left; padding: 0;">Nama Anggota</td>
                    <td style="font-size: 16px; font-weight: bold; text-align: right; padding: 0;">{{ $kasHarian->nama_anggota }}</td>
                </tr>
                <tr>
                    <td style="font-size: 16px; font-weight: bold; text-align: left; padding: 0; padding-top: 15px;">Uang Sejumlah</td>
                    <td style="font-size: 16px; font-weight: bold; text-align: right; padding: 0; padding-top: 15px;">Rp. {{ number_format($uangSejumlah, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td style="font-size: 16px; font-weight: bold; font-style: italic; text-align: left; padding: 0; padding-top: 15px;">Untuk pembayaran :</td>
                </tr>
                <tr>
                    <td style="font-family: sans-serif; font-size: 16px; text-align: left; padding: 0; padding-top: 5px;">&bull; Simpanan Pokok</td>
                    <td style="font-size: 16px; text-align: right; padding: 0; padding-top: 5px;">Rp. {{ number_format($kasHarian->pokok, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td style="font-family: sans-serif; font-size: 16px; text-align: left; padding: 0; padding-top: 5px;">&bull; Simpanan Wajib</td>
                    <td style="font-size: 16px; text-align: right; padding: 0; padding-top: 5px;">Rp. {{ number_format($kasHarian->wajib, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td style="font-family: sans-serif; font-size: 16px; text-align: left; padding: 0; padding-top: 5px;">&bull; Simpanan Manasuka</td>
                    <td style="font-size: 16px; text-align: right; padding: 0; padding-top: 5px;">Rp. {{ number_format($kasHarian->manasuka, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td style="font-family: sans-serif; font-size: 16px; text-align: left; padding: 0; padding-top: 5px;">&bull; Simpanan Khusus</td>
                    <td style="font-size: 16px; text-align: right; padding: 0; padding-top: 5px;">Rp. {{ number_format($kasHarian->wajib_pinjam, 0, ',', '.') }}</td>
                </tr>
                @if ($kasHarian->jenis_transaksi === 'kas masuk')
                    @if ($kasHarian->qurban > 0)
                        <tr>
                            <td style="font-family: sans-serif; font-size: 16px; text-align: left; padding: 0; padding-top: 5px;">&bull; Simpanan Qurban</td>
                            <td style="font-size: 16px; text-align: right; padding: 0; padding-top: 5px;">Rp. {{ number_format($kasHarian->qurban, 0, ',', '.') }}</td>
                        </tr>
                    @elseif ($kasHarian->lain_lain)
                        <tr>
                            <td style="font-family: sans-serif; font-size: 16px; text-align: left; padding: 0; padding-top: 5px;">&bull; Lain-lain</td>
                            <td style="font-size: 16px; text-align: right; padding: 0; padding-top: 5px;">Rp. {{ number_format($kasHarian->lain_lain, 0, ',', '.') }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td style="font-family: sans-serif; font-size: 16px; text-align: left; padding: 0; padding-top: 5px;">&bull; Angsuran Piutang ke {{ $kasHarian->pinjaman?->angsuran?->first()?->angsuran_ke ?? '...' }}</td>
                        <td style="font-size: 16px; text-align: right; padding: 0; padding-top: 5px;">Rp. {{ number_format($kasHarian->angsuran, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="font-family: sans-serif; font-size: 16px; text-align: left; padding: 0; padding-top: 5px;">&bull; Jasa</td>
                        <td style="font-size: 16px; text-align: right; padding: 0; padding-top: 5px;">Rp. {{ number_format($kasHarian->jasa, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="font-family: sans-serif; font-size: 16px; text-align: left; padding: 0; padding-top: 5px;">&bull; Angsuran</td>
                        <td style="font-size: 16px; text-align: right; padding: 0; padding-top: 5px;">Rp. {{ number_format($kasHarian->barang_kons, 0, ',', '.') }}</td>
                    </tr>
                @elseif ($kasHarian->jenis_transaksi === 'kas keluar')
                    @if ($kasHarian->qurban > 0)
                        <tr>
                            <td style="font-family: sans-serif; font-size: 16px; text-align: left; padding: 0; padding-top: 5px;">&bull; Qurban</td>
                            <td style="font-size: 16px; text-align: right; padding: 0; padding-top: 5px;">Rp. {{ number_format($kasHarian->qurban, 0, ',', '.') }}</td>
                        </tr>
                    @endif

                    @if ($kasHarian->hutang > 0)
                        <tr>
                            <td style="font-family: sans-serif; font-size: 16px; text-align: left; padding: 0; padding-top: 5px;">&bull; Hutang</td>
                            <td style="font-size: 16px; text-align: right; padding: 0; padding-top: 5px;">Rp. {{ number_format($kasHarian->hutang, 0, ',', '.') }}</td>
                        </tr>
                    @elseif ($kasHarian->barang_kons > 0)
                        <tr>
                            <td style="font-family: sans-serif; font-size: 16px; text-align: left; padding: 0; padding-top: 5px;">&bull; Unit Konsumsi</td>
                            <td style="font-size: 16px; text-align: right; padding: 0; padding-top: 5px;">Rp. {{ number_format($kasHarian->barang_kons, 0, ',', '.') }}</td>
                        </tr>
                    @endif
                @endif
            </table>
            <div style="text-align: right; margin-top: 30px;">
                <p style="text-decoration: underline;">{{ \Carbon\Carbon::parse($kasHarian->tanggal)->translatedFormat('d-m-Y') }}</p>
            </div>
        </section>
        <hr style="margin: 10px 0 0 0; border: none; border-top: 2px solid #000;">
        <footer style="text-align: center; margin: 0;">
            <p style="font-size: 11px; margin: 8px 0 0 0;">
                Apabila ada keraguan dengan potongan harap menghubungi Bendahara
            </p>
        </footer>
    </article>
</body>
</html>
