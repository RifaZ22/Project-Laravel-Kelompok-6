<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;


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
    Route::post('/checkout/beli-sekarang', [CheckoutController::class, 'beliLangsung'])
    ->name('checkout.direct');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    


});

Auth::routes();
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

require __DIR__.'/auth.php';

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::resource('products', ProductController::class);
Route::get('/admin/produk', [ProductController::class, 'index'])->name('produk.index');


Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.detail');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');


Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('dashboard.orders');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/dashboard/favorites', [FavoriteController::class, 'index'])->name('dashboard.favorites');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'remove']);
    Route::delete('/favorites/clear', [FavoriteController::class, 'clearAll'])->name('favorites.clear');

    Route::post('/favorite/{productId}', [FavoriteController::class, 'store'])->name('favorite.store');

    Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('dashboard.orders');
    Route::get('/dashboard/favorites', [FavoriteController::class, 'index'])->name('dashboard.favorites');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'remove']);
    Route::delete('/favorites/clear', [FavoriteController::class, 'clearAll'])->name('favorites.clear');
    Route::post('/favorite/{productId}', [FavoriteController::class, 'store'])->name('favorite.store');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/profile/addresses/create', [AddressController::class, 'create'])->name('profile.addresses.create');
    Route::post('/profile/addresses', [AddressController::class, 'store'])->name('profile.addresses.store');
    Route::post('/favorite/{productId}', [FavoriteController::class, 'store'])->name('favorite.store');



    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    Route::get('/dashboard/reward', [RewardController::class, 'index'])->name('reward.index');

    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.proses');
    Route::get('/checkout/konfirmasi', [CheckoutController::class, 'konfirmasi'])->name('checkout.konfirmasi');
});

});



