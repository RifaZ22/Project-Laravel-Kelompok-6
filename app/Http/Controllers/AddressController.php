<?php

namespace App\Http\Controllers;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function create()
    {
        return view('profile.addresses.create'); // pastikan file blade ini nanti kamu buat juga
    }

    public function store(Request $request)
{
    $request->validate([
        'label' => 'required|string|max:255',
        'recipient_name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address_line_1' => 'required|string',
        'address_line_2' => 'nullable|string',
        'city' => 'required|string|max:100',
        'province' => 'required|string|max:100',
        'postal_code' => 'required|string|max:10',
        'is_primary' => 'nullable|boolean',
    ]);

    // Jika alamat utama dicentang, nonaktifkan yang lain
    if ($request->has('is_primary')) {
        Address::where('user_id', Auth::id())->update(['is_primary' => false]);
    }

    Address::create([
        'user_id' => Auth::id(),
        'label' => $request->label,
        'recipient_name' => $request->recipient_name,
        'phone' => $request->phone,
        'address_line_1' => $request->address_line_1,
        'address_line_2' => $request->address_line_2,
        'city' => $request->city,
        'province' => $request->province,
        'postal_code' => $request->postal_code,
        'is_primary' => $request->has('is_primary'),
    ]);

    return redirect()->route('profile.show')->with('success', 'Alamat berhasil ditambahkan.');
}
}
