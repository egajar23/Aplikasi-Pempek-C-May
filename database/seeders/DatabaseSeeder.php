<?php

namespace Database\Seeders;

use App\Models\ShippingMethod;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'no_hp' => '08129928298',
            'postal_code' => '13110',
            'province' => 'DKI Jakarta',
            'city' => 'Jakarta Barat',
            'address' => 'jl.pisangan baru tengah no.12, Matraman',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'budi',
            'email' => 'budi@gmail.com',
            'no_hp' => '08129928291',
            'postal_code' => '11530',
            'province' => 'DKI Jakarta',
            'city' => 'Jakarta Selatan',
            'address' => 'Jl. Raya Kb. Jeruk No.27, RT.1/RW.9, Kemanggisan',
            'role' => 'user',
        ]);
        User::factory()->create([
            'name' => 'rodi',
            'email' => 'rodi@gmail.com',
            'no_hp' => '0818171727',
            'postal_code' => '12321',
            'province' => 'DKI Jakarta',
            'city' => 'Jakarta Selatan',
            'address' => 'Jalan Batu Merah IV, Pejaten Timur, Pasar Minggu',
            'role' => 'user',
        ]);
        User::factory()->create([
            'name' => 'ammar',
            'email' => 'ammar@gmail.com',
            'no_hp' => '08181717227',
            'postal_code' => '123221',
            'province' => 'DKI Jakarta',
            'city' => 'Jakarta Timur',
            'address' => 'Jalan Batu Merah IV, Pejaten Timur, Pasar Minggu',
            'role' => 'user',
        ]);

        $this->call([
            PemesananSeeder::class,
            DetailPemesananSeeder::class,
            PromoSeeder::class,
            ProductSeeder::class,
            ShippingMethodSeeder::class,
            ShippingRateSeeder::class
        ]);
    }
}
