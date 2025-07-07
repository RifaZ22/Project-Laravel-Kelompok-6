@extends('layouts.app')

@section('title', 'Shop - Enamour.id')

@section('content')
<style>
    .shop-container {
        padding: 40px 20px;
        max-width: 1200px;
        margin: auto;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 25px;
    }

    .product-card {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transition: 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    .product-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-info {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-name {
        font-size: 18px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 10px;
    }

    .product-desc {
        font-size: 14px;
        color: #718096;
        flex: 1;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 16px;
        font-weight: 600;
        color: #667eea;
        margin-bottom: 15px;
    }

    .add-to-cart-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s ease;
    }

    .add-to-cart-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }
</style>

<div class="shop-container">
    @foreach($products as $product)
    <div class="product-card">
        <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
        <div class="product-info">
            <div class="product-name">{{ $product->name }}</div>
            <div class="product-desc">{{ $product->description }}</div>
            <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
            <a href="#" class="add-to-cart-btn">🛒 Tambah ke Keranjang</a>
        </div>
    </div>
    @endforeach
</div>
@endsection