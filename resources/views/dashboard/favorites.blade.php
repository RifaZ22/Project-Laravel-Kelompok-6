@extends('layouts.app')

@section('title', 'Daftar Favorit - Enamour.id')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 80%, rgba(255,255,255,0.1) 0%, transparent 50%);
        animation: float 6s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .favorites-container {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .page-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: slideDown 0.6s ease-out;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-title {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
    }

    .page-title h1 {
        font-size: 28px;
        font-weight: 700;
        color: #2d3748;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-title .icon {
        font-size: 32px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-subtitle {
        color: #718096;
        font-size: 16px;
        line-height: 1.6;
        position: relative;
        z-index: 1;
    }

    .back-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }

    .back-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .back-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .back-btn:hover::before {
        left: 100%;
    }

    .favorites-stats {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: fadeInUp 0.8s ease-out;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .stat-item {
        background: rgba(102, 126, 234, 0.1);
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        border: 1px solid rgba(102, 126, 234, 0.2);
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.2);
        background: rgba(102, 126, 234, 0.15);
    }

    .stat-number {
        font-size: 24px;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 8px;
        display: block;
    }

    .stat-label {
        font-size: 14px;
        color: #718096;
        font-weight: 500;
    }

    .favorites-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .search-filter {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: center;
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(102, 126, 234, 0.3);
        border-radius: 12px;
        padding: 12px 15px 12px 45px;
        font-size: 14px;
        width: 250px;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .search-box input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .search-box::before {
        content: '🔍';
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 16px;
        color: #718096;
    }

    .filter-select {
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(102, 126, 234, 0.3);
        border-radius: 12px;
        padding: 12px 15px;
        font-size: 14px;
        backdrop-filter: blur(10px);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .clear-all-btn {
        background: linear-gradient(135deg, #f56565, #e53e3e);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .clear-all-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(245, 101, 101, 0.3);
    }

    .favorites-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .favorite-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 0;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }

    .favorite-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .favorite-card:hover::before {
        transform: scaleX(1);
    }

    .favorite-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .card-image {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #f7fafc, #edf2f7);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .favorite-card:hover .card-image img {
        transform: scale(1.05);
    }

    .card-image::before {
        content: '👟';
        font-size: 48px;
        opacity: 0.3;
        position: absolute;
        z-index: 1;
    }

    .favorite-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(245, 101, 101, 0.9);
        color: white;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        backdrop-filter: blur(10px);
    }

    .card-content {
        padding: 25px;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
        line-height: 1.4;
    }

    .card-brand {
        font-size: 14px;
        color: #667eea;
        font-weight: 500;
        margin-bottom: 12px;
    }

    .card-price {
        font-size: 20px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 15px;
    }

    .card-price .original-price {
        font-size: 16px;
        color: #a0aec0;
        text-decoration: line-through;
        font-weight: 400;
        margin-left: 8px;
    }

    .card-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        flex: 1;
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .btn-remove {
        background: linear-gradient(135deg, #f56565, #e53e3e);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-remove:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(245, 101, 101, 0.3);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .empty-state-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        max-width: 500px;
        margin: 0 auto;
    }

    .empty-icon {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.6;
    }

    .empty-title {
        font-size: 24px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 15px;
    }

    .empty-message {
        color: #718096;
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .shop-now-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .shop-now-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(102, 126, 234, 0.3);
    }

    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: rgba(72, 187, 120, 0.95);
        color: white;
        padding: 15px 20px;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        transform: translateX(100%);
        transition: transform 0.3s ease;
        z-index: 1000;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .notification.show {
        transform: translateX(0);
    }

    .notification.error {
        background: rgba(245, 101, 101, 0.95);
    }

    @media (max-width: 768px) {
        .favorites-container {
            padding: 15px;
        }

        .page-header {
            padding: 20px;
        }

        .page-title h1 {
            font-size: 24px;
        }

        .favorites-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .search-filter {
            flex-direction: column;
        }

        .search-box input {
            width: 100%;
        }

        .favorites-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .favorites-container {
            padding: 10px;
        }

        .page-header {
            padding: 15px;
        }

        .page-title h1 {
            font-size: 20px;
        }

        .card-content {
            padding: 20px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .empty-state-card {
            padding: 30px 20px;
        }
    }
</style>

<div class="favorites-container">
    <!-- Back Button -->
    <a href="{{ route('dashboard') }}" class="back-btn">
        ← Kembali ke Dashboard
    </a>

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-title">
            <span class="icon">❤</span>
            <h1>Daftar Favorit Saya</h1>
        </div>
        <p class="page-subtitle">
            Kelola sepatu favorit Anda dan dapatkan notifikasi khusus ketika ada penawaran menarik!
        </p>
    </div>

    <!-- Favorites Stats -->
    <div class="favorites-stats">
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number">{{ $favoritesCount ?? 0 }}</span>
                <span class="stat-label">Total Favorit</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $availableCount ?? 0 }}</span>
                <span class="stat-label">Tersedia</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $discountCount ?? 0 }}</span>
                <span class="stat-label">Sedang Diskon</span>
            </div>
        </div>
    </div>

    <!-- Favorites Actions -->
    <div class="favorites-actions">
        <div class="search-filter">
            <div class="search-box">
                <input type="text" id="searchFavorites" placeholder="Cari sepatu favorit...">
            </div>
            <select class="filter-select" id="filterCategory">
                <option value="">Semua Kategori</option>
                <option value="sneakers">Sneakers</option>
                <option value="formal">Formal</option>
                <option value="casual">Casual</option>
                <option value="sport">Sport</option>
            </select>
            <select class="filter-select" id="filterBrand">
                <option value="">Semua Brand</option>
                <option value="nike">Nike</option>
                <option value="adidas">Adidas</option>
                <option value="converse">Converse</option>
                <option value="vans">Vans</option>
            </select>
        </div>
        <button class="clear-all-btn" onclick="clearAllFavorites()">
            🗑 Hapus Semua
        </button>
    </div>

    <!-- Favorites Grid -->
    <div class="favorites-grid" id="favoritesGrid">
        @forelse($favorites ?? [] as $favorite)
        <div class="favorite-card" 
     data-category="{{ $favorite->product->category ?? 'casual' }}" 
     data-brand="{{ $favorite->product->brand ?? 'nike' }}">
    <div class="card-image">
        <img src="{{ asset('storage/products/' . $favorite->product->image) }}" alt="{{ $favorite->product->name }}">
        <div class="favorite-badge">❤ Favorit</div>
    </div>
    <div class="card-content">
        <div class="card-brand">{{ $favorite->product->brand }}</div>
        <h3 class="card-title">{{ $favorite->product->name }}</h3>
        <div class="card-price">
            Rp {{ number_format($favorite->product->price, 0, ',', '.') }}
            @if($favorite->product->original_price && $favorite->product->original_price > $favorite->product->price)
                <span class="original-price">Rp {{ number_format($favorite->product->original_price, 0, ',', '.') }}</span>
            @endif
        </div>
        <div class="card-actions">
            <a href="{{ route('product.detail', $favorite->product->id) }}" class="btn-primary">
                👁 Lihat Detail
            </a>
            <button class="btn-remove" onclick="removeFromFavorites({{ $favorite->product->id }})">
                🗑
            </button>
        </div>
    </div>
