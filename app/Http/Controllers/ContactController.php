<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Tampilkan halaman Hubungi Kami
    public function index()
    {
        return view('contact'); // file: resources/views/contact.blade.php
    }

    // Tangani kirim pesan
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required|string|max:1000',
        ]);

        // Contoh: kirim email ke admin
        try {
            // Jika belum ingin mengirim email sungguhan, kamu bisa skip bagian ini
            /*
            Mail::to('admin@enamour.id')->send(new ContactMessageMail($request->all()));
            */

            return redirect()->route('contact')->with('success', 'Pesan Anda berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->route('contact')->with('error', 'Terjadi kesalahan. Silakan coba lagi nanti.');
        }
    }
}
