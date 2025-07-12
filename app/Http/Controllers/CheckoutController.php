<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;


class CheckoutController extends Controller
{
    public function showCheckout()
    {
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

    if ($request->has('product_id')) {
        // Dari tombol "Beli Sekarang"
        $order = Order::create([
            'user_id' => auth()->id(),
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'no_hp' => $validated['no_hp'],
            'total_harga' => $request->harga,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $request->product_id,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
        ]);
    } else {
        // Dari keranjang
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'no_hp' => $validated['no_hp'],
            'total_harga' => $total,
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga'],
            ]);
        }

        session()->forget('cart');
    }

    return redirect()->route('checkout.konfirmasi')->with('success', 'Pesanan berhasil disimpan!');
}


    public function konfirmasi()
    {
        return view('checkout.konfirmasi');
    }


public function beliLangsung(Request $request)
{
    $productId = $request->input('product_id');
    $product = Product::findOrFail($productId);

    return view('checkout.index', [
        'product' => $product,
        'directBuy' => true
    ]);
}

}
