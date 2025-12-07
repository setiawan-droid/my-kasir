<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; padding: 6px; }
        h2 { text-align: center; }
    </style>
</head>
<body>

<h2>STRUK PEMBAYARAN</h2>

<p>
    Kode Transaksi: <strong>{{ $transaksi->kode_transaksi }}</strong><br>
    Tanggal: {{ $transaksi->created_at->format('d-m-Y H:i') }}<br>
</p>

<table>
    <thead>
        <tr>
            <th>Produk</th>
            <th>Qty</th>
            <th>Harga</th>
            <th style="text-align:center">Diskon</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detail as $d)
        <tr>
            <td>{{ $d->product->nama }}</td>
            <td>{{ $d->qty }}</td>
            <td>Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
            <td style="text-align:center">{{ $d->diskon_persen }}%</td>
            <td>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
        <!-- Tambahkan baris Diskon & Grand Total di sini -->
        <tr>
            <td colspan="4" style="text-align:right">Diskon {{ $transaksi->diskon_persen }}%</td>
            <td style="text-align:right">- Rp {{ number_format($transaksi->diskon,0,',','.') }}</td>
        </tr>
        <tr>
            <td colspan="4" style="text-align:right"><b>Grand Total</b></td>
            <td style="text-align:right"><b>Rp {{ number_format($transaksi->grand_total,0,',','.') }}</b></td>
        </tr>
        <tr>
            <td colspan="4" style="text-align:right"><h3 style="text-align: right; margin-top: 10px;">
    Total:  </h3></b></td>
            <td style="text-align:right"><b>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</b></td>
        </tr>
   
 </tbody>
</table>
<br><br>
<p style="text-align:center;">
    Terima kasih telah berbelanja 🙏
</p>

</body>
</html>
