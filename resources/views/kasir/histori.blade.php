@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Histori Transaksi</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Transaksi</th>
                <th>Total</th>
                <th>Bayar</th>
                <th>Kembalian</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $t)
            <tr>
                <td>{{ $t->kode_transaksi }}</td>
                <td>Rp {{ number_format($t->total) }}</td>
                <td>Rp {{ number_format($t->bayar) }}</td>
                <td>Rp {{ number_format($t->kembalian) }}</td>
                <td>{{ $t->created_at }}</td>
                <td>
                    <a href="{{ route('kasir.detail', $t->id) }}" class="btn btn-primary btn-sm">Lihat detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
