<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'MY KASIR' }}</title>

    <!-- AdminLTE & Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">

    <style>
        .content-wrapper { padding: 20px }
        .table td, .table th { vertical-align: middle }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    {{-- Navbar --}}
    <nav class="main-header navbar navbar-expand navbar-dark bg-dark">
        <span class="navbar-brand ml-2">💰 Aplikasi Kasir</span>
    </nav>

    {{-- Sidebar --}}
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link"><i class="nav-icon fas fa-home"></i><p>Dashboard</p></a></li>
                    <li class="nav-item"><a href="{{ route('kasir.index') }}" class="nav-link"><i class="nav-icon fas fa-cash-register"></i><p>Kasir</p></a></li>
                    <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link"><i class="nav-icon fas fa-box"></i><p>Produk</p></a></li>
                    <li class="nav-item"><a href="{{ route('transaksi.histori') }}" class="nav-link"><i class="nav-icon fas fa-history"></i><p>Riwayat Transaksi</p></a></li>
                </ul>
            </nav>
        </div>
    </aside>

    {{-- Content --}}
    <div class="content-wrapper">
        <h4 class="mb-3">{{ $title ?? '' }}</h4>
        @yield('content')
    </div>

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
