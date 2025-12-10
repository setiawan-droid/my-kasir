<!DOCTYPE html>
<html>
<head>
    <title>Pencarian Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">
    <h2 class="text-center mb-4">Pencarian Produk</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('search.perform') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="query" class="form-control"
                               placeholder="Cari produk..." value="{{ $search_query }}">
                    </div>

                    <div class="col-md-4">
                        <select name="algorithm" class="form-select">
                            <option value="sequential" {{ $algorithm === 'sequential' ? 'selected' : '' }}>
                                Sequential Search
                            </option>
                            <option value="binary" {{ $algorithm === 'binary' ? 'selected' : '' }}>
                                Binary Search
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">Cari</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <h4>Daftar Produk</h4>
    <ul class="list-group mb-4">
        @foreach($products as $p)
            <li class="list-group-item">{{ $p['id'] }} — {{ $p['name'] }}</li>
        @endforeach
    </ul>

    @if($steps_taken)
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>Hasil Pencarian ({{ strtoupper($algorithm) }})</h5>

                @if($result)
                    <p><strong>Ditemukan:</strong> {{ $result['name'] }}</p>
                @else
                    <p class="text-danger"><strong>Produk tidak ditemukan.</strong></p>
                @endif

                <p><strong>Langkah yang dilakukan:</strong> {{ $steps_taken }}</p>

                <hr>

                <p class="text-success"><strong>{{ $best_case }}</strong></p>
                <p class="text-danger"><strong>{{ $worst_case }}</strong></p>
            </div>
        </div>
    @endif

</div>

</body>
</html>
