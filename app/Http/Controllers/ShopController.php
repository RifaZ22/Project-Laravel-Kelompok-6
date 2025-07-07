<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ShopController extends Controller
{
    public function index()
{
    $products = Product::latest()->take(12)->get(); // ambil 12 produk terbaru
    return view('shop', compact('products'));
}
    //
}
