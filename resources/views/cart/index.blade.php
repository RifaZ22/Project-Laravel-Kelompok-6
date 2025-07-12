@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f5f7fa;
        font-family: 'Segoe UI', sans-serif;
    }

    .back-btn {
    display: inline-block;
    margin-bottom: 30px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    transition: 0.3s ease;
}

.back-btn:hover {
    background: linear-gradient(135deg, #5a67d8, #6b46c1);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}


    .cart-container {
        max-width: 900px;
        margin: 50px auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        text-align: center;
    }

    .cart-header {
        font-size: 32px;
        font-weight: 700;
        color: #333;
        margin-bottom: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .cart-header i {
        font-size: 30px;
        color: #3b82f6;
        margin-right: 12px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }

    .cart-item img {
        width: 80px;
        height: 80px;
        border-radius: 10px;
        object-fit: cover;
        margin-right: 20px;
    }

    .cart-item-details {
        text-align: left;
    }

    .cart-item-details .item-name {
        font-size: 18px;
        font-weight: bold;
        color: #222;
    }

    .cart-item-details .item-price,
    .cart-item-details .item-qty {
        font-size: 14px;
        color: #666;
    }

    .btn-remove {
        background: #ef4444;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-remove:hover {
        background: #dc2626;
    }

    .btn-shop {
        padding: 12px 30px;
        background: linear-gradient(to right, #3b82f6, #6366f1);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: bold;
        transition: background 0.3s, transform 0.2s;
        display: inline-block;
        margin-top: 20px;
    }

    .btn-shop:hover {
        background: linear-gradient(to right, #2563eb, #4f46e5);
        transform: translateY(-2px);
    }

    .cart-empty-icon {
        font-size: 70px;
        color: #cbd5e1;
        margin-bottom: 15px;
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in-out both;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="cart-container fade-in">
    <div class="cart-header">
        <i>🛍️</i> Keranjang Belanja Kamu
    </div>

    <a href="{{ route('shop.index') }}" class="back-btn">
    ← Kembali ke Toko
</a>



    @if(empty($cartItems))
        <div class="cart-empty">
            <div class="cart-empty-icon">🛒</div>
            <div class="cart-message">Keranjang kamu kosong</div>
            <div class="cart-subtext">Yuk, tambahkan sepatu keren ke dalam keranjangmu!</div>
            <a href="{{ route('dashboard') }}" class="btn-shop">Belanja Sekarang</a>
        </div>
    @else
        <div class="cart-products">
            @foreach($cartItems as $item)
    <div class="cart-item fade-in">
        <div style="display: flex; align-items: center;">
            <div class="cart-item-details">
                <div class="item-name">{{ $item->product->name }}</div>
                <div class="item-price">Harga: Rp{{ number_format($item->product->price, 0, ',', '.') }}</div>
                <div class="item-qty">Jumlah: {{ $item->quantity }}</div>
            </div>
        </div>
        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn-remove">Hapus</button>
        </form>
    </div>
@endforeach
        </div>

        <a href="{{ route('checkout.index') }}" class="btn-shop">Lanjut ke Checkout</a>
    @endif
</div>
@endsection
