<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ShopController extends Controller
{
    public function index(Request $request)
{
    $products = Product::latest()->take(12)->get(); // atau pakai all() jika ingin semua
    $from = $request->query('from', null); // ambil parameter dari URL jika ada

    return view('shop', compact('products', 'from'));
}



}

$from = request('from', 'shop'); // default 'shop'
