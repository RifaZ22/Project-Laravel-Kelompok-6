@extends('layouts.app')

@section('title', 'Riwayat Pesanan - Enamour.id')

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

    .orders-container {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .navbar {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 20px 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: slideDown 0.6s ease-out;
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

    .navbar-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .navbar-logo {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .navbar-logo::before {
        content: '👟';
        font-size: 20px;
        filter: brightness(0) invert(1);
    }

    .brand-info h1 {
        font-size: 24px;
        font-weight: 700;
        color: #2d3748;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 4px;
    }

    .brand-info p {
        color: #718096;
        font-size: 14px;
        font-weight: 500;
    }

    .back-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .back-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .page-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: fadeInUp 0.8s ease-out;
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

    .page-header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #2d3748;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-header p {
        color: #718096;
        font-size: 16px;
        line-height: 1.6;
    }

    .orders-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
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

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .stat-icon {
        font-size: 24px;
        margin-bottom: 10px;
        display: block;
    }

    .stat-number {
        font-size: 24px;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 5px;
        display: block;
    }

    .stat-label {
        font-size: 14px;
        color: #718096;
        font-weight: 500;
    }

    .filter-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: fadeInUp 0.8s ease-out 0.4s both;
    }

    .filter-controls {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    .filter-controls label {
        font-weight: 600;
        color: #2d3748;
        font-size: 14px;
    }

    .filter-controls select {
        padding: 8px 12px;
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 8px;
        font-size: 14px;
        color: #2d3748;
        background: white;
        transition: all 0.3s ease;
    }

    .filter-controls select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .orders-list {
        animation: fadeInUp 0.8s ease-out 0.6s both;
    }

    .order-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .order-card::before {
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

    .order-card:hover::before {
        transform: scaleX(1);
    }

    .order-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .order-info h3 {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 5px;
    }

    .order-date {
        font-size: 14px;
        color: #718096;
        margin-bottom: 5px;
    }

    .order-total {
        font-size: 16px;
        font-weight: 700;
        color: #667eea;
    }

    .order-status {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background: rgba(255, 193, 7, 0.2);
        color: #856404;
        border: 1px solid rgba(255, 193, 7, 0.3);
    }

    .status-processing {
        background: rgba(0, 123, 255, 0.2);
        color: #0056b3;
        border: 1px solid rgba(0, 123, 255, 0.3);
    }

    .status-shipped {
        background: rgba(102, 126, 234, 0.2);
        color: #4c63d2;
        border: 1px solid rgba(102, 126, 234, 0.3);
    }

    .status-delivered {
        background: rgba(40, 167, 69, 0.2);
        color: #155724;
        border: 1px solid rgba(40, 167, 69, 0.3);
    }

    .status-cancelled {
        background: rgba(220, 53, 69, 0.2);
        color: #721c24;
        border: 1px solid rgba(220, 53, 69, 0.3);
    }

    .order-items {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 20px;
    }

    .order-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: rgba(102, 126, 234, 0.05);
        border-radius: 12px;
        border: 1px solid rgba(102, 126, 234, 0.1);
    }

    .item-image {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        flex-shrink: 0;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-size: 16px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 5px;
    }

    .item-specs {
        font-size: 14px;
        color: #718096;
        margin-bottom: 5px;
    }

    .item-price {
        font-size: 14px;
        font-weight: 600;
        color: #667eea;
    }

    .item-quantity {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        min-width: 40px;
        text-align: center;
    }

    .order-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .action-btn {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }

    .btn-secondary {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        border: 1px solid rgba(102, 126, 234, 0.3);
    }

    .btn-danger {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.3);
    }

    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .empty-icon {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-title {
        font-size: 24px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 12px;
    }

    .empty-text {
        font-size: 16px;
        color: #718096;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .empty-action {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 15px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .empty-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(102, 126, 234, 0.3);
    }

    @media (max-width: 768px) {
        .orders-container {
            padding: 15px;
        }

        .navbar {
            padding: 20px;
        }

        .navbar-content {
            flex-direction: column;
            text-align: center;
        }

        .page-header {
            padding: 25px;
        }

        .page-header h1 {
            font-size: 28px;
        }

        .orders-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .filter-controls {
            flex-direction: column;
            align-items: stretch;
        }

        .order-header {
            flex-direction: column;
            align-items: stretch;
        }

        .order-item {
            flex-direction: column;
            text-align: center;
        }

        .order-actions {
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .orders-container {
            padding: 10px;
        }

        .navbar {
            padding: 15px;
        }

        .page-header {
            padding: 20px;
        }

        .page-header h1 {
            font-size: 24px;
        }

        .orders-stats {
            grid-template-columns: 1fr;
        }

        .order-card {
            padding: 20px;
        }

        .item-image {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }
    }
</style>

<div class="orders-container">
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-content">
            <div class="navbar-brand">
                <div class="navbar-logo"></div>
                <div class="brand-info">
                    <h1>Enamour.id</h1>
                    <p>Riwayat Pesanan</p>
                </div>
            </div>
            
            <div class="navbar-actions">
                <a href="/dashboard" class="back-btn">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1>📦 Riwayat Pesanan</h1>
        <p>Kelola dan pantau semua pesanan Anda di sini. Lacak status pengiriman, lihat detail pembelian, dan download invoice.</p>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-controls">
            <label for="status-filter">Status:</label>
            <select id="status-filter">
                <option value="">Semua Status</option>
                <option value="pending">Menunggu</option>
                <option value="processing">Diproses</option>
                <option value="shipped">Dikirim</option>
                <option value="delivered">Selesai</option>
                <option value="cancelled">Dibatalkan</option>
            </select>

            <label for="date-filter">Periode:</label>
            <select id="date-filter">
                <option value="">Semua Waktu</option>
                <option value="today">Hari Ini</option>
                <option value="week">Minggu Ini</option>
                <option value="month">Bulan Ini</option>
                <option value="year">Tahun Ini</option>
            </select>
        </div>
    </div>

    <!-- Orders List -->
    <div class="orders-list">
        <!-- Sample Order Card - Replace with dynamic data -->
        <div class="order-card">
            <div class="order-header">
                <div class="order-info">
                    <h3>Order #ORD-2024-001</h3>
                    <div class="order-date">12 Januari 2024, 14:30</div>
                    <div class="order-total">Total: Rp 1.250.000</div>
                </div>
                <div class="order-status status-delivered">
                    Selesai
                </div>
            </div>
            
            <div class="order-items">
                <div class="order-item">
                    <div class="item-image">👟</div>
                    <div class="item-details">
                        <div class="item-name">Nike Air Max 270</div>
                        <div class="item-specs">Size: 42, Color: Black</div>
                        <div class="item-price">Rp 1.250.000</div>
                    </div>
                    <div class="item-quantity">1x</div>
                </div>
            </div>
            
            <div class="order-actions">
                <a href="#" class="action-btn btn-primary">📄 Invoice</a>
                <a href="#" class="action-btn btn-secondary">🔄 Beli Lagi</a>
            </div>
        </div>

        <div class="order-card">
            <div class="order-header">
                <div class="order-info">
                    <h3>Order #ORD-2024-002</h3>
                    <div class="order-date">10 Januari 2024, 09:15</div>
                    <div class="order-total">Total: Rp 2.100.000</div>
                </div>
                <div class="order-status status-shipped">
                    Dikirim
                </div>
            </div>
            
            <div class="order-items">
                <div class="order-item">
                    <div class="item-image">👟</div>
                    <div class="item-details">
                        <div class="item-name">Adidas Ultraboost 22</div>
                        <div class="item-specs">Size: 43, Color: White</div>
                        <div class="item-price">Rp 2.100.000</div>
                    </div>
                    <div class="item-quantity">1x</div>
                </div>
            </div>
            
            <div class="order-actions">
                <a href="#" class="action-btn btn-primary">📍 Lacak</a>
                <a href="#" class="action-btn btn-secondary">📄 Invoice</a>
            </div>
        </div>

        <div class="order-card">
            <div class="order-header">
                <div class="order-info">
                    <h3>Order #ORD-2024-003</h3>
                    <div class="order-date">8 Januari 2024, 16:45</div>
                    <div class="order-total">Total: Rp 3.750.000</div>
                </div>
                <div class="order-status status-processing">
                    Diproses
                </div>
            </div>
            
            <div class="order-items">
                <div class="order-item">
                    <div class="item-image">👟</div>
                    <div class="item-details">
                        <div class="item-name">Jordan Air 1 High</div>
                        <div class="item-specs">Size: 41, Color: Red/Black</div>
                        <div class="item-price">Rp 1.850.000</div>
                    </div>
                    <div class="item-quantity">1x</div>
                </div>
                <div class="order-item">
                    <div class="item-image">👟</div>
                    <div class="item-details">
                        <div class="item-name">Converse Chuck Taylor</div>
                        <div class="item-specs">Size: 42, Color: White</div>
                        <div class="item-price">Rp 900.000</div>
                    </div>
                    <div class="item-quantity">1x</div>
                </div>
            </div>
            
            <div class="order-actions">
                <a href="#" class="action-btn btn-secondary">📄 Invoice</a>
                <a href="#" class="action-btn btn-danger">❌ Batalkan</a>
            </div>
        </div>

        <!-- Empty State - Show when no orders -->
        <!-- <div class="empty-state">
            <div class="empty-icon">📦</div>
            <h2 class="empty-title">Belum Ada Pesanan</h2>
            <p class="empty-text">
                Anda belum memiliki riwayat pesanan. Mulai berbelanja sekarang dan temukan sepatu impian Anda!
            </p>
            <a href="/shop" class="empty-action">
                🛍 Mulai Belanja
            </a>
        </div> -->
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate order cards on load
        const orderCards = document.querySelectorAll('.order-card');
        orderCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Filter functionality
        const statusFilter = document.getElementById('status-filter');
        const dateFilter = document.getElementById('date-filter');

        statusFilter.addEventListener('change', function() {
            filterOrders();
        });

        dateFilter.addEventListener('change', function() {
            filterOrders();
        });

        function filterOrders() {
            const statusValue = statusFilter.value;
            const dateValue = dateFilter.value;
            
            orderCards.forEach(card => {
                let showCard = true;
                
                // Filter by status
                if (statusValue) {
                    const statusElement = card.querySelector('.order-status');
                    if (statusElement && !statusElement.classList.contains(`status-${statusValue}`)) {
                        showCard = false;
                    }
                }
                
                // Add date filtering logic here if needed
                
                // Show/hide card with animation
                if (showCard) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeInUp 0.5s ease-out';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Add hover effects to action buttons
        const actionButtons = document.querySelectorAll('.action-btn');
        actionButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Add ripple effect
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

        // Animate stats on load
        const statNumbers = document.querySelectorAll('.stat-number');
        statNumbers.forEach(stat => {
            const finalValue = stat.textContent;
            if (!isNaN(finalValue) && finalValue !== '0') {
                let currentValue = 0;
                const increment = finalValue / 20;
                const timer = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= finalValue) {
                        stat.textContent = finalValue;
                        clearInterval(timer);
                    } else {
                        stat.textContent = Math.floor(currentValue);
                    }
                }, 50);
            }
        });

        // Search functionality (if search input exists)
        const searchInput = document.getElementById('search-orders');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                orderCards.forEach(card => {
                    const orderNumber = card.querySelector('.order-info h3').textContent.toLowerCase();
                    const itemNames = Array.from(card.querySelectorAll('.item-name')).map(item => item.textContent.toLowerCase());
                    const shouldShow = orderNumber.includes(searchTerm) || itemNames.some(name => name.includes(searchTerm));
                    
                    if (shouldShow) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeInUp 0.5s ease-out';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }

        // Add smooth scroll to top button
        const scrollTopBtn = document.createElement('button');
        scrollTopBtn.innerHTML = '↑';
        scrollTopBtn.className = 'scroll-top-btn';
        scrollTopBtn.style.cssText = `
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            z-index: 1000;
        `;
        
        document.body.appendChild(scrollTopBtn);
        
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Show/hide scroll to top button
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                scrollTopBtn.style.opacity = '1';
                scrollTopBtn.style.visibility = 'visible';
            } else {
                scrollTopBtn.style.opacity = '0';
                scrollTopBtn.style.visibility = 'hidden';
            }
        });

        // Add loading state for action buttons
        const loadingButtons = document.querySelectorAll('.action-btn');
        loadingButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const originalText = this.innerHTML;
                this.innerHTML = '⏳ Loading...';
                this.disabled = true;
                this.style.opacity = '0.6';
                
                // Simulate API call
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                    this.style.opacity = '1';
                }, 1500);
            });
        });

        // Add order status tracking simulation
        const trackButtons = document.querySelectorAll('.action-btn[href="#"]:contains("📍")');
        trackButtons.forEach(button => {
            if (button.textContent.includes('Lacak')) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Show tracking modal (you can implement this)
                    alert('Fitur pelacakan akan segera tersedia!');
                });
            }
        });

        // Add print invoice functionality
        const invoiceButtons = document.querySelectorAll('.action-btn[href="#"]:contains("📄")');
        invoiceButtons.forEach(button => {
            if (button.textContent.includes('Invoice')) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Simulate invoice download
                    const orderCard = this.closest('.order-card');
                    const orderNumber = orderCard.querySelector('.order-info h3').textContent;
                    
                    // Create a temporary link for download simulation
                    const link = document.createElement('a');
                    link.href = '#';
                    link.download = `invoice-${orderNumber}.pdf`;
                    
                    // Show success message
                    this.innerHTML = '✅ Downloaded';
                    setTimeout(() => {
                        this.innerHTML = '📄 Invoice';
                    }, 2000);
                });
            }
        });

        // Add cancel order functionality
        const cancelButtons = document.querySelectorAll('.btn-danger');
        cancelButtons.forEach(button => {
            if (button.textContent.includes('Batalkan')) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
                        const orderCard = this.closest('.order-card');
                        const statusElement = orderCard.querySelector('.order-status');
                        
                        // Update status
                        statusElement.className = 'order-status status-cancelled';
                        statusElement.textContent = 'Dibatalkan';
                        
                        // Hide cancel button
                        this.style.display = 'none';
                        
                        // Show success message
                        const successMsg = document.createElement('div');
                        successMsg.textContent = 'Pesanan berhasil dibatalkan';
                        successMsg.style.cssText = `
                            color: #dc3545;
                            font-size: 14px;
                            font-weight: 500;
                            margin-top: 10px;
                        `;
                        this.parentNode.appendChild(successMsg);
                        
                        setTimeout(() => {
                            successMsg.remove();
                        }, 3000);
                    }
                });
            }
        });

        // Add reorder functionality
        const reorderButtons = document.querySelectorAll('.action-btn[href="#"]:contains("🔄")');
        reorderButtons.forEach(button => {
            if (button.textContent.includes('Beli Lagi')) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Get order items
                    const orderCard = this.closest('.order-card');
                    const items = orderCard.querySelectorAll('.item-name');
                    
                    let itemList = '';
                    items.forEach(item => {
                        itemList += `• ${item.textContent}\n`;
                    });
                    
                    if (confirm(`Tambahkan item berikut ke keranjang?\n\n${itemList}`)) {
                        this.innerHTML = '✅ Ditambahkan';
                        setTimeout(() => {
                            this.innerHTML = '🔄 Beli Lagi';
                        }, 2000);
                    }
                });
            }
        });
    });

    // Add CSS for ripple animation
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
        
        .action-btn {
            position: relative;
            overflow: hidden;
        }
        
        .scroll-top-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }
    `;
    document.head.appendChild(style);
</script>
@endsection