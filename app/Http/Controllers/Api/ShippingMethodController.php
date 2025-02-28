<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use App\Models\ShippingRate;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    public function index(Request $request)
    {
        $city = $request->input('city');

        if ($city) {
            // Ambil metode pengiriman yang mendukung kota tersebut
            $methods = ShippingMethod::whereHas('rates', function ($query) use ($city) {
                $query->where('destination', $city);
            })->with(['rates' => function ($query) use ($city) {
                $query->where('destination', $city);
            }])->get();
        } else {
            // Jika tidak ada filter kota, tampilkan semua metode pengiriman
            $methods = ShippingMethod::all();
        }

        return response()->json($methods);
    }

    public function getRate(Request $request)
    {
        $methodId = $request->input('method_id');
        $city = $request->input('city');

        $shippingRate = ShippingRate::where('shipping_method_id', $methodId)
                                    ->where('destination', $city)
                                    ->first();

        if ($shippingRate) {
            return response()->json(['rate' => $shippingRate->rate]);
        } else {
            return response()->json(['rate' => 0]);
        }
    }
}
