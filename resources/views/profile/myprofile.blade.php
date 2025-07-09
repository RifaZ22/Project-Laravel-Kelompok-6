@extends('layouts.app')

@section('title', 'Profil Saya - Enamour.id')

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

    .profile-container {
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

    .profile-header {
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

    .profile-avatar {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 48px;
        margin: 0 auto 20px;
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .profile-avatar::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .profile-avatar:hover::before {
        left: 100%;
    }

    .profile-name {
        font-size: 32px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 8px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .profile-email {
        color: #718096;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .profile-status {
        display: inline-block;
        background: rgba(34, 197, 94, 0.1);
        color: #16a34a;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .profile-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .profile-section {
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

    .profile-section:nth-child(2) {
        animation: fadeInRight 0.8s ease-out;
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

    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-title::before {
        content: '';
        width: 4px;
        height: 25px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 2px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-input {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        color: #2d3748;
    }

    .form-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .form-input:disabled {
        background: rgba(241, 245, 249, 0.8);
        color: #94a3b8;
        cursor: not-allowed;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 16px;
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(102, 126, 234, 0.3);
    }

    .btn-secondary {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        border: 2px solid rgba(102, 126, 234, 0.2);
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 16px;
        width: 100%;
        margin-top: 10px;
    }

    .btn-secondary:hover {
        background: rgba(102, 126, 234, 0.15);
        border-color: rgba(102, 126, 234, 0.3);
        transform: translateY(-2px);
    }

    .address-section {
        grid-column: 1 / -1;
        animation: fadeInUp 1s ease-out;
    }

    .address-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .address-item {
        background: rgba(102, 126, 234, 0.1);
        padding: 20px;
        border-radius: 15px;
        border: 2px solid rgba(102, 126, 234, 0.2);
        transition: all 0.3s ease;
        position: relative;
    }

    .address-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
        border-color: rgba(102, 126, 234, 0.3);
    }

    .address-primary {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .address-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 10px;
        font-size: 16px;
    }

    .address-content {
        color: #718096;
        font-size: 14px;
        line-height: 1.6;
    }

    .add-address-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 16px 24px;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 16px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 20px;
    }

    .add-address-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(102, 126, 234, 0.3);
    }

    .alert {
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-weight: 500;
        animation: slideIn 0.5s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .alert-success {
        background: rgba(34, 197, 94, 0.1);
        color: #15803d;
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .alert-error {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    @media (max-width: 768px) {
        .profile-container {
            padding: 15px;
        }

        .navbar {
            padding: 20px;
        }

        .navbar-content {
            flex-direction: column;
            text-align: center;
        }

        .profile-content {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .profile-header,
        .profile-section {
            padding: 25px;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            font-size: 40px;
        }

        .profile-name {
            font-size: 28px;
        }

        .address-list {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .profile-container {
            padding: 10px;
        }

        .navbar {
            padding: 15px;
        }

        .profile-header,
        .profile-section {
            padding: 20px;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            font-size: 32px;
        }

        .profile-name {
            font-size: 24px;
        }

        .section-title {
            font-size: 20px;
        }
    }
</style>

<div class="profile-container">
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-content">
            <div class="navbar-brand">
                <div class="navbar-logo"></div>
                <div class="brand-info">
                    <h1>Enamour.id</h1>
                    <p>Profil Pelanggan</p>
                </div>
            </div>
            
            <div class="navbar-actions">
                <a href="{{ route('dashboard') }}" class="back-btn">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </nav>

    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-avatar">
            {{ strtoupper(substr(Auth::user()->name ?? Auth::user()->first_name ?? 'U', 0, 1)) }}
        </div>
        <h2 class="profile-name">{{ Auth::user()->name ?? Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h2>
        <p class="profile-email">{{ Auth::user()->email }}</p>
        <span class="profile-status">✓ Akun Aktif</span>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Profile Content -->
    <div class="profile-content">
        <!-- Personal Information -->
        <div class="profile-section">
            <h3 class="section-title">👤 Informasi Pribadi</h3>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" 
                           name="name" 
                           class="form-input" 
                           value="{{ old('name', Auth::user()->name ?? Auth::user()->first_name . ' ' . Auth::user()->last_name) }}"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" 
                           name="email" 
                           class="form-input" 
                           value="{{ old('email', Auth::user()->email) }}"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="tel" 
                           name="phone" 
                           class="form-input" 
                           value="{{ old('phone', Auth::user()->phone ?? '') }}"
                           placeholder="Contoh: +6281234567890">
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" 
                           name="date_of_birth" 
                           class="form-input" 
                           value="{{ old('date_of_birth', Auth::user()->date_of_birth ?? '') }}">
                </div>

                <button type="submit" class="btn-primary">
                    💾 Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- Change Password -->
        <div class="profile-section">
            <h3 class="section-title">🔒 Ubah Password</h3>
            <form method="POST" action="{{ route('profile.password.update') }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">Password Saat Ini</label>
                    <input type="password" 
                           name="current_password" 
                           class="form-input" 
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password Baru</label>
                    <input type="password" 
                           name="password" 
                           class="form-input" 
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" 
                           name="password_confirmation" 
                           class="form-input" 
                           required>
                </div>

                <button type="submit" class="btn-primary">
                    🔑 Ubah Password
                </button>
            </form>
        </div>
    </div>

    <!-- Address Management -->
    <div class="profile-section address-section">
        <h3 class="section-title">📍 Alamat Pengiriman</h3>
        
        <div class="address-list">
            @if(isset($addresses) && $addresses->count() > 0)
                @foreach($addresses as $address)
                    <div class="address-item">
                        @if($address->is_primary)
                            <div class="address-primary">Utama</div>
                        @endif
                        <div class="address-title">{{ $address->label ?? 'Alamat ' . $loop->iteration }}</div>
                        <div class="address-content">
                            {{ $address->recipient_name }}<br>
                            {{ $address->address_line_1 }}<br>
                            @if($address->address_line_2)
                                {{ $address->address_line_2 }}<br>
                            @endif
                            {{ $address->city }}, {{ $address->province }} {{ $address->postal_code }}<br>
                            {{ $address->phone }}
                        </div>
                    </div>
                @endforeach
            @else
                <div class="address-item">
                    <div class="address-title">Belum ada alamat</div>
                    <div class="address-content">
                        Anda belum menambahkan alamat pengiriman. Tambahkan alamat untuk memudahkan proses checkout.
                    </div>
                </div>
            @endif
        </div>

        

        <button class="add-address-btn" onclick="window.location.href='{{ route('profile.addresses.create') }}'">
            ➕ Tambah Alamat Baru
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth animations for form inputs
        const formInputs = document.querySelectorAll('.form-input');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Add hover effects to address items
        const addressItems = document.querySelectorAll('.address-item');
        addressItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px) scale(1.02)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add ripple effect to buttons
        const buttons = document.querySelectorAll('.btn-primary, .btn-secondary, .add-address-btn');
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

        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }, 5000);
        });

        // Form validation
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '⏳ Menyimpan...';
                
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = submitBtn.innerHTML.replace('⏳ Menyimpan...', submitBtn.innerHTML.includes('Password') ? '🔑 Ubah Password' : '💾 Simpan Perubahan');
                }, 3000);
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
        
        .btn-primary, .btn-secondary, .add-address-btn {
            position: relative;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
</script>
@endsection