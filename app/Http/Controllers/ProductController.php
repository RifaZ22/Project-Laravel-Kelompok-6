<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // menampilkan list produk
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    // tampilkan form tambah
    public function create()
    {
        return view('product.create');
    }

    // simpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required',
            'description' => 'nullable',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($file = $request->file('image')) {
            $validated['image'] = $file->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil disimpan!');
    }

    // tampilkan form edit
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    // perbarui produk
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required',
            'description' => 'nullable',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($file = $request->file('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $file->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil diperbarui!');
    }

    // hapus produk
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil dihapus!');
    }

    public function show($id)
{
    $product = Product::findOrFail($id);
    return view('products.show', compact('product'));
}
}
