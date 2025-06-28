<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        // Dummy cart data untuk testing (hapus nanti kalau fitur cart temanmu sudah aktif)
        if (!session()->has('cart') || count(session('cart')) == 0) {
            session([
                'cart' => [
                    1 => [
                        'nama' => 'Sepatu Converse',
                        'harga' => 300000,
                        'jumlah' => 2
                    ],
                    2 => [
                        'nama' => 'Sepatu Vans',
                        'harga' => 250000,
                        'jumlah' => 1
                    ]
                ]
            ]);
        }

        $cart = session()->get('cart', []);
        return view('checkout.index', compact('cart'));
    }

    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        $order = Order::create([
        'nama' => $validated['nama'],
        'alamat' => $validated['alamat'],
        'no_hp' => $validated['no_hp'],
        'total_harga' => $total,
        ]);


        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'produk_id' => $id,
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga'],
            ]);
        }

        session()->forget('cart'); // kosongkan cart setelah pesan

        return redirect()->route('checkout.konfirmasi');
    }

    public function konfirmasi()
    {
        return view('checkout.konfirmasi');
    }
}
