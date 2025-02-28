<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ensure the product_images directory exists
        $imagesDir = custom_public_path('product');
        if (!File::exists($imagesDir)) {
            File::makeDirectory($imagesDir, 0755, true);
        }
        
        $productId = DB::table('products')->insertGetId([
            'name' => "Kapal Selam",
            'slug' => "kapal-selam",
            'description' => "1 porsi kapal selam dengan telur besar, cuko cmay, taburan ebi, timun dan mie kuning",
            'type' => 'Siap Saji',
            'price' => "25000",
            'stock' => "20",
            'weight' => 0.7,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId,
            'image_path' => "kapal_selam_siapSaji.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId,
            'image_path' => "kapal_selam_siapSaji-2.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId,
            'image_path' => "kapal_selam_siapSaji-3.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId2 = DB::table('products')->insertGetId([
            'name' => "lenjer",
            'slug' => "pempek-lenjer",
            'description' => "1 porsi isi 2 lenjer dengan cuko cmay, taburan ebi, timun dan mie kuning",
            'type' => 'Paket',
            'price' => "25000",
            'stock' => "20",
            'weight' => 0.8,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId2,
            'image_path' => "lenjer-cmay.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId2,
            'image_path' => "lenjer.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId3 = DB::table('products')->insertGetId([
            'name' => "Telur Kecil",
            'slug' => "telur-kecil",
            'description' => "Pempek telur kecil dengan isian telur kocok dibuat dari bahan segar dan premium.",
            'type' => 'Siap Saji',
            'price' => "7000",
            'stock' => "20",
            'weight' => 0.3,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId3,
            'image_path' => "pempek-telur-cmay.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId3,
            'image_path' => "pempek-telur-cmay-2.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $productId4 = DB::table('products')->insertGetId([
            'name' => "Kulit",
            'slug' => "pempek-kulit",
            'description' => "1 pcs pempek kulit isi campuran kulit dengan daging ikan tenggiri.",
            'type' => 'Siap Saji',
            'price' => "7000",
            'stock' => "20",
            'weight' => 0.25,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId4,
            'image_path' => "pempek-kulit-cmay.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId4,
            'image_path' => "pempek-kulit-cmay-2.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId5 = DB::table('products')->insertGetId([
            'name' => "Adaan",
            'slug' => "pempek-adaan",
            'description' => "1 pcs pempek adaan yang berisi adonan ikan tenggiri dicampur irisan bawang merah.",
            'type' => 'Siap Saji',
            'price' => "7000",
            'stock' => "20",
            'weight' => 0.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId5,
            'image_path' => "adaan-cmay.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId5,
            'image_path' => "adaan-2.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId6 = DB::table('products')->insertGetId([
            'name' => "Martabak Mie",
            'slug' => "martabak-mie",
            'description' => "1 porsi indomie kari ayam dengan telur kocok dan dibaluri cuko pempek.",
            'type' => 'Siap Saji',
            'price' => "18000",
            'stock' => "20",
            'weight' => 1.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId6,
            'image_path' => "martabak-mie.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId6,
            'image_path' => "Martabak_Mie.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId7 = DB::table('products')->insertGetId([
            'name' => "Lenggang Cmay",
            'slug' => "lenggang-cmay",
            'description' => "1 porsi berisi telur kocok dengan potongan lenjer, irisan timun, cabai, dan cuko pempek.",
            'type' => 'Siap Saji',
            'price' => "28000",
            'stock' => "20",
            'weight' => 1.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId7,
            'image_path' => "lenggang-cmay.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId7,
            'image_path' => "lenggang-cmay-2.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId8 = DB::table('products')->insertGetId([
            'name' => "Tekwan",
            'slug' => "tekwan",
            'description' => "Pentol tekwan cmay dengan kuah tekwan, irisan jamur, kuping itam, irisan bengkoang, bawang goreng, jeruk nipis dan cabai.",
            'type' => 'Siap Saji',
            'price' => "25000",
            'stock' => "20",
            'weight' => 1.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId8,
            'image_path' => "tekwan-cmay.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId8,
            'image_path' => "tekwan1.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId9 = DB::table('products')->insertGetId([
            'name' => "Lenjer Frozen",
            'slug' => "pempek-lenjer-frozen",
            'description' => "1 porsi isi 2 lenjer mentah/frozen dengan cuko cmay, taburan ebi, timun dan mie kuning",
            'type' => 'Frozen',
            'price' => "25000",
            'stock' => "20",
            'weight' => 0.8,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId9,
            'image_path' => "lenjer.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId9,
            'image_path' => "lenjer-cmay.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId10 = DB::table('products')->insertGetId([
            'name' => "Kapal Selam Frozen",
            'slug' => "kapal-selam-frozen",
            'description' => "1 porsi kapal selam mentah/frozen dengan telur besar, cuko cmay, taburan ebi, timun dan mie kuning.",
            'type' => 'Frozen',
            'price' => "25000",
            'stock' => "20",
            'weight' => 0.7,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId10,
            'image_path' => "kapal_selam_siapSaji-2.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId10,
            'image_path' => "kapal_selam_siapSaji.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId10,
            'image_path' => "kapal_selam_siapSaji-3.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId11 = DB::table('products')->insertGetId([
            'name' => "Telur Kecil Frozen",
            'slug' => "telur-kecil-frozen",
            'description' => "Pempek telur kecil mentah/frozen dengan isian telur kocok dibuat dari bahan segar dan premium.",
            'type' => 'Frozen',
            'price' => "7000",
            'stock' => "20",
            'weight' => 0.3,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId11,
            'image_path' => "pempek-telur-cmay-2.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId11,
            'image_path' => "pempek-telur-cmay.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId12 = DB::table('products')->insertGetId([
            'name' => "Kulit Frozen",
            'slug' => "pempek-kulit-frozen",
            'description' => "1 pcs pempek kulit mentah/frozen isi campuran kulit dengan daging ikan tenggiri.",
            'type' => 'Frozen',
            'price' => "7000",
            'stock' => "20",
            'weight' => 0.25,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId12,
            'image_path' => "pempek-kulit-cmay-2.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId12,
            'image_path' => "pempek-kulit-cmay.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId13 = DB::table('products')->insertGetId([
            'name' => "Adaan Frozen",
            'slug' => "pempek-adaan-frozen",
            'description' => "1 pcs pempek adaan mentah/frozen yang berisi adonan ikan tenggiri dicampur irisan bawang merah.",
            'type' => 'Frozen',
            'price' => "7000",
            'stock' => "20",
            'weight' => 0.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId13,
            'image_path' => "adaan-2.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId13,
            'image_path' => "adaan-cmay.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId14 = DB::table('products')->insertGetId([
            'name' => "Mix 1",
            'slug' => "paket-mix-1",
            'description' => "Paket yang berisikan 1 pcs kapal selam, 1pcs adaan, 1pcs kulit dengan mie kuning, cuko pempek, irisan timun dan cabai.",
            'type' => 'Paket',
            'price' => "38000",
            'stock' => "5",
            'weight' => 2.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId14,
            'image_path' => "paket-mix-1.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId14,
            'image_path' => "paket_pempek_mix.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId15 = DB::table('products')->insertGetId([
            'name' => "Mix 1 Frozen",
            'slug' => "paket-mix-1-frozen",
            'description' => "Paket frozen yang berisikan 1 pcs kapal selam, 1pcs adaan, 1pcs kulit dengan mie kuning, cuko pempek, irisan timun dan cabai.",
            'type' => 'Frozen',
            'price' => "38000",
            'stock' => "5",
            'weight' => 2.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId15,
            'image_path' => "paket_pempek_mix.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId15,
            'image_path' => "paket-mix-1.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId16 = DB::table('products')->insertGetId([
            'name' => "Mix 2",
            'slug' => "paket-mix-2",
            'description' => "Paket yang berisikan 1 porsi lenjer (2pcs), 1pcs adaan, 1pcs kulit dengan mie kuning, cuko pempek, irisan timun dan cabai.",
            'type' => 'Paket',
            'price' => "38000",
            'stock' => "5",
            'weight' => 2.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId16,
            'image_path' => "mix-2.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId17 = DB::table('products')->insertGetId([
            'name' => "Mix 2 Frozen",
            'slug' => "paket-mix-2-frozen",
            'description' => "Paket frozen yang berisikan 1 porsi lenjer (2pcs), 1pcs adaan, 1pcs kulit dengan mie kuning, cuko pempek, irisan timun dan cabai.",
            'type' => 'Frozen',
            'price' => "38000",
            'stock' => "5",
            'weight' => 2.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId17,
            'image_path' => "mix-2.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId18 = DB::table('products')->insertGetId([
            'name' => "Mix 3",
            'slug' => "paket-mix-3",
            'description' => "Paket yang berisikan 2pcs adaan, 2pcs kulit dengan mie kuning, cuko pempek, irisan timun dan cabai.",
            'type' => 'Paket',
            'price' => "28000",
            'stock' => "5",
            'weight' => 2.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId18,
            'image_path' => "mix-3.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId19 = DB::table('products')->insertGetId([
            'name' => "Mix 3 Frozen",
            'slug' => "paket-mix-3-frozen",
            'description' => "Paket frozen yang berisikan 2pcs adaan, 2pcs kulit dengan mie kuning, cuko pempek, irisan timun dan cabai.",
            'type' => 'Frozen',
            'price' => "28000",
            'stock' => "5",
            'weight' => 2.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId19,
            'image_path' => "mix-3.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId20 = DB::table('products')->insertGetId([
            'name' => "Mix 4",
            'slug' => "paket-mix-4",
            'description' => "Paket yang berisikan 1pcs telur kecil, 1pcs adaan, 1pcs kulit, dan 1 pcs lenjer.",
            'type' => 'Paket',
            'price' => "28000",
            'stock' => "5",
            'weight' => 2.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId20,
            'image_path' => "mix-4.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $productId21 = DB::table('products')->insertGetId([
            'name' => "Mix 4 Frozen",
            'slug' => "paket-mix-4-frozen",
            'description' => "Paket frozen yang berisikan 1pcs telur kecil, 1pcs adaan, 1pcs kulit, dan 1 pcs lenjer.",
            'type' => 'Frozen',
            'price' => "28000",
            'stock' => "5",
            'weight' => 2.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId21,
            'image_path' => "mix-4.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId22 = DB::table('products')->insertGetId([
            'name' => "Mix 5 (Mini Family)",
            'slug' => "paket-mix-5",
            'description' => "Paket yang berisikan 4pcs telur kecil, 4pcs adaan, 4pcs kulit, dan 4 pcs lenjer mini.",
            'type' => 'Paket',
            'price' => "110000",
            'stock' => "3",
            'weight' => 3.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId22,
            'image_path' => "mix-5.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $productId23 = DB::table('products')->insertGetId([
            'name' => "Mix 5 Frozen (Mini Family)",
            'slug' => "paket-mix-5-frozen",
            'description' => "Paket frozen yang berisikan 4pcs telur kecil, 4pcs adaan, 4pcs kulit, dan 4 pcs lenjer mini.",
            'type' => 'Frozen',
            'price' => "110000",
            'stock' => "3",
            'weight' => 3.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId23,
            'image_path' => "mix-5.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId24 = DB::table('products')->insertGetId([
            'name' => "Paket Puas 1",
            'slug' => "paket-puas-1",
            'description' => "Paket yang berisikan 2pcs kapal selam besar.",
            'type' => 'Paket',
            'price' => "50000",
            'stock' => "5",
            'weight' => 3.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId24,
            'image_path' => "paket-puas-1.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId25 = DB::table('products')->insertGetId([
            'name' => "Paket Puas 1 Frozen",
            'slug' => "paket-puas-1-frozen",
            'description' => "Paket frozen yang berisikan 2pcs kapal selam besar.",
            'type' => 'Frozen',
            'price' => "50000",
            'stock' => "5",
            'weight' => 3.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId25,
            'image_path' => "paket-puas-1.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId26 = DB::table('products')->insertGetId([
            'name' => "Paket Puas 2",
            'slug' => "paket-puas-2",
            'description' => "Paket yang berisikan 2 porsi lenjer (4 pcs).",
            'type' => 'Paket',
            'price' => "50000",
            'stock' => "5",
            'weight' => 3.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId26,
            'image_path' => "lenjer-cmay.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId27 = DB::table('products')->insertGetId([
            'name' => "Paket Puas 2 Frozen",
            'slug' => "paket-puas-2-frozen",
            'description' => "Paket frozen yang berisikan 2 porsi lenjer (4 pcs).",
            'type' => 'Frozen',
            'price' => "50000",
            'stock' => "5",
            'weight' => 3.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId27,
            'image_path' => "lenjer-cmay.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId28 = DB::table('products')->insertGetId([
            'name' => "Beli 3 Bonus 1 (BTS)",
            'slug' => "paket-beli-3-bonus-1",
            'description' => "Paket yang berisikan 3 pcs kapal selam dan pempek pilihan melalui notes (pempek bonus acak jika tidak ada notes).",
            'type' => 'Paket',
            'price' => "110000",
            'stock' => "5",
            'weight' => 3.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId28,
            'image_path' => "paket-bts.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId29 = DB::table('products')->insertGetId([
            'name' => "Beli 3 Bonus 1 Frozen (BTS)",
            'slug' => "paket-beli-3-bonus-1-frozen",
            'description' => "Paket frozen yang berisikan 3 pcs kapal selam dan pempek pilihan melalui notes (pempek bonus acak jika tidak ada notes).",
            'type' => 'Frozen',
            'price' => "110000",
            'stock' => "5",
            'weight' => 3.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId29,
            'image_path' => "paket-bts.jpeg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productId30 = DB::table('products')->insertGetId([
            'name' => "Paket Icip Icip",
            'slug' => "paket-icip-icip",
            'description' => "Paket frozen yang berisikan 3 porsi pempek pilihan sesuai selera dicatat di notes dan sudah divakum (pilihan pempek akan diacak jika tidak ada notes).",
            'type' => 'Frozen',
            'price' => "80000",
            'stock' => "5",
            'weight' => 3.2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_images')->insert([
            'product_id' => $productId30,
            'image_path' => "paket-icip-cmay.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('product_images')->insert([
            'product_id' => $productId30,
            'image_path' => "paket_pempek_icip_cmay.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}