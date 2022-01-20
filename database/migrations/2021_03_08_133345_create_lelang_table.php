<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLelangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('azriel_lelangs', function (Blueprint $table) {
             $table->increments('id_lelang');
            $table->integer('petugas_id')->unsigned();
            $table->integer('barang_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->datetime('tanggal_dibuka');
            $table->datetime('tanggal_ditutup');
            $table->integer('harga_akhir')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('petugas_id')->references('id_petugas')->on('azriel_petugass')->onDelete('cascade');
            $table->foreign('barang_id')->references('id_barang')->on('azriel_barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('azriel_lelangs');
        Schema::enableForeignKeyConstraints();
    }
}
