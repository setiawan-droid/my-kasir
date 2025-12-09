@extends('layouts.app')

@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Diskon</th>
            <th>Grand Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksi as $t)
            <tr>
                <td>{{ $t->kode_transaksi }}</td>
                <td>{{ $t->created_at }}</td>
                <td>{{ number_format($t->total) }}</td>
                <td>{{ $t->diskon_persen }}%</td>
                <td>{{ number_format($t->grand_total) }}</td>
                <td><a href="{{ route('transaksi.show', $t->id) }}" class="btn btn-primary btn-sm">Detail</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
