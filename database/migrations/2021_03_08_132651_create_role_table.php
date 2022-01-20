<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->increments('id_role');
            $table->string('role');
            $table->timestamps();
        });
         DB::table('role')->insert([
            ['role' => 'Admin'],
            ['role' => 'Officer'],
            ['role' => 'Public'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
        Schema::enableForeignKeyConstraints();
    }
}
