<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareasaleDeallistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareasale_deallist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('deal_id');
            $table->string('title');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('description');
            $table->dateTime('publish_date');
            $table->dateTime('modified_date');
            $table->string('landing_page');
            $table->string('restrictions');
            $table->string('keywords');
            $table->string('is_public', 1);
            $table->string('category');
            $table->string('coupon_code');
            $table->string('custom_commission');
            $table->string('thumbnail');
            $table->string('big_image');
            $table->string('store_id');
            $table->string('store');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shareasale_deallist');
    }
}
