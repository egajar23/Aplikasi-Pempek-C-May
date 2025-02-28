<?php

namespace Database\Seeders;

use App\Models\ShippingMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingMethod::create([
            'name' => 'Kurir Cmay',
            'description' => 'Layanan kurir untuk wilayah Jakarta Timur',
        ]);

        ShippingMethod::create([
            'name' => 'Gojek',
            'description' => 'Pengiriman cepat untuk area Jakarta',
        ]);

        ShippingMethod::create([
            'name' => 'JNE',
            'description' => 'Layanan pengiriman antar kota khususnya Jabodetabek',
        ]);

        ShippingMethod::create([
            'name' => 'Makan Di Tempat',
            'description' => 'Layanan Bagi pelanggan yang ingin makan di tempat dengan memesan pempek melalui website.',
        ]);
    }
}
