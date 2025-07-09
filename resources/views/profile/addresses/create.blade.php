@extends('layouts.app')

@section('title', 'Tambah Alamat Pengiriman - Enamour.id')

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

    .address-container {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        padding: 20px;
        max-width: 800px;
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

    .page-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        margin: 0 auto 20px;
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .page-icon::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .page-icon:hover::before {
        left: 100%;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 8px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-subtitle {
        color: #718096;
        font-size: 16px;
    }

    .form-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: fadeInUp 1s ease-out;
        position: relative;
        overflow: hidden;
    }

    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 25px;
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

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-label.required::after {
        content: ' *';
        color: #ef4444;
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

    .form-textarea {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        color: #2d3748;
        resize: vertical;
        min-height: 100px;
        font-family: inherit;
    }

    .form-textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .form-select {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        color: #2d3748;
        cursor: pointer;
    }

    .form-select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 20px;
        padding: 16px;
        background: rgba(102, 126, 234, 0.1);
        border-radius: 12px;
        border: 2px solid rgba(102, 126, 234, 0.2);
        transition: all 0.3s ease;
    }

    .checkbox-group:hover {
        border-color: rgba(102, 126, 234, 0.3);
        background: rgba(102, 126, 234, 0.15);
    }

    .form-checkbox {
        width: 20px;
        height: 20px;
        accent-color: #667eea;
        cursor: pointer;
    }

    .checkbox-label {
        font-weight: 500;
        color: #2d3748;
        cursor: pointer;
        font-size: 14px;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid rgba(102, 126, 234, 0.2);
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 16px 32px;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 16px;
        position: relative;
        overflow: hidden;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
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
        padding: 16px 32px;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 16px;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background: rgba(102, 126, 234, 0.15);
        border-color: rgba(102, 126, 234, 0.3);
        transform: translateY(-2px);
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

    .form-help {
        font-size: 12px;
        color: #718096;
        margin-top: 4px;
        font-style: italic;
    }

    .location-group {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .address-container {
            padding: 15px;
        }

        .navbar {
            padding: 20px;
        }

        .navbar-content {
            flex-direction: column;
            text-align: center;
        }

        .page-header,
        .form-section {
            padding: 25px;
        }

        .page-icon {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }

        .page-title {
            font-size: 24px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .location-group {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .address-container {
            padding: 10px;
        }

        .navbar {
            padding: 15px;
        }

        .page-header,
        .form-section {
            padding: 20px;
        }

        .page-title {
            font-size: 20px;
        }

        .section-title {
            font-size: 20px;
        }
    }
</style>

<div class="address-container">
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-content">
            <div class="navbar-brand">
                <div class="navbar-logo"></div>
                <div class="brand-info">
                    <h1>Enamour.id</h1>
                    <p>Tambah Alamat Pengiriman</p>
                </div>
            </div>
            
            <div class="navbar-actions">
                <a href="{{ route('profile.show') }}" class="back-btn">
                    ← Kembali ke Profil
                </a>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-icon">📍</div>
        <h1 class="page-title">Tambah Alamat Baru</h1>
        <p class="page-subtitle">Lengkapi informasi alamat pengiriman Anda dengan detail yang akurat</p>
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

    <!-- Address Form -->
    <div class="form-section">
        <h2 class="section-title">📋 Informasi Alamat</h2>
        
        <form method="POST" action="{{ route('profile.addresses.store') }}" id="addressForm">
            @csrf
            
            <!-- Address Label -->
            <div class="form-group">
                <label class="form-label required">Label Alamat</label>
                <input type="text" 
                       name="label" 
                       class="form-input" 
                       value="{{ old('label') }}"
                       placeholder="Contoh: Rumah, Kantor, Apartemen"
                       required>
                <div class="form-help">Berikan nama yang mudah diingat untuk alamat ini</div>
            </div>

            <!-- Recipient Information -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required">Nama Penerima</label>
                    <input type="text" 
                           name="recipient_name" 
                           class="form-input" 
                           value="{{ old('recipient_name', Auth::user()->name ?? Auth::user()->first_name . ' ' . Auth::user()->last_name) }}"
                           placeholder="Nama lengkap penerima"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label required">Nomor Telepon</label>
                    <input type="tel" 
                           name="phone" 
                           class="form-input" 
                           value="{{ old('phone', Auth::user()->phone ?? '') }}"
                           placeholder="Contoh: +6281234567890"
                           required>
                </div>
            </div>

            <!-- Address Details -->
            <div class="form-group">
                <label class="form-label required">Alamat Lengkap</label>
                <textarea name="address_line_1" 
                          class="form-textarea" 
                          placeholder="Masukkan alamat lengkap (jalan, nomor rumah, RT/RW, kelurahan)"
                          required>{{ old('address_line_1') }}</textarea>
                <div class="form-help">Sertakan detail seperti nama jalan, nomor rumah, RT/RW, dan kelurahan</div>
            </div>

            <div class="form-group">
                <label class="form-label">Alamat Tambahan (Opsional)</label>
                <input type="text" 
                       name="address_line_2" 
                       class="form-input" 
                       value="{{ old('address_line_2') }}"
                       placeholder="Contoh: Dekat masjid, samping warung makan, dll">
                <div class="form-help">Informasi tambahan untuk mempermudah pengiriman</div>
            </div>

            <!-- Location Details -->
            <div class="location-group">
                <div class="form-group">
                    <label class="form-label required">Kota</label>
                    <input type="text" 
                           name="city" 
                           class="form-input" 
                           value="{{ old('city') }}"
                           placeholder="Contoh: Jakarta"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label required">Provinsi</label>
                    <select name="province" class="form-select" required>
                        <option value="">Pilih Provinsi</option>
                        <option value="Aceh" {{ old('province') == 'Aceh' ? 'selected' : '' }}>Aceh</option>
                        <option value="Sumatera Utara" {{ old('province') == 'Sumatera Utara' ? 'selected' : '' }}>Sumatera Utara</option>
                        <option value="Sumatera Barat" {{ old('province') == 'Sumatera Barat' ? 'selected' : '' }}>Sumatera Barat</option>
                        <option value="Riau" {{ old('province') == 'Riau' ? 'selected' : '' }}>Riau</option>
                        <option value="Kepulauan Riau" {{ old('province') == 'Kepulauan Riau' ? 'selected' : '' }}>Kepulauan Riau</option>
                        <option value="Jambi" {{ old('province') == 'Jambi' ? 'selected' : '' }}>Jambi</option>
                        <option value="Bengkulu" {{ old('province') == 'Bengkulu' ? 'selected' : '' }}>Bengkulu</option>
                        <option value="Sumatera Selatan" {{ old('province') == 'Sumatera Selatan' ? 'selected' : '' }}>Sumatera Selatan</option>
                        <option value="Bangka Belitung" {{ old('province') == 'Bangka Belitung' ? 'selected' : '' }}>Bangka Belitung</option>
                        <option value="Lampung" {{ old('province') == 'Lampung' ? 'selected' : '' }}>Lampung</option>
                        <option value="Banten" {{ old('province') == 'Banten' ? 'selected' : '' }}>Banten</option>
                        <option value="Jawa Barat" {{ old('province') == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                        <option value="DKI Jakarta" {{ old('province') == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                        <option value="Jawa Tengah" {{ old('province') == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                        <option value="DI Yogyakarta" {{ old('province') == 'DI Yogyakarta' ? 'selected' : '' }}>DI Yogyakarta</option>
                        <option value="Jawa Timur" {{ old('province') == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                        <option value="Bali" {{ old('province') == 'Bali' ? 'selected' : '' }}>Bali</option>
                        <option value="Nusa Tenggara Barat" {{ old('province') == 'Nusa Tenggara Barat' ? 'selected' : '' }}>Nusa Tenggara Barat</option>
                        <option value="Nusa Tenggara Timur" {{ old('province') == 'Nusa Tenggara Timur' ? 'selected' : '' }}>Nusa Tenggara Timur</option>
                        <option value="Kalimantan Barat" {{ old('province') == 'Kalimantan Barat' ? 'selected' : '' }}>Kalimantan Barat</option>
                        <option value="Kalimantan Tengah" {{ old('province') == 'Kalimantan Tengah' ? 'selected' : '' }}>Kalimantan Tengah</option>
                        <option value="Kalimantan Selatan" {{ old('province') == 'Kalimantan Selatan' ? 'selected' : '' }}>Kalimantan Selatan</option>
                        <option value="Kalimantan Timur" {{ old('province') == 'Kalimantan Timur' ? 'selected' : '' }}>Kalimantan Timur</option>
                        <option value="Kalimantan Utara" {{ old('province') == 'Kalimantan Utara' ? 'selected' : '' }}>Kalimantan Utara</option>
                        <option value="Sulawesi Utara" {{ old('province') == 'Sulawesi Utara' ? 'selected' : '' }}>Sulawesi Utara</option>
                        <option value="Sulawesi Tengah" {{ old('province') == 'Sulawesi Tengah' ? 'selected' : '' }}>Sulawesi Tengah</option>
                        <option value="Sulawesi Selatan" {{ old('province') == 'Sulawesi Selatan' ? 'selected' : '' }}>Sulawesi Selatan</option>
                        <option value="Sulawesi Tenggara" {{ old('province') == 'Sulawesi Tenggara' ? 'selected' : '' }}>Sulawesi Tenggara</option>
                        <option value="Gorontalo" {{ old('province') == 'Gorontalo' ? 'selected' : '' }}>Gorontalo</option>
                        <option value="Sulawesi Barat" {{ old('province') == 'Sulawesi Barat' ? 'selected' : '' }}>Sulawesi Barat</option>
                        <option value="Maluku" {{ old('province') == 'Maluku' ? 'selected' : '' }}>Maluku</option>
                        <option value="Maluku Utara" {{ old('province') == 'Maluku Utara' ? 'selected' : '' }}>Maluku Utara</option>
                        <option value="Papua" {{ old('province') == 'Papua' ? 'selected' : '' }}>Papua</option>
                        <option value="Papua Barat" {{ old('province') == 'Papua Barat' ? 'selected' : '' }}>Papua Barat</option>
                        <option value="Papua Selatan" {{ old('province') == 'Papua Selatan' ? 'selected' : '' }}>Papua Selatan</option>
                        <option value="Papua Tengah" {{ old('province') == 'Papua Tengah' ? 'selected' : '' }}>Papua Tengah</option>
                        <option value="Papua Pegunungan" {{ old('province') == 'Papua Pegunungan' ? 'selected' : '' }}>Papua Pegunungan</option>
                        <option value="Papua Barat Daya" {{ old('province') == 'Papua Barat Daya' ? 'selected' : '' }}>Papua Barat Daya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label required">Kode Pos</label>
                    <input type="text" 
                           name="postal_code" 
                           class="form-input" 
                           value="{{ old('postal_code') }}"
                           placeholder="Contoh: 12345"
                           pattern="[0-9]{5}"
                           maxlength="5"
                           required>
                </div>
            </div>

            <!-- Primary Address Checkbox -->
            <div class="checkbox-group">
                <input type="checkbox" 
                       name="is_primary" 
                       id="is_primary"
                       class="form-checkbox"
                       value="1"
                       {{ old('is_primary') ? 'checked' : '' }}>
                <label for="is_primary" class="checkbox-label">
                    Jadikan sebagai alamat utama
                </label>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('profile.show') }}" class="btn-secondary">
                    ← Batal
                </a>
                <button type="submit" class="btn-primary">
                    💾 Simpan Alamat
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('addressForm');
        const submitBtn = form.querySelector('button[type="submit"]');
        
        // Add smooth animations for form inputs
        const formInputs = document.querySelectorAll('.form-input, .form-textarea, .form-select');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Format phone number input
        const phoneInput = document.querySelector('input[name="phone"]');
        if (phoneInput) {
            phoneInput.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value.startsWith('0')) {
                    value = '62' + value.substring(1);
                }
                if (!value.startsWith('62')) {
                    value = '62' + value;
                }
                this.value = '+' + value;
            });
        }

        // Format postal code input
        const postalInput = document.querySelector('input[name="postal_code"]');
        if (postalInput) {
            postalInput.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '').substring(0, 5);
            });
        }

        // Form validation
        form.addEventListener('submit', function(e) {
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '⏳ Menyimpan...';
            
            // Validate required fields
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#ef4444';
                    field.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
                } else {
                    field.style.borderColor = 'rgba(102, 126, 234, 0.2)';
                    field.style.boxShadow = 'none';
                }
            });
            
            // Validate postal code format
            const postalCode = document.querySelector('input[name="postal_code"]').value;
            if (postalCode && !/^\d{5}$/.test(postalCode)) {
                isValid = false;
                postalInput.style.borderColor = '#ef4444';
                postalInput.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
            }
            
            if (!isValid) {
                e.preventDefault();
                submitBtn.disabled = false;
                submitBtn.innerHTML = '💾 Simpan Alamat';
                
                // Show error message
                const errorAlert = document.createElement('div');
                errorAlert.className = 'alert alert-error';
                errorAlert.innerHTML = 'Mohon lengkapi semua field yang wajib diisi dengan benar.';
                form.parentElement.insertBefore(errorAlert, form);
                
                // Auto-hide error message
                setTimeout(() => {
                    errorAlert.remove();
                }, 5000);
                
                return;
            }
            
            // Reset button state after timeout (fallback)
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '💾 Simpan Alamat';
            }, 10000);
        });

        // Add ripple effect to buttons
        const buttons = document.querySelectorAll('.btn-primary, .btn-secondary');
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

        // Add character counter for textarea
        const textarea = document.querySelector('textarea[name="address_line_1"]');
        if (textarea) {
            const counter = document.createElement('div');
            counter.className = 'form-help';
            counter.style.textAlign = 'right';
            counter.style.marginTop = '4px';
            textarea.parentElement.appendChild(counter);
            
            const updateCounter = () => {
                const length = textarea.value.length;
                counter.textContent = `${length}/500 karakter`;
                if (length > 450) {
                    counter.style.color = '#ef4444';
                } else {
                    counter.style.color = '#718096';
                }
            };
            
            textarea.addEventListener('input', updateCounter);
            textarea.setAttribute('maxlength', '500');
            updateCounter();
        }

        // Province selection enhancement
        const provinceSelect = document.querySelector('select[name="province"]');
        if (provinceSelect) {
            provinceSelect.addEventListener('change', function() {
                // You can add logic here to update cities based on province
                // This is a placeholder for potential future enhancement
                console.log('Province changed to:', this.value);
            });
        }

        // Add floating label effect
        formInputs.forEach(input => {
            const label = input.parentElement.querySelector('.form-label');
            if (label) {
                const checkValue = () => {
                    if (input.value.trim() !== '') {
                        label.style.transform = 'translateY(-8px) scale(0.85)';
                        label.style.color = '#667eea';
                    } else {
                        label.style.transform = 'translateY(0) scale(1)';
                        label.style.color = '#2d3748';
                    }
                };
                
                input.addEventListener('focus', checkValue);
                input.addEventListener('blur', checkValue);
                input.addEventListener('input', checkValue);
                
                // Initial check
                checkValue();
            }
        });
    });

    // Add CSS for ripple animation and enhanced effects
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
        
        .btn-primary, .btn-secondary {
            position: relative;
            overflow: hidden;
        }
        
        .form-label {
            transition: all 0.3s ease;
            transform-origin: left top;
        }
        
        .form-input:invalid {
            border-color: rgba(239, 68, 68, 0.5);
        }
        
        .form-input:valid {
            border-color: rgba(34, 197, 94, 0.5);
        }
        
        .checkbox-group:hover .form-checkbox {
            transform: scale(1.1);
        }
        
        .form-checkbox {
            transition: transform 0.2s ease;
        }
        
        .location-group .form-group {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .location-group .form-group:nth-child(2) {
            animation-delay: 0.1s;
        }
        
        .location-group .form-group:nth-child(3) {
            animation-delay: 0.2s;
        }
    `;
    document.head.appendChild(style);
</script>
@endsection