</div>
        @empty
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-state-card">
                <div class="empty-icon">💔</div>
                <h2 class="empty-title">Belum Ada Favorit</h2>
                <p class="empty-message">
                    Anda belum menambahkan sepatu apapun ke daftar favorit. 
                    Mulai jelajahi koleksi kami dan temukan sepatu impian Anda!
                </p>
                <a href="/shop" class="shop-now-btn">
                    🛍 Mulai Belanja
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Notification -->
<div id="notification" class="notification">
    <span id="notificationIcon">✓</span>
    <span id="notificationMessage">Berhasil!</span>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchFavorites');
    const categoryFilter = document.getElementById('filterCategory');
    const brandFilter = document.getElementById('filterBrand');
    const favoritesGrid = document.getElementById('favoritesGrid');
    const favoriteCards = document.querySelectorAll('.favorite-card');

    function filterFavorites() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = categoryFilter.value;
        const selectedBrand = brandFilter.value;

        favoriteCards.forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const brand = card.querySelector('.card-brand').textContent.toLowerCase();
            const category = card.dataset.category;
            const cardBrand = card.dataset.brand;

            const matchesSearch = title.includes(searchTerm) || brand.includes(searchTerm);
            const matchesCategory = !selectedCategory || category === selectedCategory;
            const matchesBrand = !selectedBrand || cardBrand === selectedBrand;

            if (matchesSearch && matchesCategory && matchesBrand) {
                card.style.display = 'block';
                card.style.animation = 'fadeInUp 0.5s ease-out';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Add event listeners
    searchInput.addEventListener('input', filterFavorites);
    categoryFilter.addEventListener('change', filterFavorites);
    brandFilter.addEventListener('change', filterFavorites);

    // Add smooth animations for favorite cards
    favoriteCards.forEach((card, index) => {
        card.style.animationDelay = ${index * 0.1}s;
    });

    // Add hover effects to cards
    favoriteCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Add click ripple effect to buttons
    const buttons = document.querySelectorAll('.btn-primary, .btn-remove, .clear-all-btn, .shop-now-btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255, 255, 255, 0.5)';
            ripple.style.pointerEvents = 'none';
            ripple.style.animation = 'ripple 0.6s ease-out';
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Animate stats numbers
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        const finalValue = parseInt(stat.textContent);
        if (!isNaN(finalValue) && finalValue > 0) {
            let currentValue = 0;
            const increment = Math.ceil(finalValue / 20);
            const timer = setInterval(() => {
                currentValue += increment;
                if (currentValue >= finalValue) {
                    stat.textContent = finalValue;
                    clearInterval(timer);
                } else {
                    stat.textContent = currentValue;
                }
            }, 50);
        }
    });
});

