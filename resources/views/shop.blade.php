@extends('layouts.app')

@section('title', 'Shop - Enamour.id | Koleksi Sepatu Terlengkap')

@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .hero-section {
        text-align: center;
        padding: 60px 20px 40px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9));
        color: white;
        margin-bottom: 40px;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 15px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        animation: fadeInUp 1s ease-out;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 30px;
        animation: fadeInUp 1s ease-out 0.2s both;
    }

    .search-bar {
        max-width: 500px;
        margin: 0 auto;
        position: relative;
        animation: fadeInUp 1s ease-out 0.4s both;
    }

    .search-input {
        width: 100%;
        padding: 15px 50px 15px 20px;
        border: none;
        border-radius: 50px;
        font-size: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        outline: none;
    }

    .search-btn {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .search-btn:hover {
        transform: translateY(-50%) scale(1.1);
    }

    .filter-section {
        max-width: 1200px;
        margin: 0 auto 40px;
        padding: 0 20px;
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
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


    .filter-btn {
        padding: 12px 24px;
        border: none;
        border-radius: 25px;
        background: rgba(255,255,255,0.9);
        color: #667eea;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .filter-btn:hover, .filter-btn.active {
        background: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .shop-container {
        padding: 0 20px 60px;
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
    }

    .product-card {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(15px);
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0,0,0,0.2);
    }

    .product-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
        color: white;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 600;
        z-index: 2;
        animation: pulse 2s infinite;
    }

    .product-image-container {
        position: relative;
        overflow: hidden;
        height: 250px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .product-card:hover .product-image {
        transform: scale(1.15) rotate(2deg);
    }

    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8));
        opacity: 0;
        transition: 0.4s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-card:hover .product-overlay {
        opacity: 1;
    }

    .quick-view-btn {
        background: white;
        color: #667eea;
        border: none;
        padding: 12px 20px;
        border-radius: 25px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s ease;
        transform: translateY(20px);
    }

    .product-card:hover .quick-view-btn {
        transform: translateY(0);
    }

    .product-info {
        padding: 25px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-category {
        font-size: 12px;
        color: #667eea;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .product-name {
        font-size: 20px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 12px;
        line-height: 1.3;
    }

    .product-desc {
        font-size: 14px;
        color: #718096;
        line-height: 1.5;
        margin-bottom: 15px;
        flex: 1;
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 15px;
    }

    .stars {
        color: #ffd700;
        font-size: 14px;
    }

    .rating-text {
        font-size: 12px;
        color: #718096;
    }

    .product-price-section {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .product-price {
        font-size: 20px;
        font-weight: 800;
        color: #667eea;
    }

    .product-price-old {
        font-size: 16px;
        color: #cbd5e0;
        text-decoration: line-through;
    }

    .discount-badge {
        background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
        color: white;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 600;
    }

    .size-selector {
        margin-bottom: 15px;
    }

    .size-label {
        font-size: 12px;
        color: #4a5568;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    .size-options {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .size-option {
        width: 35px;
        height: 35px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .size-option:hover, .size-option.selected {
        border-color: #667eea;
        background: #667eea;
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }

    .action-btn {
        padding: 12px 20px;
        border: none;
        border-radius: 15px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 14px;
    }

    .buy-now-btn {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        flex: 1;
    }

    .buy-now-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
    }

    .add-to-cart-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        flex: 1;
    }

    .add-to-cart-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    .favorite-btn {
        background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
        color: white;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .favorite-btn:hover {
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 8px 20px rgba(255, 107, 107, 0.4);
    }

    .action-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: 0.5s ease;
    }

    .action-btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .loading-spinner {
        display: none;
        width: 20px;
        height: 20px;
        border: 2px solid transparent;
        border-top: 2px solid currentColor;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .floating-cart {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
        cursor: pointer;
        transition: 0.3s ease;
        z-index: 1000;
    }

    .floating-cart:hover {
        transform: scale(1.1);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
    }

    .cart-count {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 25px;
        height: 25px;
        background: #ff6b6b;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .shop-container {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        
        .filter-section {
            padding: 0 10px;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .favorite-btn {
            width: 100%;
            height: 45px;
            border-radius: 15px;
        }
    }
</style>

{{-- Hero Section --}}
<div class="hero-section">
    <h1 class="hero-title">👟 Koleksi Sepatu Enamour.Id</h1>
    <p class="hero-subtitle">Temukan sepatu impian Anda dengan kualitas terbaik dan harga terjangkau</p>
</div>

<a href="{{ route('dashboard') }}" class="back-btn">
    ← Kembali ke Dashboard
</a>


{{-- Products Grid --}}
<div class="shop-container">
    @foreach($products as $product)
    <div class="product-card">
        <div class="product-badge">New</div>
        
        <div class="product-image-container">
            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
            
        </div>
        
        <div class="product-info">
            <div class="product-category">Sepatu</div>
            <div class="product-name">{{ $product->name }}</div>
            <div class="product-desc">{{ Str::limit($product->description, 80) }}</div>
            
            <div class="product-rating">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <span class="rating-text">(4.8) • 127 reviews</span>
            </div>
            
            <div class="product-price-section">
                <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                <div class="product-price-old">Rp {{ number_format($product->price * 1.2, 0, ',', '.') }}</div>
                <div class="discount-badge">-17%</div>
            </div>
            
            <div class="size-selector">
                <label class="size-label">Ukuran:</label>
                <div class="size-options">
                    <div class="size-option">38</div>
                    <div class="size-option">39</div>
                    <div class="size-option selected">40</div>
                    <div class="size-option">41</div>
                    <div class="size-option">42</div>
                </div>
            </div>
            
            <div class="action-buttons">
                {{-- Tombol Beli Sekarang --}}
                <form action="{{ route('checkout.direct') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <button type="submit" class="btn-buy-now">🛒 Beli Sekarang</button>
</form>

                
                {{-- Tombol Tambah ke Keranjang --}}
    <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="quantity" value="1">
        <button type="submit" class="action-btn add-to-cart-btn">
            🛒 Keranjang
        </button>
    </form>

                
                {{-- Tombol Tambah ke Favorit --}}
    <form action="{{ route('favorite.store', $product->id) }}" method="POST">
        @csrf
        <button type="submit" class="action-btn favorite-btn" title="Tambah ke Favorit">
            ❤️
        </button>
    </form>

            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Floating Cart --}}
{{-- Floating Cart --}}
<a href="{{ route('cart.index') }}" class="floating-cart">
    <span>🛒</span>
    <div class="cart-count">{{ count(session('cart', [])) }}</div>
</a>


<script>
    function addToCart(productId) {
    fetch("{{ route('cart.add') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message); // Ganti dengan notifikasi stylish jika ingin
        }
    });
}
document.addEventListener('DOMContentLoaded', function() {
    // Size selector functionality
    document.querySelectorAll('.size-option').forEach(option => {
        option.addEventListener('click', function() {
            // Remove selected class from siblings
            this.parentNode.querySelectorAll('.size-option').forEach(sibling => {
                sibling.classList.remove('selected');
            });
            // Add selected class to clicked option
            this.classList.add('selected');
        });
    });
    
    // Filter functionality
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Search functionality
    document.querySelector('.search-btn').addEventListener('click', function() {
        const searchTerm = document.querySelector('.search-input').value;
        if (searchTerm) {
            // Implementasi pencarian
            console.log('Searching for:', searchTerm);
        }
    });
    
    // Add loading state to buttons
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const spinner = this.querySelector('.loading-spinner');
            const text = this.querySelector('span');
            
            if (spinner && text) {
                text.style.display = 'none';
                spinner.style.display = 'block';
                
                // Reset after 2 seconds (replace with actual submission)
                setTimeout(() => {
                    text.style.display = 'flex';
                    spinner.style.display = 'none';
                }, 2000);
            }
        });
    });
    
    // Floating cart click
    document.querySelector('.floating-cart').addEventListener('click', function() {
        window.location.href = '/cart';
    });
});
</script>
@endsection