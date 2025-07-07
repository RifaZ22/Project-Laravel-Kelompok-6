@extends('layouts.app')

@section('title', 'Welcome - Enamour.id')

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
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .hero-section {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px;
    }

    .hero-content {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 30px;
        padding: 60px 40px;
        max-width: 800px;
        width: 100%;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .brand-section {
        margin-bottom: 40px;
    }

    .logo {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .logo::before {
        content: '👟';
        font-size: 40px;
        filter: brightness(0) invert(1);
    }

    .brand-name {
        font-size: 42px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 15px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: fadeIn 1s ease-out 0.3s both;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .welcome-text {
        font-size: 24px;
        color: #4a5568;
        margin-bottom: 12px;
        font-weight: 600;
        animation: fadeIn 1s ease-out 0.5s both;
    }

    .subtitle {
        font-size: 16px;
        color: #718096;
        margin-bottom: 40px;
        line-height: 1.6;
        animation: fadeIn 1s ease-out 0.7s both;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
        animation: fadeIn 1s ease-out 0.9s both;
    }

    .feature-card {
        background: rgba(255, 255, 255, 0.7);
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        background: rgba(255, 255, 255, 0.9);
    }

    .feature-icon {
        font-size: 32px;
        margin-bottom: 15px;
        display: block;
    }

    .feature-title {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
    }

    .feature-description {
        font-size: 14px;
        color: #718096;
        line-height: 1.5;
    }

    .cta-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 30px;
        animation: fadeIn 1s ease-out 1.1s both;
    }

    .btn {
        padding: 16px 32px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        min-width: 160px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.9);
        color: #667eea;
        border: 2px solid #667eea;
    }

    .btn-secondary:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn:hover::before {
        left: 100%;
    }

    .stats-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 20px;
        margin-top: 20px;
        animation: fadeIn 1s ease-out 1.3s both;
    }

    .stat-item {
        text-align: center;
        padding: 15px;
    }

    .stat-number {
        font-size: 28px;
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

    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        padding: 15px 0;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .navbar.scrolled {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .navbar-content {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: #2d3748;
        font-weight: 700;
        font-size: 20px;
    }

    .navbar-logo {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .navbar-logo::before {
        content: '👟';
        font-size: 16px;
        filter: brightness(0) invert(1);
    }

    .navbar-nav {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .nav-link {
        color: #4a5568;
        text-decoration: none;
        font-weight: 500;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
    }

    .nav-link.btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 10px 20px;
        min-width: auto;
    }

    .hero-section {
        padding-top: 80px;
    }

    @media (max-width: 768px) {
        .hero-content {
            padding: 40px 25px;
            margin: 10px;
        }

        .brand-name {
            font-size: 32px;
        }

        .welcome-text {
            font-size: 20px;
        }

        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }

        .btn {
            width: 100%;
            max-width: 280px;
        }

        .features-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .navbar-content {
            flex-direction: column;
            gap: 15px;
        }

        .navbar-nav {
            flex-wrap: wrap;
            justify-content: center;
        }

        .hero-section {
            padding-top: 120px;
        }
    }

    @media (max-width: 480px) {
        .hero-content {
            padding: 30px 20px;
        }

        .brand-name {
            font-size: 28px;
        }

        .welcome-text {
            font-size: 18px;
        }

        .logo {
            width: 80px;
            height: 80px;
        }

        .logo::before {
            font-size: 32px;
        }
    }
</style>

<!-- Navigation -->
<nav class="navbar" id="navbar">
    <div class="navbar-content">
        <a href="#" class="navbar-brand">
            <div class="navbar-logo"></div>
            <span>Enamour.id</span>
        </a>
        <div class="navbar-nav">
            @guest
                <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                <a href="{{ route('register') }}" class="nav-link btn">Daftar</a>
            @else
                <a href="/dashboard" class="nav-link">Dashboard</a>
                <a href="#" class="nav-link">Profil</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer;">
                        Keluar
                    </button>
                </form>
            @endguest
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <div class="brand-section">
            <div class="logo"></div>
            <h1 class="brand-name">Enamour.id</h1>
            <p class="welcome-text">Selamat Datang di Toko Sepatu Premium</p>
            <p class="subtitle">
                Temukan koleksi sepatu terbaik dengan kualitas premium dan desain terkini. 
                Dari casual hingga formal, kami menyediakan berbagai pilihan untuk gaya hidup Anda.
            </p>
        </div>

        <!-- Features Grid -->
        <div class="features-grid">
            <div class="feature-card">
                <span class="feature-icon">🏆</span>
                <h3 class="feature-title">Kualitas Premium</h3>
                <p class="feature-description">Sepatu berkualitas tinggi dengan bahan pilihan terbaik</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">🚚</span>
                <h3 class="feature-title">Pengiriman Cepat</h3>
                <p class="feature-description">Gratis ongkir untuk pembelian minimal Rp 500.000</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">🔄</span>
                <h3 class="feature-title">Garansi Tukar</h3>
                <p class="feature-description">Garansi 30 hari untuk pertukaran ukuran</p>
            </div>
        </div>

        <!-- CTA Buttons -->
        <div class="cta-buttons">
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary">
                    <span>🎯</span>
                    Mulai Berbelanja
                </a>
                <a href="{{ route('login') }}" class="btn btn-secondary">
                    <span>👋</span>
                    Sudah Punya Akun?
                </a>
            @else
                <a href="/shop" class="btn btn-primary">
                    <span>🛍</span>
                    Jelajahi Koleksi
                </a>
                <a href="/dashboard" class="btn btn-secondary">
                    <span>⚡</span>
                    Dashboard Saya
                </a>
            @endguest
        </div>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="stat-item">
                <span class="stat-number">1000+</span>
                <span class="stat-label">Produk</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">50+</span>
                <span class="stat-label">Brand</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">10k+</span>
                <span class="stat-label">Pelanggan</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">4.8★</span>
                <span class="stat-label">Rating</span>
            </div>
        </div>
    </div>
</section>

<script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Smooth animations on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Add subtle hover effects to feature cards
        const featureCards = document.querySelectorAll('.feature-card');
        featureCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add click ripple effect to buttons
        const buttons = document.querySelectorAll('.btn');
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
        
        .btn {
            position: relative;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
</script>
@endsection