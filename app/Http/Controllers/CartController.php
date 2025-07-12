<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $productId)
                    ->first();

        if ($cart) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

         return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function remove($id)
    {
        $item = Cart::where('id', $id)->where('user_id', Auth::id())->first();
        if ($item) {
            $item->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}