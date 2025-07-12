@extends('layouts.app')

@section('content')
<style>
    .confirmation-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 90vh;
        background: linear-gradient(135deg, #764ba2, #667eea);
        color: #fff;
        text-align: center;
        padding: 2rem;
    }

    .confirmation-card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 3rem 2rem;
        max-width: 600px;
        width: 100%;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
    }

    .confirmation-icon {
        font-size: 60px;
        margin-bottom: 1rem;
        animation: pop 0.5s ease-out;
    }

    .confirmation-title {
        font-size: 2rem;
        margin-bottom: 1rem;
        font-weight: bold;
    }

    .confirmation-message {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .btn-shop {
        background: #fff;
        color: #764ba2;
        font-weight: bold;
        padding: 0.75rem 2rem;
        border-radius: 30px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
    }

    .btn-shop:hover {
        background: #f4f4f4;
        transform: scale(1.05);
    }

    @keyframes pop {
        0% { transform: scale(0); }
        100% { transform: scale(1); }
    }
</style>

<div class="confirmation-wrapper">
    <div class="confirmation-card">
        <div class="confirmation-icon">✅</div>
        <div class="confirmation-title">Pesanan Berhasil!</div>
        <div class="confirmation-message">
            Terima kasih telah memesan di toko kami. Pesananmu sedang kami proses dan akan segera dikirimkan.
        </div>
        <a href="{{ route('shop.index') }}" class="btn-shop">Kembali ke Toko</a>
    </div>
</div>
@endsection
