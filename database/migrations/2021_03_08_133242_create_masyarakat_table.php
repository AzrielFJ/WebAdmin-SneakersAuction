<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasyarakatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('azriel_masyarakats', function (Blueprint $table) {
            $table->increments('id_masyarakat');
            $table->integer('user_id')->unsigned();
            $table->string('nama_lengkap');
            $table->string('no_telp');
            $table->string('alamat');
            $table->timestamps();
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
        Schema::dropIfExists('azriel_masyarakats');
        Schema::enableForeignKeyConstraints();
    }
}
