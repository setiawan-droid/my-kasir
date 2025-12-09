@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row">

    {{-- Card Total Transaksi Hari Ini --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h5>Total Transaksi Hari Ini</h5>
                <h3 class="fw-bold text-primary">Rp {{ number_format($totalHariIni, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    {{-- Card Jumlah Item Terjual --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h5>Item Terjual Hari Ini</h5>
                <h3 class="fw-bold text-success">{{ $qtyTerjualHariIni }} Item</h3>
            </div>
        </div>
    </div>

    {{-- Card Jumlah Transaksi --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h5>Jumlah Transaksi Hari Ini</h5>
                <h3 class="fw-bold text-warning">{{ $jumlahTransaksiHariIni }}</h3>
            </div>
        </div>
    </div>

</div>


{{-- Grafik Penjualan 7 Hari --}}
<div class="card shadow-sm border-0 mt-4">
    <div class="card-header">
        <strong>📊 Grafik Penjualan 7 Hari Terakhir</strong>
    </div>
    <div class="card-body">
        <canvas id="chartPenjualan"></canvas>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('chartPenjualan').getContext('2d');
    var chartPenjualan = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Total Penjualan (Rp)',
                data: {!! json_encode($data) !!},
                borderWidth: 3,
                tension: 0.3
            }]
        }
    });
</script>
@endsection
