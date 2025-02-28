<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    
    protected $fillable = [
        'pelanggan_id',
        'promo_code',
        'tanggal_pemesanan',
        'status',
        'alamat',
        'notes',
        'promo_discount',
        'total_harga'
    ];

    protected $dates = ['updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'pelanggan_id');
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'pemesanan_id', 'id');
    }

    public function detailPemesanan()
    {
        return $this->hasMany(DetailPemesanan::class,'pemesanan_id', 'id');
    }
}