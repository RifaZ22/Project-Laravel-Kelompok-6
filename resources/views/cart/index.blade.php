@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f5f7fa;
        font-family: 'Segoe UI', sans-serif;
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
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .cart-header i {
        font-size: 30px;
        color: #3b82f6;
        margin-right: 12px;
    }

    .cart-empty-icon {
        font-size: 70px;
        color: #cbd5e1;
        margin-bottom: 15px;
    }

    .cart-message {
        font-size: 20px;
        color: #555;
        margin-bottom: 10px;
    }

    .cart-subtext {
        color: #888;
        font-size: 15px;
        margin-bottom: 25px;
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
    }

    .btn-shop:hover {
        background: linear-gradient(to right, #2563eb, #4f46e5);
        transform: translateY(-2px);
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

    @if(count($cartItems) === 0)
        <div class="cart-empty">
            <div class="cart-empty-icon">🛒</div>
            <div class="cart-message">Keranjang kamu kosong</div>
            <div class="cart-subtext">Yuk, Tambahkan sepatu keren ke dalam keranjangmu!</div>
            <a href="{{ route('products.index') }}" class="btn-shop">Belanja Sekarang</a>
        </div>
    @else
        {{-- Nanti di sini kamu bisa menambahkan tampilan list produk --}}
    @endif
</div>
@endsection