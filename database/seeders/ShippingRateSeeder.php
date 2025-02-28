<?php

namespace Database\Seeders;

use App\Models\ShippingMethod;
use App\Models\ShippingRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mengambil ID dari setiap metode pengiriman
        $kurirCmayId = ShippingMethod::where('name', 'Kurir Cmay')->first()->id;
        $gojekId = ShippingMethod::where('name', 'Gojek')->first()->id;
        $jneId = ShippingMethod::where('name', 'JNE')->first()->id;
        $makandiTempatId = ShippingMethod::where('name', 'makan Di Tempat')->first()->id;

        // Data tarif untuk Kurir Cmay (Jakarta Timur)
        ShippingRate::create([
            'shipping_method_id' => $kurirCmayId,
            'destination' => 'Jakarta Timur',
            'rate' => 10000
        ]);

        // Data tarif untuk Gojek (Jabodetabek)
        $gojekRates = [
            ['destination' => 'Jakarta Barat', 'rate' => 53000],
            ['destination' => 'Jakarta Selatan', 'rate' => 35000],
            ['destination' => 'Jakarta Utara', 'rate' => 33000],
            ['destination' => 'Jakarta Pusat', 'rate' => 25000],
            ['destination' => 'Jakarta Timur', 'rate' => 15000],
        ];

        foreach ($gojekRates as $rate) {
            ShippingRate::create(array_merge(['shipping_method_id' => $gojekId], $rate));
        }

        // Data tarif untuk JNE (Antar Kota)
        $jneRates = [
            ['destination' => 'Bandung', 'rate' => 33000],
            ['destination' => 'Surabaya', 'rate' => 50000],
            ['destination' => 'Yogyakarta', 'rate' => 40000],
            ['destination' => 'Bogor', 'rate' => 15000],
            ['destination' => 'Depok', 'rate' => 15000],
            ['destination' => 'Tangerang', 'rate' => 15000],
            ['destination' => 'Bekasi', 'rate' => 15000],
        ];

        foreach ($jneRates as $rate) {
            ShippingRate::create(array_merge(['shipping_method_id' => $jneId], $rate));
        }

        $makanTempatRates = [
            ['destination' => 'Bandung', 'rate' => 0],
            ['destination' => 'Surabaya', 'rate' => 0],
            ['destination' => 'Yogyakarta', 'rate' => 0],
            ['destination' => 'Bogor', 'rate' => 0],
            ['destination' => 'Depok', 'rate' => 0],
            ['destination' => 'Tangerang', 'rate' => 0],
            ['destination' => 'Bekasi', 'rate' => 0],
            ['destination' => 'Jakarta Barat', 'rate' => 0],
            ['destination' => 'Jakarta Selatan', 'rate' => 0],
            ['destination' => 'Jakarta Utara', 'rate' => 0],
            ['destination' => 'Jakarta Pusat', 'rate' => 0],
            ['destination' => 'Jakarta Timur', 'rate' => 0],
        ];

        foreach ($makanTempatRates as $rate) {
            ShippingRate::create(array_merge(['shipping_method_id' => $makandiTempatId], $rate));
        }
    }
}
