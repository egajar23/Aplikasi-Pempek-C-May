<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // protected $table = 'cart';
    protected $fillable = ['pelanggan_id'];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
