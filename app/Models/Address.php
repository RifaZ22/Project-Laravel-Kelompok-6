<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'label',
        'recipient_name',
        'phone',
        'address_line_1',
        'address_line_2',
        'city',
        'province',
        'postal_code',
        'is_primary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

