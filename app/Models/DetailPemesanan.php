<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    protected $table = 'detail_pemesanan';
    
    protected $fillable = [
        'pemesanan_id',
        'produk_id',
        'jumlah',
        'harga_satuan'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(Product::class, 'produk_id', 'id');
    }

}