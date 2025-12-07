<!DOCTYPE html>
<html>
<head>
    <title>Cetak Struk</title>
    <style>
        body {
            width: 80mm;
            font-family: 'Arial';
            font-size: 12px;
        }
        .center { text-align: center; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 2px 0; }
        .tot { border-top: 1px dashed #000; border-bottom: 1px dashed #000; padding: 4px 0; }
        @media print {
            @page { size: 80mm auto; margin: 0; }
            body { margin: 0; }
        }
    </style>
</head>
<body onload="window.print()">

<div class="center">
    <strong>TOKO KASIR</strong><br>
    Jl. Testing No. 123<br>
    ---------------------------<br>
</div>

<b>Kode:</b> {{ $transaksi->kode_transaksi }}<br>
<b>Tanggal:</b> {{ $transaksi->created_at->format('d/m/Y H:i') }}<br>
<b>Kasir:</b> {{ $transaksi->user->name ?? '—' }}<br>
---------------------------------------------

<table>
    @php $total = 0; @endphp
    @foreach($detail as $d)
        @php $sub = $d->qty * $d->harga; $total += $sub; @endphp
        <tr>
            <td colspan="2">{{ $d->product->nama }}</td>
        </tr>
        <tr>
            <td>{{ $d->qty }} x Rp {{ number_format($d->harga,0,',','.') }}</td>
            <td style="text-align:right">Rp {{ number_format($sub,0,',','.') }}</td>
        </tr>
    @endforeach
</table>

<div class="tot">
<b>Total: Rp {{ number_format($total,0,',','.') }}</b>
</div>

<div class="center">
    TERIMA KASIH<br>
    *** Sampai Jumpa ***
</div>

</body>
</html>
