<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Izinkan kolom-kolom ini untuk mass assignment
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'total_harga',
    ];

    // Relasi ke order_items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
