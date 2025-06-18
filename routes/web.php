<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes - Fitur Checkout Saja
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/checkout');
});

// Rute Checkout saja
Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.proses');
Route::get('/checkout/konfirmasi', [CheckoutController::class, 'konfirmasi'])->name('checkout.konfirmasi');
