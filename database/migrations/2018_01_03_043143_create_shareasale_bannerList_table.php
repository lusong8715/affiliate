<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareasaleBannerListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareasale_bannerList', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banner_id');
            $table->string('display_type');
            $table->string('image_url');
            $table->string('landing_url');
            $table->string('name');
            $table->string('banner_text');
            $table->string('category');
            $table->string('is_public', 1);
            $table->string('store_id');
            $table->dateTime('modified_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shareasale_bannerList');
    }
}
