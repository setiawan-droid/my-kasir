@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Laporan Transaksi</h3>
    <form action="{{ route('laporan.cetak') }}" method="GET" target="_blank">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label>Tanggal Awal</label>
                <input type="date" name="awal" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label>Tanggal Akhir</label>
                <input type="date" name="akhir" class="form-control" required>
            </div>
            <div class="col-md-4" style="padding-top:30px">
                <button class="btn btn-primary">Cetak PDF</button>
            </div>
        </div>
    </form>
</div>
@endsection
