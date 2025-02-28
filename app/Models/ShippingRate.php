<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingRate extends Model
{
    use HasFactory;
    protected $fillable = ['shipping_method_id', 'destination', 'rate'];

    public function method()
    {
        return $this->belongsTo(ShippingMethod::class);
    }
}
