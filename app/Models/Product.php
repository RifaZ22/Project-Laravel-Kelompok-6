<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',      // ← tambahkan ini
        'price',
        'stock',
    ];

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function favorites()
{
    return $this->hasMany(Favorite::class);
}

}
