@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Transaksi</h3>
    <p>Kode: {{ $transaksi->kode_transaksi }}</p>
    <p>Total: Rp {{ $transaksi->total }}</p>
    <p>Bayar: Rp {{ $transaksi->bayar }}</p>
    <p>Kembalian: Rp {{ $transaksi->kembalian }}</p>

    <table class="table">
        <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Diskon (%)</th>
            <th>Subtotal</th>
        </tr>
        @foreach ($detail as $item)
        <tr>
            <td>{{ $item->product->nama }}</td>
            <td>Rp {{ $item->harga }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ $item->diskon_persen }}</td>
            <td>Rp {{ $item->subtotal }}</td>
        </tr>
        @endforeach
    </table>

@foreach($transaksi->details as $detail)
<tr>
    <td>{{ $detail->product->nama ?? '-' }}</td>
    <td>{{ $detail->qty }}</td>
    <td>Rp {{ number_format($detail->harga,0,',','.') }}</td>
    <td>{{ $detail->diskon_persen ?? 0 }}%</td>
    <td>Rp {{ number_format($detail->subtotal,0,',','.') }}</td>
</tr>
@endforeach



 
<a href="{{ route('transaksi.cetak', $transaksi->id) }}" class="btn btn-success" target="_blank">
    Cetak Struk PDF
</a>
<a href="{{ route('transaksi.print', $transaksi->id) }}" target="_blank" class="btn btn-dark">
    🖨 Cetak Struk Thermal
</a>

@endsection
