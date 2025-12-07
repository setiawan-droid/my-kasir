<!DOCTYPE html>
<html>
<head>
    <title>My Kasir</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/kasir') }}">My Kasir</a>

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">

        <li class="nav-item">
          <a class="nav-link" href="{{ url('/kasir') }}">Kasir</a>
        </li>

        <li class="nav-item">
         <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('kasir.histori') }}">Histori Transaksi</a>
        </li>
          <li class="nav-item">
        <a class="nav-link" href="{{ route('laporan.index') }}">
            📄 Laporan Transaksi
        </a>
    </li>
      </ul>

      

     
    </div>
  </div>
</nav>

<div class="container">
  @yield('content')
</div>

</body>
</html>
