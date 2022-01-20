<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryLelangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_lelangs', function (Blueprint $table) {
           $table->increments('id_history');
            $table->integer('lelang_id')->unsigned();
            $table->integer('barang_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('penawaran_harga');
            $table->timestamps();
            $table->foreign('lelang_id')->references('id_lelang')->on('azriel_lelangs')->onDelete('cascade');
            $table->foreign('barang_id')->references('id_barang')->on('azriel_barangs')->onDelete('cascade');
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_lelangs');
        Schema::enableForeignKeyConstraints();
    }
}
