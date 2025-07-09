<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // pastikan kamu sudah punya model Order

class OrderController extends Controller
{
    public function index()
    {
        // Ambil semua order milik user yang sedang login
        $orders = auth()->user()->orders;

        // Tampilkan ke view resources/views/dashboard/orders.blade.php
        return view('dashboard.orders', compact('orders'));
    }
}
