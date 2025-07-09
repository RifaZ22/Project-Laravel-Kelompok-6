<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()->with('product')->get();
        return view('dashboard.favorites', compact('favorites'));
    }

    public function store($productId)
{
    $user = auth()->user();

    // Cek apakah sudah difavoritkan
    $alreadyFavorited = Favorite::where('user_id', $user->id)
                                ->where('product_id', $productId)
                                ->first();

    if ($alreadyFavorited) {
        return back()->with('info', 'Produk sudah ada di favorit.');
    }

    // Simpan ke tabel favorit
    Favorite::create([
        'user_id' => $user->id,
        'product_id' => $productId,
    ]);

    return back()->with('success', 'Produk ditambahkan ke favorit.');
}



    public function destroy($favoriteId)
    {
        $favorite = Favorite::findOrFail($favoriteId);
        $favorite->delete();

        return redirect()->back()->with('success', 'Favorit dihapus.');
    }

    public function remove($id)
{
    $user = auth()->user();
    $user->favorites()->where('product_id', $id)->delete();
    return redirect()->back();
}

public function clearAll()
{
    $user = auth()->user();
    $user->favorites()->delete();
    return redirect()->back();
}
}

