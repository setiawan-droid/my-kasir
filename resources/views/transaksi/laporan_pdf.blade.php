<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; padding: 6px; }
        h2, h4 { text-align: center; margin: 0; }
    </style>
</head>
<body>

<h2>LAPORAN TRANSAKSI</h2>
<h4>Periode: {{ date('d-m-Y', strtotime($awal)) }} s/d {{ date('d-m-Y', strtotime($akhir)) }}</h4>
<br>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Tanggal</th>
            <th>Total (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; $grand = 0; @endphp
        @foreach ($data as $t)
        @php $grand += $t->total; @endphp
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $t->kode_transaksi }}</td>
            <td>{{ date('d-m-Y H:i', strtotime($t->created_at)) }}</td>
            <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3 style="text-align: right; margin-top: 15px;">
    Grand Total: Rp {{ number_format($grand, 0, ',', '.') }}
</h3>

</body>
</html>
