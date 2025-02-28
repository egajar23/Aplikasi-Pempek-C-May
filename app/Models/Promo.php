<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi
    protected $table = 'promo';

    // Tentukan atribut yang dapat diisi massal
    protected $fillable = [
        'produk_id',
        'nama',
        'kode_promo',
        'tipe_promo',
        'tipe_diskon',
        'deskripsi',
        'max_diskon',
        'diskon',
        'banner_promo',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    // Relasi dengan model Pemesanan
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
    public function isActive()
    {
        $today = date('Y-m-d');
        return $this->tanggal_mulai <= $today && $this->tanggal_selesai >= $today;
    }
}
