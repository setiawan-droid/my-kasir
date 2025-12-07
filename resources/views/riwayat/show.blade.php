<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border-bottom: 1px solid #ddd; padding: 4px; text-align: left; }
        .text-right { text-align: right; }
        .center { text-align: center; }
    </style>
</head>
<body>

    <h3 class="center">STRUK PEMBELIAN</h3>
    <p>No Transaksi : {{ $transaksi->id }} <br>
    Tanggal : {{ $transaksi->created_at->format('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->details as $item)
            <tr>
                <td>{{ $item->product->nama }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="text-right">Total : Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</h4>
    <tr>
    <th>Diskon</th>
    <td>{{ $transaksi->diskon }} %</td>
</tr>
<tr>
    <th>Potongan</th>
    <td>Rp {{ number_format($transaksi->potongan, 0, ',', '.') }}</td>
</tr>
<tr>
    <th>Total Bayar</th>
    <td><b>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</b></td>
</tr>

    <br><br>

    <p class="center">~~ TERIMA KASIH ~~</p>

</body>
</html>
