<?php

namespace App\Http\Controllers;

use App\Models\Sepatu;
use Illuminate\Http\Request;

class SepatuController extends Controller
{
    public function index()
    {
        $data = Sepatu::all();
        return view('sepatu.index', compact('data'));
    }

    public function create()
    {
        return view('sepatu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required',
            'merek'  => 'required',
            'harga'  => 'required|numeric',
            'ukuran' => 'required',
            // Jika nantinya upload gambar, tambahkan validasi untuk 'gambar'
        ]);

        // Ambil seluruh data input, bisa melakukan proses upload gambar jika perlu
        $input = $request->all();

        // Simpan data sepatu ke database
        Sepatu::create($input);

        return redirect()->route('sepatu.index')
                         ->with('success', 'Sepatu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sepatu = Sepatu::findOrFail($id);
        return view('sepatu.edit', compact('sepatu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'   => 'required',
            'merek'  => 'required',
            'harga'  => 'required|numeric',
            'ukuran' => 'required',
        ]);

        $sepatu = Sepatu::findOrFail($id);
        $sepatu->update($request->all());

        return redirect()->route('sepatu.index')->with('success', 'Data sepatu berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $sepatu = Sepatu::findOrFail($id);
        $sepatu->delete();

        return redirect()->route('sepatu.index')->with('success', 'Data sepatu berhasil dihapus.');
    }
}
