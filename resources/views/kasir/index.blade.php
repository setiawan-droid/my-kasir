@extends('layouts.app', ['title' => 'Kasir'])

@section('content')

{{-- Notifikasi --}}
@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
@if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

<div class="row">
    {{-- Daftar Produk --}}
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <b>Pilih Produk</b>
            </div>
            <div class="card-body p-2">
                <form action="{{ route('kasir.add') }}" method="POST">
                    @csrf
                    <div class="input-group mb-2">
                        <select name="product_id" class="form-control" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($products as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }} - Rp {{ number_format($p->harga) }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="qty" class="form-control" value="1" min="1">
                        <button class="btn btn-success"><i class="fas fa-plus"></i></button>
                    </div>
                </form>

                <table class="table table-striped table-sm">
                    <thead class="bg-light">
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($cart as $id => $item)
                            @php $sub = $item['price'] * $item['qty']; $total += $sub; @endphp
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['qty'] }}</td>
                                <td>Rp {{ number_format($sub) }}</td>
                                <td>
                                    <form action="{{ route('kasir.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="table-success">
                            <th colspan="2">Total</th>
                            <th colspan="2">Rp {{ number_format($total) }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pembayaran --}}
    <div class="col-md-5">
        <form action="{{ route('kasir.checkout') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header bg-success text-white">
                    <b>Pembayaran</b>
                </div>
                <div class="card-body">
                    <label>Diskon Transaksi (%)</label>
                    <input type="number" name="diskon_persen" class="form-control mb-2" value="0" min="0" max="100">

                    <label>Bayar (Rp)</label>
                    <input type="number" name="bayar" class="form-control mb-2" required>

                    <label>Nomor WA (opsional)</label>
                    <input type="text" name="wa" class="form-control mb-3">

                    <button class="btn btn-success btn-lg w-100">
                        <i class="fas fa-check-circle"></i> Proses Pembayaran
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
