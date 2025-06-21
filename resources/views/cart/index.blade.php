<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">🛒 Keranjang Belanja</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($cartItems as $item)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5>{{ $item->product->name }}</h5>
                    <p class="mb-1">Harga: Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                    <p class="mb-0">Jumlah: {{ $item->quantity }}</p>
                </div>
                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Keranjang kosong😅</div>
    @endforelse
</div>

</body>
</html>
