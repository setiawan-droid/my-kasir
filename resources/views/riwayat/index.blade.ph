@extends('layouts.app')

@section('content')
<h2>Riwayat Transaksi</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>Kode</th>
        <th>Total</th>
        <th>Bayar</th>
        <th>Kembalian</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>
    @foreach ($transaksi as $t)
    <tr>
        <td>{{ $t->kode_transaksi }}</td>
        <td>Rp {{ $t->total }}</td>
        <td>Rp {{ $t->bayar }}</td>
        <td>Rp {{ $t->kembalian }}</td>
        <td>{{ $t->created_at }}</td>
        <td>
            <a href="{{ route('riwayat.show', $t->id) }}">Detail</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
