@extends('layouts.app')

@section('title', 'Reward & Poin - Enamour.id')

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

    .rewards-container {
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
        content: '🎁';
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
        position: relative;
        overflow: hidden;
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
        padding: 35px;
        margin-bottom: 30px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: fadeInUp 0.8s ease-out;
        text-align: center;
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
        margin-bottom: 12px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-header p {
        color: #718096;
        font-size: 16px;
        line-height: 1.6;
        max-width: 600px;
        margin: 0 auto;
    }

    .rewards-overview {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 30px;
        animation: fadeInLeft 1s ease-out;
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

    .points-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        position: relative;
        overflow: hidden;
    }

    .points-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .points-card h2 {
        font-size: 24px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        position: relative;
        z-index: 1;
    }

    .points-display {
        font-size: 48px;
        font-weight: 800;
        background: linear-gradient(135deg, #FFD700, #FF8C00);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .points-subtitle {
        color: #718096;
        font-size: 16px;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .level-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        position: relative;
        overflow: hidden;
    }

    .level-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite reverse;
    }

    .level-card h2 {
        font-size: 24px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        position: relative;
        z-index: 1;
    }

    .level-display {
        font-size: 36px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
    }

    .progress-bar {
        background: rgba(102, 126, 234, 0.1);
        border-radius: 10px;
        height: 12px;
        margin-bottom: 10px;
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    .progress-fill {
        background: linear-gradient(90deg, #667eea, #764ba2);
        height: 100%;
        border-radius: 10px;
        transition: width 1s ease-out;
        animation: progressAnimation 2s ease-out;
    }

    @keyframes progressAnimation {
        from { width: 0%; }
        to { width: 65%; }
    }

    .progress-text {
        color: #718096;
        font-size: 14px;
        position: relative;
        z-index: 1;
    }

    .rewards-sections {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 30px;
    }

    .rewards-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: fadeInRight 1.2s ease-out;
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

    .section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(102, 126, 234, 0.1);
    }

    .section-header h3 {
        font-size: 22px;
        font-weight: 700;
        color: #2d3748;
    }

    .reward-item {
        background: rgba(102, 126, 234, 0.05);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
        border: 1px solid rgba(102, 126, 234, 0.1);
        position: relative;
        overflow: hidden;
    }

    .reward-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.15);
        background: rgba(102, 126, 234, 0.1);
    }

    .reward-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .reward-item:hover::before {
        transform: scaleX(1);
    }

    .reward-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .reward-title {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
    }

    .reward-points {
        background: linear-gradient(135deg, #FFD700, #FF8C00);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    .reward-description {
        color: #718096;
        font-size: 14px;
        margin-bottom: 15px;
        line-height: 1.5;
    }

    .redeem-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        width: 100%;
    }

    .redeem-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .redeem-btn:disabled {
        background: #cbd5e0;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .history-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: fadeInUp 1.4s ease-out;
    }

    .history-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid rgba(102, 126, 234, 0.1);
    }

    .history-item:last-child {
        border-bottom: none;
    }

    .history-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .history-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .history-icon.earned {
        background: rgba(34, 197, 94, 0.1);
        color: #22c55e;
    }

    .history-icon.spent {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .history-details h4 {
        font-size: 16px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 4px;
    }

    .history-details p {
        font-size: 14px;
        color: #718096;
    }

    .history-points {
        font-size: 16px;
        font-weight: 600;
    }

    .history-points.earned {
        color: #22c55e;
    }

    .history-points.spent {
        color: #ef4444;
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: #718096;
    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .rewards-container {
            padding: 15px;
        }

        .navbar {
            padding: 20px;
        }

        .navbar-content {
            flex-direction: column;
            text-align: center;
        }

        .rewards-overview,
        .rewards-sections {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .page-header,
        .points-card,
        .level-card,
        .rewards-section {
            padding: 25px;
        }

        .page-header h1 {
            font-size: 28px;
        }

        .points-display {
            font-size: 36px;
        }

        .level-display {
            font-size: 28px;
        }

        .history-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }

    @media (max-width: 480px) {
        .rewards-container {
            padding: 10px;
        }

        .navbar {
            padding: 15px;
        }

        .page-header h1 {
            font-size: 24px;
        }

        .points-display {
            font-size: 32px;
        }

        .level-display {
            font-size: 24px;
        }

        .reward-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .history-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }
</style>

<div class="rewards-container">
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-content">
            <div class="navbar-brand">
                <div class="navbar-logo"></div>
                <div class="brand-info">
                    <h1>Reward & Poin</h1>
                    <p>Kelola poin dan tukarkan reward</p>
                </div>
            </div>
            
            <div class="navbar-actions">
                <a href="{{ route('dashboard') }}" class="back-btn">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1>🎁 Reward & Poin</h1>
        <p>Kumpulkan poin dari setiap pembelian dan tukarkan dengan reward menarik. Semakin sering berbelanja, semakin banyak keuntungan yang bisa Anda dapatkan!</p>
    </div>

    <!-- Rewards Overview -->
    <div class="rewards-overview">
        <!-- Points Card -->
        <div class="points-card">
            <h2>💰 Poin Saya</h2>
            <div class="points-display">{{ $userPoints ?? 0 }}</div>
            <p class="points-subtitle">Poin yang bisa ditukar</p>
            <p style="color: #718096; font-size: 14px; position: relative; z-index: 1;">
                Dapatkan 1 poin untuk setiap Rp 10.000 pembelian
            </p>
        </div>

        <!-- Level Card -->
        <div class="level-card">
            <h2>🏆 Level Member</h2>
            <div class="level-display">{{ $userLevel ?? 'Bronze' }}</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: {{ $levelProgress ?? 65 }}%;"></div>
            </div>
            <p class="progress-text">{{ $pointsToNextLevel ?? 350 }} poin lagi untuk naik level</p>
        </div>
    </div>

    <!-- Rewards Sections -->
    <div class="rewards-sections">
        <!-- Available Rewards -->
        <div class="rewards-section">
            <div class="section-header">
                <span style="font-size: 24px;">🎯</span>
                <h3>Reward Tersedia</h3>
            </div>

            <div class="reward-item">
                <div class="reward-header">
                    <h4 class="reward-title">Diskon 10%</h4>
                    <span class="reward-points">100 Poin</span>
                </div>
                <p class="reward-description">Dapatkan diskon 10% untuk pembelian selanjutnya. Berlaku untuk semua produk.</p>
                <button class="redeem-btn" {{ ($userPoints ?? 0) < 100 ? 'disabled' : '' }}>
                    {{ ($userPoints ?? 0) < 100 ? 'Poin Tidak Cukup' : 'Tukar Sekarang' }}
                </button>
            </div>

            <div class="reward-item">
                <div class="reward-header">
                    <h4 class="reward-title">Gratis Ongkir</h4>
                    <span class="reward-points">150 Poin</span>
                </div>
                <p class="reward-description">Gratis ongkos kirim untuk pembelian berikutnya ke seluruh Indonesia.</p>
                <button class="redeem-btn" {{ ($userPoints ?? 0) < 150 ? 'disabled' : '' }}>
                    {{ ($userPoints ?? 0) < 150 ? 'Poin Tidak Cukup' : 'Tukar Sekarang' }}
                </button>
            </div>

            <div class="reward-item">
                <div class="reward-header">
                    <h4 class="reward-title">Diskon 20%</h4>
                    <span class="reward-points">300 Poin</span>
                </div>
                <p class="reward-description">Diskon 20% untuk pembelian minimum Rp 500.000. Kesempatan terbatas!</p>
                <button class="redeem-btn" {{ ($userPoints ?? 0) < 300 ? 'disabled' : '' }}>
                    {{ ($userPoints ?? 0) < 300 ? 'Poin Tidak Cukup' : 'Tukar Sekarang' }}
                </button>
            </div>
        </div>

        <!-- Exclusive Rewards -->
        <div class="rewards-section">
            <div class="section-header">
                <span style="font-size: 24px;">⭐</span>
                <h3>Reward Eksklusif</h3>
            </div>

            <div class="reward-item">
                <div class="reward-header">
                    <h4 class="reward-title">Sepatu Gratis</h4>
                    <span class="reward-points">1000 Poin</span>
                </div>
                <p class="reward-description">Dapatkan sepatu pilihan senilai Rp 500.000 secara gratis!</p>
                <button class="redeem-btn" {{ ($userPoints ?? 0) < 1000 ? 'disabled' : '' }}>
                    {{ ($userPoints ?? 0) < 1000 ? 'Poin Tidak Cukup' : 'Tukar Sekarang' }}
                </button>
            </div>

            <div class="reward-item">
                <div class="reward-header">
                    <h4 class="reward-title">VIP Member</h4>
                    <span class="reward-points">2000 Poin</span>
                </div>
                <p class="reward-description">Upgrade ke VIP member dan dapatkan akses eksklusif ke produk terbaru.</p>
                <button class="redeem-btn" {{ ($userPoints ?? 0) < 2000 ? 'disabled' : '' }}>
                    {{ ($userPoints ?? 0) < 2000 ? 'Poin Tidak Cukup' : 'Tukar Sekarang' }}
                </button>
            </div>

            <div class="reward-item">
                <div class="reward-header">
                    <h4 class="reward-title">Cashback Rp 100K</h4>
                    <span class="reward-points">800 Poin</span>
                </div>
                <p class="reward-description">Dapatkan cashback senilai Rp 100.000 yang bisa langsung digunakan.</p>
                <button class="redeem-btn" {{ ($userPoints ?? 0) < 800 ? 'disabled' : '' }}>
                    {{ ($userPoints ?? 0) < 800 ? 'Poin Tidak Cukup' : 'Tukar Sekarang' }}
                </button>
            </div>
        </div>
    </div>

    <!-- History Section -->
    <div class="history-section">
        <div class="section-header">
            <span style="font-size: 24px;">📋</span>
            <h3>Riwayat Poin</h3>
        </div>

        @if(isset($pointHistory) && count($pointHistory) > 0)
            @foreach($pointHistory as $history)
            <div class="history-item">
                <div class="history-info">
                    <div class="history-icon {{ $history['type'] }}">
                        {{ $history['type'] === 'earned' ? '+' : '-' }}
                    </div>
                    <div class="history-details">
                        <h4>{{ $history['description'] }}</h4>
                        <p>{{ $history['date'] }}</p>
                    </div>
                </div>
                <div class="history-points {{ $history['type'] }}">
                    {{ $history['type'] === 'earned' ? '+' : '-' }}{{ $history['points'] }} poin
                </div>
            </div>
            @endforeach
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <p>Belum ada riwayat poin</p>
                <p style="font-size: 14px; margin-top: 8px;">Mulai berbelanja untuk mendapatkan poin pertama Anda!</p>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate reward cards on scroll
        const rewardItems = document.querySelectorAll('.reward-item');
        rewardItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
        });

        // Add click effects to redeem buttons
        const redeemButtons = document.querySelectorAll('.redeem-btn');
        redeemButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (!this.disabled) {
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

                    // Here you would normally handle the redemption logic
                    // For now, just show an alert
                    setTimeout(() => {
                        alert('Fitur tukar poin akan segera tersedia!');
                    }, 100);
                }
            });
        });

        // Animate points counter
        const pointsDisplay = document.querySelector('.points-display');
        const finalValue = parseInt(pointsDisplay.textContent) || 0;
        let currentValue = 0;
        const increment = Math.ceil(finalValue / 30);
        
        const pointsTimer = setInterval(() => {
            currentValue += increment;
            if (currentValue >= finalValue) {
                pointsDisplay.textContent = finalValue;
                clearInterval(pointsTimer);
            } else {
                pointsDisplay.textContent = currentValue;
            }
        }, 50);

        // Animate progress bar
        const progressBar = document.querySelector('.progress-fill');
        if (progressBar) {
            setTimeout(() => {
                progressBar.style.width = '{{ $levelProgress ?? 65 }}%';
            }, 500);
        }
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
        
        .redeem-btn {
            position: relative;
            overflow: hidden;
        }
        
        .reward-item {
            animation: slideInUp 0.6s ease-out forwards;
            opacity: 0;
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .history-item {
            animation: fadeInSlide 0.5s ease-out forwards;
            opacity: 0;
        }
        
        @keyframes fadeInSlide {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    `;
    document.head.appendChild(style);

    // Animate history items
    const historyItems = document.querySelectorAll('.history-item');
    historyItems.forEach((item, index) => {
        item.style.animationDelay = `${index * 0.1}s`;
    });

    // Add hover effects to history items
    historyItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
            this.style.background = 'rgba(102, 126, 234, 0.05)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            this.style.background = 'transparent';
        });
    });
});
</script>
@endsection