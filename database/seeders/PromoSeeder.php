<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promo')->insert([
            [
                'produk_id' => 25,
                'nama' => 'Promo Paket Puas 1',
                'kode_promo' => 'PAKETPUAS1',
                'tipe_promo' => 'MEMBER',
                'tipe_diskon' => 'Persentase',
                'deskripsi' => 'Diskon besar-besaran untuk paket puas 1.',
                'max_diskon' => 20000,
                'diskon' => 50,
                'banner_promo' => "promo-paket-puas1.jpg",
                'tanggal_mulai' => Carbon::create('2024', '11', '30'),
                'tanggal_selesai' => Carbon::create('2024', '12', '20'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'produk_id' => 26,
                'nama' => 'Promo Paket Puas 1 Frozen',
                'kode_promo' => 'PUAS1FROZEN',
                'tipe_promo' => 'MEMBER',
                'tipe_diskon' => 'Persentase',
                'deskripsi' => 'Diskon besar-besaran untuk paket puas 1 frozen.',
                'max_diskon' => 20000,
                'diskon' => 50,
                'banner_promo' => "promo-paket-puas1.jpg",
                'tanggal_mulai' => Carbon::create('2024', '11', '30'),
                'tanggal_selesai' => Carbon::create('2024', '12', '20'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'produk_id' => null,
                'nama' => 'Promo Tahun Baru 2024',
                'kode_promo' => 'NEWYEAR2024',
                'tipe_promo' => 'UMUM',
                'tipe_diskon' => 'Ammount',
                'deskripsi' => 'Diskon khusus untuk merayakan tahun baru.',
                'max_diskon' => 0,
                'diskon' => 10000,
                'banner_promo' => "1733819233-pempekmenu.jpg",
                'tanggal_mulai' => Carbon::create('2024', '12', '10'),
                'tanggal_selesai' => Carbon::create('2025', '01', '02'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'produk_id' => null,
                'nama' => 'Promo Ulang Tahun Cmay',
                'kode_promo' => 'CMAYBIRTHDAY',
                'tipe_promo' => 'UMUM',
                'tipe_diskon' => 'Persentase',
                'deskripsi' => 'Dalam rangka merayakan ulang tahun cmay, cmay memberikan diskon sebesar 20% untuk seluruh produk dengan maksimum Rp.15.000.',
                'max_diskon' => 15000,
                'diskon' => 20,
                'banner_promo' => "cmay-promo-banner.jpg",
                'tanggal_mulai' => Carbon::create('2024', '12', '10'),
                'tanggal_selesai' => Carbon::create('2024', '12', '27'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
