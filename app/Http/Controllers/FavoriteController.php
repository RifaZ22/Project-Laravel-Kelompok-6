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

    $exists = \App\Models\Favorite::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->exists();

    if (!$exists) {
        \App\Models\Favorite::create([
            'user_id' => $user->id,
            'product_id' => $productId,
        ]);
    }

    return redirect()->back()->with('success', 'Berhasil ditambahkan ke favorit.');
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

public function toggle($productId)
{
    $user = auth()->user();

    $favorite = \App\Models\Favorite::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();

    if ($favorite) {
        $favorite->delete();
        return response()->json(['status' => 'removed']);
    } else {
        \App\Models\Favorite::create([
            'user_id' => $user->id,
            'product_id' => $productId,
        ]);
        return response()->json(['status' => 'added']);
    }
}

}

