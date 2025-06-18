<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sepatu extends Model
{
    // Jika migration masih membuat tabel "sepatus"
    protected $table = 'sepatus';

    protected $fillable = ['nama', 'merek', 'harga', 'ukuran', 'deskripsi', 'gambar'];
}
