@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Kasir</h3>

    {{-- Form pilih produk untuk keranjang --}}
    <form action="{{ route('kasir.add') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <select name="product_id" class="form-control" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->nama }} - Rp{{ number_format($product->harga) }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <input type="number" name="qty" min="1" class="form-control" placeholder="Qty" required>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </form>
    <hr>

    {{-- Tabel keranjang --}}
    <h4>Keranjang Belanja</h4>
    <table class="table table-bordered">
        <tr>
            <th>Produk</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
        @php $total = 0; @endphp
        @foreach ($cart as $item)
        @php $subtotal = $item['qty'] * $item['price']; $total += $subtotal; @endphp
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['qty'] }}</td>
            <td>Rp{{ number_format($item['price']) }}</td>
            <td>Rp{{ number_format($subtotal) }}</td>
        </tr>
        @endforeach
        <tr>
            <th colspan="3">Total</th>
            <th>Rp{{ number_format($total) }}</th>
        </tr>
    </table>

    {{-- Form checkout --}}
    <form action="{{ route('kasir.checkout') }}" method="POST">
        @csrf
        <input type="hidden" name="total" value="{{ $total }}">
       <label>Diskon Transaksi (%)</label>
        <input type="number" name="diskon_persen" value="0" min="0" max="100" class="form-control">


        <div class="mb-3">
            <label>Bayar</label>
            <input type="number" name="bayar" min="0" step="any" class="form-control" required>

        </div>
  
        <button class="btn btn-success">Checkout</button>
    </form>

</div>
@endsection
