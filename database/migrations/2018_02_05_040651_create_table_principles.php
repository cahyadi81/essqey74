<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePrinciples extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('principles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kd_principle',5);
            $table->string('nm_principle_in',40);
            $table->string('foto_principle_in',40);
            $table->string('nm_principle_eng',40);
            $table->string('foto_principle_eng',40);
            $table->string('create_user',20);
            $table->string('update_user',20);
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
        Schema::dropIfExists('principles');
    }
}
