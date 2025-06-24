@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">🛒 Keranjang Belanja Kamu</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($cartItems->count() > 0)
        <div class="overflow-x-auto bg-white shadow rounded-lg p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Produk</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Harga</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Jumlah</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Subtotal</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($cartItems as $item)
                    <tr>
                        <td class="px-4 py-4 flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                            <span class="text-gray-800 font-medium">{{ $item->product->name }}</span>
                        </td>
                        <td class="px-4 py-4 text-gray-600">Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-4">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 border rounded px-2 py-1 text-center">
                                <button type="submit" class="text-blue-500 hover:underline text-sm">Update</button>
                            </form>
                        </td>
                        <td class="px-4 py-4 font-semibold text-gray-800">
                            Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-4">
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 flex justify-between items-center">
                <div class="text-xl font-semibold text-gray-800">
                    Total: Rp{{ number_format($totalPrice, 0, ',', '.') }}
                </div>
                <a href="{{ route('checkout.index') }}" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 shadow">
                    Checkout Sekarang
                </a>
            </div>
        </div>
    @else
        <div class="text-center bg-white p-8 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2 text-gray-700">Keranjang kamu kosong 😢</h2>
            <p class="text-gray-500 mb-4">Yuk tambahkan produk ke keranjang!</p>
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Belanja Sekarang</a>
        </div>
    @endif
</div>
@endsection
