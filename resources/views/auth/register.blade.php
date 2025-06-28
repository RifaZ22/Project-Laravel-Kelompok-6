@extends('layouts.app')

@section('title', 'Daftar - Enamour.id')

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
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        padding: 20px 0;
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

    .register-container {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 40px;
    width: 100%;
    max-width: 450px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    position: relative;
    z-index: 1;
    border: 1px solid rgba(255, 255, 255, 0.3);
    margin: 20px;

    /* Tambahan agar bisa scroll jika konten panjang */
    max-height: 90vh;
    overflow-y: auto;
}


    .brand-section {
        text-align: center;
        margin-bottom: 35px;
    }

    .logo {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .logo::before {
        content: '👟';
        font-size: 28px;
        filter: brightness(0) invert(1);
    }

    .brand-name {
        font-size: 26px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 8px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .welcome-text {
        color: #718096;
        font-size: 16px;
        margin-bottom: 8px;
    }

    .subtitle {
        color: #a0aec0;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
        position: relative;
    }

    .form-label {
        display: block;
        color: #4a5568;
        font-weight: 600;
        margin-bottom: 6px;
        font-size: 14px;
    }

    .form-input {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
        outline: none;
    }

    .form-input:focus {
        border-color: #667eea;
        background: rgba(255, 255, 255, 1);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .form-input.is-invalid {
        border-color: #e53e3e;
        box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1);
    }

    .invalid-feedback {
        color: #e53e3e;
        font-size: 13px;
        margin-top: 4px;
        display: block;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #a0aec0;
        cursor: pointer;
        font-size: 16px;
        padding: 5px;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #667eea;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .terms-checkbox {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 25px;
        font-size: 14px;
        color: #4a5568;
        line-height: 1.5;
    }

    .terms-checkbox input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #667eea;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .terms-checkbox a {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
    }

    .terms-checkbox a:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .register-btn {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        margin-bottom: 25px;
    }

    .register-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
    }

    .register-btn:active {
        transform: translateY(0);
    }

    .register-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    .register-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .register-btn:hover::before {
        left: 100%;
    }

    .divider {
        text-align: center;
        margin: 25px 0;
        position: relative;
        color: #a0aec0;
        font-size: 14px;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(to right, transparent, #e2e8f0, transparent);
    }

    .divider span {
        background: rgba(255, 255, 255, 0.95);
        padding: 0 20px;
        position: relative;
        z-index: 1;
    }

    .login-link {
        text-align: center;
        color: #718096;
        font-size: 14px;
    }

    .login-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .login-link a:hover {
        color: #764ba2;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 12px;
        font-size: 14px;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .password-strength {
        margin-top: 8px;
        display: none;
    }

    .strength-bar {
        height: 4px;
        background: #e2e8f0;
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 5px;
    }

    .strength-fill {
        height: 100%;
        transition: all 0.3s ease;
        border-radius: 2px;
    }

    .strength-text {
        font-size: 12px;
        color: #718096;
    }

    @media (max-width: 480px) {
        .register-container {
            margin: 10px;
            padding: 30px 25px;
            max-width: none;
        }
        
        .brand-name {
            font-size: 22px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 10px;
        }
    }

    .loading {
        display: none;
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s ease-in-out infinite;
        margin-left: 10px;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<div class="register-container">
    <div class="brand-section">
        <div class="logo"></div>
        <h1 class="brand-name">Enamour.id</h1>
        <p class="welcome-text">Bergabung dengan kami!</p>
        <p class="subtitle">Daftar sekarang dan mulai berbelanja sepatu impian Anda</p>
    </div>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Display success message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Register Form --}}
    <form method="POST" action="{{ route('register') }}" id="registerForm">
        @csrf
        
        <div class="form-row">
            <div class="form-group">
                <label for="first_name" class="form-label">Nama Depan</label>
                <input 
                    type="text" 
                    id="first_name" 
                    name="first_name" 
                    class="form-input @error('first_name') is-invalid @enderror" 
                    placeholder="Nama depan"
                    value="{{ old('first_name') }}"
                    required
                    autofocus
                >
                @error('first_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name" class="form-label">Nama Belakang</label>
                <input 
                    type="text" 
                    id="last_name" 
                    name="last_name" 
                    class="form-input @error('last_name') is-invalid @enderror" 
                    placeholder="Nama belakang"
                    value="{{ old('last_name') }}"
                    required
                >
                @error('last_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Alternative: Single name field if your Laravel uses 'name' instead --}}
        {{-- 
        <div class="form-group">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-input @error('name') is-invalid @enderror" 
                placeholder="Masukkan nama lengkap Anda"
                value="{{ old('name') }}"
                required
                autofocus
            >
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        --}}

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-input @error('email') is-invalid @enderror" 
                placeholder="Masukkan email Anda"
                value="{{ old('email') }}"
                required
                autocomplete="email"
            >
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Nomor Telepon (Opsional)</label>
            <input 
                type="tel" 
                id="phone" 
                name="phone" 
                class="form-input @error('phone') is-invalid @enderror" 
                placeholder="Contoh: 08123456789"
                value="{{ old('phone') }}"
                autocomplete="tel"
            >
            @error('phone')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <div style="position: relative;">
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-input @error('password') is-invalid @enderror" 
                    placeholder="Minimal 8 karakter"
                    required
                    autocomplete="new-password"
                    onkeyup="checkPasswordStrength()"
                >
                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                    👁
                </button>
            </div>
            <div class="password-strength" id="passwordStrength">
                <div class="strength-bar">
                    <div class="strength-fill" id="strengthFill"></div>
                </div>
                <div class="strength-text" id="strengthText">Ketik password untuk melihat kekuatan</div>
            </div>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <div style="position: relative;">
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    class="form-input @error('password_confirmation') is-invalid @enderror" 
                    placeholder="Ulangi password Anda"
                    required
                    autocomplete="new-password"
                >
                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                    👁
                </button>
            </div>
            @error('password_confirmation')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="terms-checkbox">
            <input type="checkbox" id="terms" name="terms" required>
            <label for="terms">
                Saya menyetujui <a href="/terms" target="_blank">Syarat & Ketentuan</a> 
                dan <a href="/privacy" target="_blank">Kebijakan Privasi</a> Enamour.id
            </label>
        </div>

        <button type="submit" class="register-btn" id="registerButton">
            Daftar Sekarang
            <div class="loading" id="loadingSpinner"></div>
        </button>
    </form>

    <div class="divider">
        <span>atau</span>
    </div>

    <div class="login-link">
        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
    </div>
</div>
    

<script>
    function togglePassword(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const toggleButton = passwordInput.nextElementSibling;
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.textContent = '🙈';
        } else {
            passwordInput.type = 'password';
            toggleButton.textContent = '👁';
        }
    }

    function checkPasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthIndicator = document.getElementById('passwordStrength');
        const strengthFill = document.getElementById('strengthFill');
        const strengthText = document.getElementById('strengthText');
        
        if (password.length === 0) {
            strengthIndicator.style.display = 'none';
            return;
        }
        
        strengthIndicator.style.display = 'block';
        
        let strength = 0;
        let feedback = [];
        
        // Length check
        if (password.length >= 8) strength += 1;
        else feedback.push('minimal 8 karakter');
        
        // Uppercase check
        if (/[A-Z]/.test(password)) strength += 1;
        else feedback.push('huruf besar');
        
        // Lowercase check
        if (/[a-z]/.test(password)) strength += 1;
        else feedback.push('huruf kecil');
        
        // Number check
        if (/[0-9]/.test(password)) strength += 1;
        else feedback.push('angka');
        
        // Special character check
        if (/[^A-Za-z0-9]/.test(password)) strength += 1;
        else feedback.push('karakter khusus');
        
        // Update strength bar
        const percentage = (strength / 5) * 100;
        strengthFill.style.width = percentage + '%';
        
        if (strength <= 2) {
            strengthFill.style.background = '#e53e3e';
            strengthText.textContent = 'Lemah - Butuh: ' + feedback.slice(0, 3).join(', ');
            strengthText.style.color = '#e53e3e';
        } else if (strength <= 3) {
            strengthFill.style.background = '#d69e2e';
            strengthText.textContent = 'Sedang - Butuh: ' + feedback.slice(0, 2).join(', ');
            strengthText.style.color = '#d69e2e';
        } else if (strength <= 4) {
            strengthFill.style.background = '#38a169';
            strengthText.textContent = 'Kuat - Hampir sempurna!';
            strengthText.style.color = '#38a169';
        } else {
            strengthFill.style.background = '#00d084';
            strengthText.textContent = 'Sangat Kuat - Password aman!';
            strengthText.style.color = '#00d084';
        }
    }

    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const button = document.getElementById('registerButton');
        const loading = document.getElementById('loadingSpinner');
        
        // Show loading state
        button.disabled = true;
        loading.style.display = 'inline-block';
        button.innerHTML = 'Memproses... <div class="loading" style="display: inline-block;"></div>';
    });

    // Add subtle animations on input focus
    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 500);
        });
    }, 5000);

    // Real-time password confirmation check
    document.getElementById('password_confirmation').addEventListener('keyup', function() {
        const password = document.getElementById('password').value;
        const confirmation = this.value;
        
        if (confirmation.length > 0) {
            if (password === confirmation) {
                this.style.borderColor = '#38a169';
            } else {
                this.style.borderColor = '#e53e3e';
            }
        } else {
            this.style.borderColor = '#e2e8f0';
        }
    });
</script>
@endsection