<?php

namespace App\Models;

use App\Http\Controllers\ReviewController;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $fillable = ['pelanggan_id', 'product_id', 'pemesanan_id', 'bintang', 'ulasan'];

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'pelanggan_id','id');
    }
}
