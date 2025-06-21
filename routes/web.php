<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return redirect('/checkout');
});

// Rute Checkout saja
Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.proses');
Route::get('/checkout/konfirmasi', [CheckoutController::class, 'konfirmasi'])->name('checkout.konfirmasi');

// Rute Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
