<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->nullable();
            $table->string('nama');
            $table->string('kode_promo');
            $table->string('tipe_promo')->default("UMUM");
            $table->string('tipe_diskon')->default("Ammount");
            $table->text('deskripsi')->nullable();
            $table->float('max_diskon')->default(0);
            $table->float('diskon');
            $table->string('banner_promo')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo');
    }
}
