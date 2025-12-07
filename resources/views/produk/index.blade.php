@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Produk</h3>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>Rp {{ number_format($item->harga) }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>{{ $product->diskon_persen ?? 0 }}%</td>
                    <td>
                        <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('products.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada produk</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


@endsection
