@extends('layouts.app')

@section('title', 'Bantuan & Support - Enamour.id')

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

    .contact-container {
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
        color: white;
        text-decoration: none;
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
        animation: fadeInUp 0.8s ease-out;
    }

    .page-header h1 {
        font-size: 36px;
        font-weight: 700;
        color: white;
        margin-bottom: 10px;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .page-header p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 18px;
        max-width: 600px;
        margin: 0 auto;
    }

    .contact-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 40px;
    }

    .contact-form-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: fadeInLeft 0.8s ease-out;
    }

    .contact-info-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
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

    .card-title {
        font-size: 24px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        color: #2d3748;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
        color: #2d3748;
    }

    .form-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: rgba(255, 255, 255, 1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }

    .submit-btn {
        width: 100%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 14px 24px;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 16px;
        position: relative;
        overflow: hidden;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(102, 126, 234, 0.3);
    }

    .contact-method {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        background: rgba(102, 126, 234, 0.1);
        border-radius: 15px;
        margin-bottom: 15px;
        border: 1px solid rgba(102, 126, 234, 0.2);
        transition: all 0.3s ease;
    }

    .contact-method:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.2);
        background: rgba(102, 126, 234, 0.15);
    }

    .contact-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        flex-shrink: 0;
    }

    .contact-details h3 {
        color: #2d3748;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .contact-details p {
        color: #718096;
        font-size: 14px;
        line-height: 1.5;
    }

    .faq-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: fadeInUp 1s ease-out;
    }

    .faq-item {
        border-bottom: 1px solid rgba(102, 126, 234, 0.2);
        padding: 20px 0;
    }

    .faq-item:last-child {
        border-bottom: none;
    }

    .faq-question {
        font-weight: 600;
        color: #2d3748;
        font-size: 16px;
        margin-bottom: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .faq-question::before {
        content: '❓';
        font-size: 16px;
    }

    .faq-answer {
        color: #718096;
        font-size: 14px;
        line-height: 1.6;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        border: 1px solid;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-success {
        background: rgba(72, 187, 120, 0.1);
        color: #2f855a;
        border-color: rgba(72, 187, 120, 0.3);
    }

    .alert-error {
        background: rgba(245, 101, 101, 0.1);
        color: #c53030;
        border-color: rgba(245, 101, 101, 0.3);
    }

    @media (max-width: 768px) {
        .contact-container {
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

        .contact-content {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .contact-form-card, .contact-info-card {
            padding: 25px;
        }

        .page-header h1 {
            font-size: 28px;
        }

        .page-header p {
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        .contact-container {
            padding: 10px;
        }

        .navbar {
            padding: 15px;
        }

        .contact-form-card, .contact-info-card, .faq-section {
            padding: 20px;
        }

        .page-header h1 {
            font-size: 24px;
        }

        .contact-method {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<div class="contact-container">
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-content">
            <div class="navbar-brand">
                <div class="navbar-logo"></div>
                <div class="brand-info">
                    <h1>Enamour.id</h1>
                    <p>Bantuan & Support</p>
                </div>
            </div>
            
            <a href="{{ route('dashboard') }}" class="back-btn">
                ← Kembali ke Dashboard
            </a>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1>🤝 Bantuan & Support</h1>
        <p>Kami siap membantu Anda! Hubungi tim customer service kami atau cari jawaban dalam FAQ.</p>
    </div>

    <!-- Contact Content -->
    <div class="contact-content">
        <!-- Contact Form -->
        <div class="contact-form-card">
            <h2 class="card-title">💬 Kirim Pesan</h2>
            
            @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error">
                ❌ {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-input" 
                           value="{{ old('name', Auth::user()->name ?? Auth::user()->first_name . ' ' . Auth::user()->last_name) }}" 
                           required>
                    @error('name')
                    <small style="color: #c53030;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" 
                           value="{{ old('email', Auth::user()->email) }}" 
                           required>
                    @error('email')
                    <small style="color: #c53030;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Subjek</label>
                    <select name="subject" class="form-input" required>
                        <option value="">Pilih Subjek</option>
                        <option value="order" {{ old('subject') == 'order' ? 'selected' : '' }}>Pertanyaan Pesanan</option>
                        <option value="product" {{ old('subject') == 'product' ? 'selected' : '' }}>Informasi Produk</option>
                        <option value="shipping" {{ old('subject') == 'shipping' ? 'selected' : '' }}>Pengiriman</option>
                        <option value="return" {{ old('subject') == 'return' ? 'selected' : '' }}>Pengembalian/Refund</option>
                        <option value="account" {{ old('subject') == 'account' ? 'selected' : '' }}>Akun & Profil</option>
                        <option value="complaint" {{ old('subject') == 'complaint' ? 'selected' : '' }}>Keluhan</option>
                        <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('subject')
                    <small style="color: #c53030;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Pesan</label>
                    <textarea name="message" class="form-input form-textarea" 
                              placeholder="Jelaskan pertanyaan atau masalah Anda dengan detail..." 
                              required>{{ old('message') }}</textarea>
                    @error('message')
                    <small style="color: #c53030;">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="submit-btn">
                    📤 Kirim Pesan
                </button>
            </form>
        </div>

        <!-- Contact Information -->
        <div class="contact-info-card">
            <h2 class="card-title">📞 Hubungi Kami</h2>
            
            <div class="contact-method">
                <div class="contact-icon">💬</div>
                <div class="contact-details">
                    <h3>Live Chat</h3>
                    <p>Dapatkan bantuan cepat melalui live chat. Tersedia 24/7 untuk membantu Anda.</p>
                </div>
            </div>

            <div class="contact-method">
                <div class="contact-icon">📧</div>
                <div class="contact-details">
                    <h3>Email</h3>
                    <p>support@enamour.id<br>Respon dalam 24 jam</p>
                </div>
            </div>

            <div class="contact-method">
                <div class="contact-icon">📱</div>
                <div class="contact-details">
                    <h3>WhatsApp</h3>
                    <p>+62 812-8620-8562<br>24/7 Customer Service</p>
                </div>
            </div>

            <div class="contact-method">
                <div class="contact-icon">📞</div>
                <div class="contact-details">
                    <h3>Phone</h3>
                    <p>0812-8620-8562<br>Senin - Jumat: 08:00 - 22:00</p>
                </div>
            </div>

            <div class="contact-method">
                <div class="contact-icon">📍</div>
                <div class="contact-details">
                    <h3>Alamat</h3>
                    <p>Jl. Cikopak No.53<br>Sadang, Purwakarta 41151</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="faq-section">
        <h2 class="card-title">🤔 Frequently Asked Questions</h2>
        
        <div class="faq-item">
            <div class="faq-question">Bagaimana cara melacak pesanan saya?</div>
            <div class="faq-answer">
                Anda dapat melacak pesanan melalui halaman "Riwayat Pesanan" di dashboard. Klik tombol "Lacak Pesanan" dan masukkan nomor pesanan atau cek email konfirmasi yang dikirim setelah pemesanan.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">Berapa lama waktu pengiriman?</div>
            <div class="faq-answer">
                Waktu pengiriman tergantung lokasi: Jakarta (1-2 hari), Jabodetabek (2-3 hari), luar kota (3-5 hari). Kami menggunakan kurir terpercaya untuk memastikan pesanan sampai dengan aman.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">Apakah bisa mengembalikan produk?</div>
            <div class="faq-answer">
                Ya, kami menerima pengembalian dalam 7 hari setelah produk diterima. Syarat: produk masih dalam kondisi baru, tidak rusak, dan disertai dengan kemasan asli.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">Metode pembayaran apa saja yang tersedia?</div>
            <div class="faq-answer">
                Kami menerima berbagai metode pembayaran: transfer bank, kartu kredit/debit, e-wallet (GoPay, OVO, Dana), dan cicilan dengan kartu kredit.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">Bagaimana cara menggunakan poin reward?</div>
            <div class="faq-answer">
                Poin reward dapat digunakan saat checkout. Setiap 1000 poin setara dengan Rp 10.000. Poin akan otomatis muncul di halaman pembayaran jika Anda memiliki poin yang cukup.
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth animations for cards
        const cards = document.querySelectorAll('.contact-form-card, .contact-info-card, .faq-section');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Add hover effects to contact methods
        const contactMethods = document.querySelectorAll('.contact-method');
        contactMethods.forEach(method => {
            method.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px) scale(1.02)';
            });
            
            method.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add click ripple effect to buttons
        const buttons = document.querySelectorAll('.submit-btn, .back-btn');
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

        // FAQ Toggle (if you want to make it expandable)
        const faqQuestions = document.querySelectorAll('.faq-question');
        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                const answer = this.nextElementSibling;
                const isVisible = answer.style.display === 'block';
                
                answer.style.display = isVisible ? 'none' : 'block';
                this.style.color = isVisible ? '#2d3748' : '#667eea';
            });
        });

        // Form validation enhancements
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, textarea, select');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '' && this.hasAttribute('required')) {
                    this.style.borderColor = '#f56565';
                } else {
                    this.style.borderColor = 'rgba(102, 126, 234, 0.2)';
                }
            });
        });

        // Form submit animation
        if (form) {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('.submit-btn');
                submitBtn.textContent = '⏳ Mengirim...';
                submitBtn.disabled = true;
            });
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
        
        .submit-btn, .back-btn {
            position: relative;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
</script>
@endsection