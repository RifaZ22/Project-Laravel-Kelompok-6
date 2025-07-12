<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Toko Sepatus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-white min-h-screen font-sans">

    <div class="max-w-2xl mx-auto mt-10 px-4 py-6 bg-white rounded-2xl shadow-xl border border-gray-200">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center justify-center gap-2">
                🛒 <span>Formulir Checkout</span>
            </h1>
            <p class="text-sm text-gray-500">Lengkapi data berikut untuk memproses pesanan kamu</p>
        </div>

        {{-- Tampilkan alert jika keranjang kosong --}}
        @if(session('cart') == null || count(session('cart')) == 0)
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded mb-5">
                Keranjang belanja kamu masih kosong.
            </div>
        @endif

        <form action="{{ route('checkout.proses') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Masukkan nama lengkap"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" required></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
                <input type="text" name="no_hp" placeholder="08xxxxxxxxxx"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" required>
            </div>

            @if(session('cart'))
                <div class="border-t border-gray-200 pt-4">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Ringkasan Belanja</h2>
                    <ul class="divide-y divide-gray-100">
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $item)
                            <li class="py-2 flex justify-between items-center">
                                <span>{{ $item['nama'] }} (x{{ $item['jumlah'] }})</span>
                                <span class="font-medium">Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</span>
                            </li>
                            @php $total += $item['harga'] * $item['jumlah']; @endphp
                        @endforeach
                        <li class="py-2 font-bold text-right text-blue-700">
                            Total: Rp {{ number_format($total, 0, ',', '.') }}
                        </li>
                    </ul>
                </div>
            @endif

            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200 shadow-md">
                    Pesan Sekarang
                </button>
            </div>
        </form>
    </div>

</body>
</html>