// Remove from favorites function
function removeFromFavorites(productId) {
    if (confirm('Apakah Anda yakin ingin menghapus item ini dari favorit?')) {
        // Here you would make an AJAX request to your backend
        fetch(/favorites/${productId}, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove card from DOM
                const card = document.querySelector([data-product-id="${productId}"]);
                if (card) {
                    card.style.animation = 'fadeOut 0.5s ease-out';
                    setTimeout(() => {
                        card.remove();
                        updateStats();
                    }, 500);
                }
                showNotification('Item berhasil dihapus dari favorit', 'success');
            } else {
                showNotification('Gagal menghapus item dari favorit', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan', 'error');
        });
    }
}

// Clear all favorites function
function clearAllFavorites() {
    if (confirm('Apakah Anda yakin ingin menghapus semua item dari favorit?')) {
        // Here you would make an AJAX request to your backend
        fetch('/favorites/clear', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                showNotification('Gagal menghapus semua favorit', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan', 'error');
        });
    }
}

// Show notification function
function showNotification(message, type = 'success') {
    const notification = document.getElementById('notification');
    const notificationIcon = document.getElementById('notificationIcon');
    const notificationMessage = document.getElementById('notificationMessage');
    
    // Set content
    notificationMessage.textContent = message;
    
    // Set icon and style based on type
    if (type === 'success') {
        notificationIcon.textContent = '✓';
        notification.className = 'notification show';
    } else if (type === 'error') {
        notificationIcon.textContent = '✗';
        notification.className = 'notification error show';
    }
    
    // Hide after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
    }, 3000);
}

// Update stats function
function updateStats() {
    const remainingCards = document.querySelectorAll('.favorite-card').length;
    const statsNumbers = document.querySelectorAll('.stat-number');
    
    if (statsNumbers.length > 0) {
        statsNumbers[0].textContent = remainingCards;
    }
    
    // If no favorites left, show empty state
    if (remainingCards === 0) {
        const favoritesGrid = document.getElementById('favoritesGrid');
        favoritesGrid.innerHTML = `
            <div class="empty-state">
                <div class="empty-state-card">
                    <div class="empty-icon">💔</div>
                    <h2 class="empty-title">Belum Ada Favorit</h2>
                    <p class="empty-message">
                        Anda belum menambahkan sepatu apapun ke daftar favorit. 
                        Mulai jelajahi koleksi kami dan temukan sepatu impian Anda!
                    </p>
                    <a href="/shop" class="shop-now-btn">
                        🛍 Mulai Belanja
                    </a>
                </div>
            </div>
        `;
    }
}

// Add to cart function (if needed)
function addToCart(productId) {
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Produk berhasil ditambahkan ke keranjang', 'success');
        } else {
            showNotification('Gagal menambahkan produk ke keranjang', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan', 'error');
    });
}

// Add CSS for additional animations
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        0% {
            transform: scale(0);
            opacity: 1;
        }
        100% {
            transform: scale(2);
            opacity: 0;
        }
    }
    
    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }
    
    .btn-primary, .btn-remove, .clear-all-btn, .shop-now-btn {
        position: relative;
        overflow: hidden;
    }
    
    .favorite-card {
        transition: all 0.3s ease;
    }
    
    .favorite-card:hover .card-image::before {
        opacity: 0.5;
        transform: scale(1.1);
    }
    
    .card-actions {
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }
    
    .favorite-card:hover .card-actions {
        opacity: 1;
        transform: translateY(0);
    }
    
    .favorite-badge {
        animation: heartbeat 2s ease-in-out infinite;
    }
    
    @keyframes heartbeat {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .search-box input:focus::placeholder {
        color: transparent;
    }
    
    .filter-select:hover {
        border-color: #667eea;
    }
    
    .stat-item {
        cursor: pointer;
    }
    
    .stat-item:hover .stat-number {
        color: #764ba2;
        transform: scale(1.1);
    }
`;
document.head.appendChild(style);
</script>
@endsection