<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareasaleConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareasale_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('api_url', 64);
            $table->integer('merchant_id')->unsigned()->nullable();
            $table->string('api_token', 64);
            $table->string('api_secret', 64);
            $table->string('api_version', 8);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shareasale_config');
    }
}
