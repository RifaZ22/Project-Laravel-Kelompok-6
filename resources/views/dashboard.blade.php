@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto text-center mt-10">
        <h1 class="text-2xl font-bold text-gray-800">Selamat datang di Dashboard</h1>
        <p class="text-gray-500 mt-2">Silakan kelola data atau lanjutkan aktivitas.</p>

        <!-- Tombol Logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                Logout
            </button>
        </form>
    </div>
@endsection
