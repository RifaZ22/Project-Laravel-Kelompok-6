@extends('layouts.app')

@section('title', 'Dashboard - Enamour.id')

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

    .dashboard-container {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        padding: 20px;
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
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
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

    .navbar-actions {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(102, 126, 234, 0.1);
        padding: 10px 16px;
        border-radius: 12px;
        border: 1px solid rgba(102, 126, 234, 0.2);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 16px;
    }

    .user-details h3 {
        font-size: 16px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 2px;
    }

    .user-details p {
        font-size: 12px;
        color: #718096;
    }

    .logout-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        position: relative;
        overflow: hidden;
    }

    .logout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .logout-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .logout-btn:hover::before {
        left: 100%;
    }

    .dashboard-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 30px;
    }

    .welcome-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: fadeInLeft 0.8s ease-out;
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
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

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .welcome-card h2 {
        font-size: 28px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 12px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
        z-index: 1;
    }

    .welcome-card p {
        color: #718096;
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 25px;
        position: relative;
        z-index: 1;
    }

    .explore-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 14px 24px;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 15px;
        position: relative;
        overflow: hidden;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .explore-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(102, 126, 234, 0.3);
    }

    .quick-stats {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: fadeInRight 0.8s ease-out;
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .quick-stats h3 {
        font-size: 22px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
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

    .features-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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

    .feature-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
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

    .feature-card:hover::before {
        transform: scaleX(1);
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .feature-icon {
        font-size: 32px;
        margin-bottom: 15px;
        display: block;
    }

    .feature-title {
        font-size: 20px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 12px;
    }

    .feature-description {
        color: #718096;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .feature-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 13px;
        text-decoration: none;
        display: inline-block;
    }

    .feature-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3);
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 15px;
        }

        .navbar {
            padding: 20px;
        }

        .navbar-content {
            flex-direction: column;
            text-align: center;
        }

        .navbar-brand {
            justify-content: center;
        }

        .user-info {
            flex-direction: column;
            text-align: center;
        }

        .dashboard-content {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .welcome-card, .quick-stats {
            padding: 25px;
        }

        .welcome-card h2 {
            font-size: 24px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .features-section {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .dashboard-container {
            padding: 10px;
        }

        .navbar {
            padding: 15px;
            margin-bottom: 20px;
        }

        .brand-info h1 {
            font-size: 20px;
        }

        .welcome-card, .quick-stats, .feature-card {
            padding: 20px;
        }

        .welcome-card h2 {
            font-size: 22px;
        }

        .navbar-logo {
            width: 40px;
            height: 40px;
        }

        .navbar-logo::before {
            font-size: 16px;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-content">
            <div class="navbar-brand">
                <div class="navbar-logo"></div>
                <div class="brand-info">
                    <h1>Enamour.id</h1>
                    <p>Dashboard Pelanggan</p>
                </div>
            </div>
            
            <div class="navbar-actions">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? Auth::user()->first_name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h3>{{ Auth::user()->name ?? Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h3>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Dashboard Content -->
    <div class="dashboard-content">
        <!-- Welcome Card -->
        <div class="welcome-card">
            <h2>Selamat Datang di Enamour.id</h2>
            <p>
                Terima kasih telah bergabung dengan kami! Jelajahi koleksi sepatu premium terbaru 
                dan nikmati pengalaman berbelanja yang tak terlupakan. Temukan sepatu impian Anda 
                dengan kualitas terbaik dan desain terdepan.
            </p>
            <a href="/shop" class="explore-btn">
                🛍 Jelajahi Koleksi
            </a>
        </div>

        <!-- Quick Stats -->
        <div class="quick-stats">
            <h3>📊 Statistik Cepat</h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">0</span>
                    <span class="stat-label">Pesanan</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">0</span>
                    <span class="stat-label">Favorit</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">Rp 0</span>
                    <span class="stat-label">Total Belanja</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">0</span>
                    <span class="stat-label">Poin Reward</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="feature-card">
            <span class="feature-icon">🛍</span>
            <h3 class="feature-title">Belanja Sekarang</h3>
            <p class="feature-description">
                Temukan berbagai pilihan sepatu dari brand ternama dengan kualitas terjamin. 
                Dari casual hingga formal, semua ada di sini.
            </p>
            <a href="/shop" class="feature-btn">Mulai Belanja</a>
        </div>

        <div class="feature-card">
            <span class="feature-icon">📦</span>
            <h3 class="feature-title">Riwayat Pesanan</h3>
            <p class="feature-description">
                Pantau status pesanan Anda, lacak pengiriman, dan kelola riwayat pembelian 
                dengan mudah melalui dashboard.
            </p>
            <a href="{{ route('dashboard.orders') }}" class="feature-btn">Lihat Riwayat Pesanan</a>


        </div>

        <div class="feature-card">
            <span class="feature-icon">❤</span>
            <h3 class="feature-title">Daftar Favorit</h3>
            <p class="feature-description">
                Simpan sepatu favorit Anda untuk pembelian di kemudian hari. 
                Dapatkan notifikasi jika ada diskon khusus.
            </p>
            <a href="{{ route('dashboard.favorites') }}" class="feature-btn">Daftar Favorit</a>

        </div>

        <div class="feature-card">
            <span class="feature-icon">👤</span>
            <h3 class="feature-title">Profil Saya</h3>
            <p class="feature-description">
                Kelola informasi pribadi, alamat pengiriman, dan preferensi akun Anda. 
                Pastikan data selalu terbaru.
            </p>
            <a href="{{ route('profile.show') }}" class="feature-btn">
    Profil Saya
</a>

        </div>

        <div class="feature-card">
            <span class="feature-icon">🎁</span>
            <h3 class="feature-title">Reward & Poin</h3>
            <p class="feature-description">
                Kumpulkan poin setiap pembelian dan tukarkan dengan diskon menarik. 
                Semakin sering berbelanja, semakin banyak keuntungan.
            </p>
            <a href="{{ route('reward.index') }}" class="feature-btn">
        Reward & Poin
    </a>
        </div>

        <div class="feature-card">
            <span class="feature-icon">💬</span>
            <h3 class="feature-title">Bantuan & Support</h3>
            <p class="feature-description">
                Ada pertanyaan? Tim customer service kami siap membantu Anda 24/7. 
                Hubungi kami kapan saja.
            </p>
            <a href="{{ route('contact') }}"class="feature-btn">Hubungi Kami</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth animations for feature cards
        const featureCards = document.querySelectorAll('.feature-card');
        featureCards.forEach((card, index) => {
            card.style.animationDelay = ${index * 0.1}s;
        });

        // Add hover effects to stat items
        const statItems = document.querySelectorAll('.stat-item');
        statItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px) scale(1.05)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add click ripple effect to buttons
        const buttons = document.querySelectorAll('.explore-btn, .feature-btn, .logout-btn');
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

        // Animate numbers in stats
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
        
        .explore-btn, .feature-btn, .logout-btn {
            position: relative;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
</script>
@endsection