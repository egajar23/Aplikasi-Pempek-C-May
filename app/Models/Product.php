<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'type',
        'price',
        'weight',
        'stock',
        'active', // Remove 'image' as it's handled in a separate table
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'active' => 'boolean',
    ];

    /**
     * Define a one-to-many relationship with ProductImage.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function detailPemesanan()
    {
        return $this->hasMany(DetailPemesanan::class, 'produk_id', 'id');
    }

    public static function find($slug) {
        $product = Arr::first(static::all(), fn($product) => $product['slug'] == $slug);

        if(!$product){
            abort(404);
        }

        return $product;
    }
}
