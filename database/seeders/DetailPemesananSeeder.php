<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailPemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define random product data
        $products = [
            ['produk_id' => 1, 'harga_satuan' => 25000.00],
            ['produk_id' => 2, 'harga_satuan' => 25000.00],
            ['produk_id' => 3, 'harga_satuan' => 7000.00],
            ['produk_id' => 4, 'harga_satuan' => 7000.00],
            ['produk_id' => 5, 'harga_satuan' => 7000.00],
            ['produk_id' => 6, 'harga_satuan' => 18000.00],
            ['produk_id' => 7, 'harga_satuan' => 28000.00],
            ['produk_id' => 8, 'harga_satuan' => 25000.00],
            ['produk_id' => 9, 'harga_satuan' => 25000.00],
            ['produk_id' => 10, 'harga_satuan' => 25000.00],
            ['produk_id' => 11, 'harga_satuan' => 7000.00],
            ['produk_id' => 12, 'harga_satuan' => 7000.00],
            ['produk_id' => 13, 'harga_satuan' => 7000.00],
            ['produk_id' => 14, 'harga_satuan' => 38000.00],
            ['produk_id' => 15, 'harga_satuan' => 38000.00],
            ['produk_id' => 16, 'harga_satuan' => 38000.00],
            ['produk_id' => 17, 'harga_satuan' => 38000.00],
            ['produk_id' => 18, 'harga_satuan' => 28000.00],
            ['produk_id' => 19, 'harga_satuan' => 28000.00],
            ['produk_id' => 20, 'harga_satuan' => 28000.00],
            ['produk_id' => 21, 'harga_satuan' => 28000.00],
            ['produk_id' => 22, 'harga_satuan' => 110000.00],
            ['produk_id' => 23, 'harga_satuan' => 110000.00],
            ['produk_id' => 24, 'harga_satuan' => 50000.00],
            ['produk_id' => 25, 'harga_satuan' => 50000.00],
            ['produk_id' => 26, 'harga_satuan' => 50000.00],
            ['produk_id' => 27, 'harga_satuan' => 50000.00],
            ['produk_id' => 28, 'harga_satuan' => 110000.00],
            ['produk_id' => 29, 'harga_satuan' => 110000.00],
            ['produk_id' => 30, 'harga_satuan' => 80000.00],

        ];

        // Function to generate random details
        function generateDetails($pemesananId, $products) {
            $details = [];
            $itemCount = rand(2, 5);
            $now = Carbon::now();

            for ($i = 0; $i < $itemCount; $i++) {
                $product = $products[array_rand($products)];
                $details[] = [
                    'pemesanan_id' => $pemesananId,
                    'produk_id' => $product['produk_id'],
                    'jumlah' => rand(1, 2),
                    'harga_satuan' => $product['harga_satuan'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            return $details;
        }

        // Insert random details for each order
        DB::table('detail_pemesanan')->insert([
            [
                'pemesanan_id' => 1,
                'produk_id' => 1,
                'jumlah' => 1,
                'harga_satuan' => $products[0]['harga_satuan'],
                'created_at' => '2024-01-12 14:25:36',
                'updated_at' => '2024-01-12 14:25:36',
            ],
            [
                'pemesanan_id' => 1,
                'produk_id' => 2,
                'jumlah' => 1,
                'harga_satuan' => $products[1]['harga_satuan'],
                'created_at' => '2024-01-12 14:25:36',
                'updated_at' => '2024-01-12 14:25:36',
            ],
            [
                'pemesanan_id' => 2,
                'produk_id' => 3,
                'jumlah' => 1,
                'harga_satuan' => $products[2]['harga_satuan'],
                'created_at' => '2024-02-25 11:10:59',
                'updated_at' => '2024-02-25 11:10:59',
            ],
            [
                'pemesanan_id' => 2,
                'produk_id' => 4,
                'jumlah' => 1,
                'harga_satuan' => $products[3]['harga_satuan'],
                'created_at' => '2024-02-25 11:10:59',
                'updated_at' => '2024-02-25 11:10:59',
            ],
            [
                'pemesanan_id' => 3,
                'produk_id' => 5,
                'jumlah' => 1,
                'harga_satuan' => $products[4]['harga_satuan'],
                'created_at' => '2024-03-05 08:30:45',
                'updated_at' => '2024-03-05 08:30:45',
            ],
            [
                'pemesanan_id' => 3,
                'produk_id' => 6,
                'jumlah' => 1,
                'harga_satuan' => $products[5]['harga_satuan'],
                'created_at' => '2024-03-05 08:30:45',
                'updated_at' => '2024-03-05 08:30:45',
            ],
            [
                'pemesanan_id' => 4,
                'produk_id' => 7,
                'jumlah' => 1,
                'harga_satuan' => $products[6]['harga_satuan'],
                'created_at' => '2024-04-15 13:45:55',
                'updated_at' => '2024-04-15 13:45:55',
            ],
            [
                'pemesanan_id' => 4,
                'produk_id' => 8,
                'jumlah' => 1,
                'harga_satuan' => $products[7]['harga_satuan'],
                'created_at' => '2024-04-15 13:45:55',
                'updated_at' => '2024-04-15 13:45:55',
            ],
            [
                'pemesanan_id' => 5,
                'produk_id' => 9,
                'jumlah' => 1,
                'harga_satuan' => $products[8]['harga_satuan'],
                'created_at' => '2024-05-08 12:05:30',
                'updated_at' => '2024-05-08 12:05:30',
            ],
            [
                'pemesanan_id' => 5,
                'produk_id' => 10,
                'jumlah' => 1,
                'harga_satuan' => $products[9]['harga_satuan'],
                'created_at' => '2024-05-08 12:05:30',
                'updated_at' => '2024-05-08 12:05:30',
            ],
            [
                'pemesanan_id' => 6,
                'produk_id' => 11,
                'jumlah' => 1,
                'harga_satuan' => $products[10]['harga_satuan'],
                'created_at' => '2024-06-18 23:15:10',
                'updated_at' => '2024-06-18 23:15:10',
            ],
            [
                'pemesanan_id' => 6,
                'produk_id' => 12,
                'jumlah' => 1,
                'harga_satuan' => $products[11]['harga_satuan'],
                'created_at' => '2024-06-18 23:15:10',
                'updated_at' => '2024-06-18 23:15:10',
            ],
            [
                'pemesanan_id' => 7,
                'produk_id' => 13,
                'jumlah' => 1,
                'harga_satuan' => $products[12]['harga_satuan'],
                'created_at' => '2024-07-01 10:00:00',
                'updated_at' => '2024-07-01 10:00:00',
            ],
            [
                'pemesanan_id' => 7,
                'produk_id' => 14,
                'jumlah' => 1,
                'harga_satuan' => $products[13]['harga_satuan'],
                'created_at' => '2024-07-01 10:00:00',
                'updated_at' => '2024-07-01 10:00:00',
            ],
            [
                'pemesanan_id' => 8,
                'produk_id' => 15,
                'jumlah' => 1,
                'harga_satuan' => $products[14]['harga_satuan'],
                'created_at' => '2024-08-29 18:30:45',
                'updated_at' => '2024-08-29 18:30:45',
            ],
            [
                'pemesanan_id' => 8,
                'produk_id' => 16,
                'jumlah' => 1,
                'harga_satuan' => $products[15]['harga_satuan'],
                'created_at' => '2024-08-29 18:30:45',
                'updated_at' => '2024-08-29 18:30:45',
            ],
            [
                'pemesanan_id' => 9,
                'produk_id' => 17,
                'jumlah' => 1,
                'harga_satuan' => $products[16]['harga_satuan'],
                'created_at' => '2024-09-09 15:10:25',
                'updated_at' => '2024-09-09 15:10:25',
            ],
            [
                'pemesanan_id' => 9,
                'produk_id' => 18,
                'jumlah' => 1,
                'harga_satuan' => $products[17]['harga_satuan'],
                'created_at' => '2024-09-09 15:10:25',
                'updated_at' => '2024-09-09 15:10:25',
            ],
            [
                'pemesanan_id' => 10,
                'produk_id' => 19,
                'jumlah' => 1,
                'harga_satuan' => $products[18]['harga_satuan'],
                'created_at' => '2024-10-25 22:05:10',
                'updated_at' => '2024-10-25 22:05:10',
            ],
            [
                'pemesanan_id' => 10,
                'produk_id' => 20,
                'jumlah' => 1,
                'harga_satuan' => $products[19]['harga_satuan'],
                'created_at' => '2024-10-25 22:05:10',
                'updated_at' => '2024-10-25 22:05:10',
            ],
            [
                'pemesanan_id' => 11,
                'produk_id' => 21,
                'jumlah' => 1,
                'harga_satuan' => $products[20]['harga_satuan'],
                'created_at' => '2024-11-11 06:30:45',
                'updated_at' => '2024-11-11 06:30:45',
            ],
            [
                'pemesanan_id' => 11,
                'produk_id' => 22,
                'jumlah' => 1,
                'harga_satuan' => $products[21]['harga_satuan'],
                'created_at' => '2024-11-11 06:30:45',
                'updated_at' => '2024-11-11 06:30:45',
            ],
            [
                'pemesanan_id' => 12,
                'produk_id' => 23,
                'jumlah' => 1,
                'harga_satuan' => $products[22]['harga_satuan'],
                'created_at' => '2024-12-03 19:15:15',
                'updated_at' => '2024-12-03 19:15:15',
            ],
            [
                'pemesanan_id' => 12,
                'produk_id' => 24,
                'jumlah' => 1,
                'harga_satuan' => $products[23]['harga_satuan'],
                'created_at' => '2024-12-03 19:15:15',
                'updated_at' => '2024-12-03 19:15:15',
            ],
            [
                'pemesanan_id' => 13,
                'produk_id' => 25,
                'jumlah' => 1,
                'harga_satuan' => $products[24]['harga_satuan'],
                'created_at' => Carbon::now(),
                'updated_at' =>  Carbon::now(),
            ],
            [
                'pemesanan_id' => 13,
                'produk_id' => 26,
                'jumlah' => 1,
                'harga_satuan' => $products[25]['harga_satuan'],
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now(),
            ],
        ]);
    }
}
