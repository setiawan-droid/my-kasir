@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Tambah Produk</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Diskon (%)</label>
                <input type="number" name="diskon_persen" value="0" min="0" max="100" class="form-control">
            </div>


            </td>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
