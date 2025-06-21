<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'stock'];

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
