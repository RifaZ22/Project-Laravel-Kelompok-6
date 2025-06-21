<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
public function index() {
    $cartItems = Cart::with('product')->where('user_id', 1)->get();
    return view('cart.index', compact('cartItems'));
}


public function add(Request $request, $productId)
{
    $cart = Cart::where('user_id', Auth::id())->where('product_id', $productId)->first();

    if ($cart) {
        $cart->quantity += 1;
        $cart->save();
    } else {
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'quantity' => 1,
        ]);
    }

    return redirect()->route('cart.index')->with('success', 'Ditambahkan ke keranjang!');
}

public function remove($id)
{
    Cart::where('id', $id)->where('user_id', Auth::id())->delete();
    return redirect()->route('cart.index')->with('success', 'Dihapus dari keranjang!');
}
}