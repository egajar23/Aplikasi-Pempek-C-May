<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsedPromo extends Model
{
    //
    protected $fillable = ['pelanggan_id', 'promo_id', 'times_promo_used'];

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'promo_id', 'id');
    }


}
