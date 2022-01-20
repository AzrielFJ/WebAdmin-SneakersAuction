<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('azriel_barangs', function (Blueprint $table) {
           $table->increments('id_barang');
           $table->string("nama_barang");
            $table->date('tanggal');
            $table->integer('harga_awal');
            $table->string('deskripsi_barang');
            $table->string('foto');
            $table->string('status');
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
        Schema::dropIfExists('azriel_barangs');
    }
}
