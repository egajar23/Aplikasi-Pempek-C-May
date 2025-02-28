<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pelanggan_id');
            $table->string('promo_code')->nullable();
            $table->timestamp('tanggal_pemesanan');
            $table->string('status'); //Pending->Menunggu Pembayaran->Dibayar->Dikonfirmasi->Dibatalkan 
            $table->string('type_pengiriman')->nullable();
            $table->string('notes')->nullable();
            $table->float('ongkir')->nullable();
            $table->float('promo_discount')->nullable();
            $table->string('alamat')->nullable();
            $table->string('bukti_transfer')->nullable();
            $table->float('total_harga');
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
        Schema::dropIfExists('pemesanan');
    }
}
