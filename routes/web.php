<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RewardController;



use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.proses');
    Route::get('/checkout/konfirmasi', [CheckoutController::class, 'konfirmasi'])->name('checkout.konfirmasi');
});

Auth::routes();
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

require __DIR__.'/auth.php';

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::resource('products', ProductController::class);

Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.detail');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');


Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('dashboard.orders');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/favorites', [FavoriteController::class, 'index'])->name('dashboard.favorites');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'remove']);
    Route::delete('/favorites/clear', [FavoriteController::class, 'clearAll']);

    Route::post('/favorite/{productId}', [FavoriteController::class, 'store'])->name('favorite.store');

    Route::middleware('auth')->group(function() {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/profile/addresses/create', [AddressController::class, 'create'])->name('profile.addresses.create');

    Route::post('/profile/addresses', [AddressController::class, 'store'])->name('profile.addresses.store');

    // Tampilkan halaman Hubungi Kami
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Tangani form kirim pesan (tanpa menyimpan ke database)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/dashboard/reward', [RewardController::class, 'index'])->name('reward.index');

});
});



