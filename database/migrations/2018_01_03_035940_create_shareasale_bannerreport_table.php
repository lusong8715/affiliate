<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareasaleBannerreportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareasale_bannerreport', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banner_id');
            $table->string('banner_type');
            $table->string('product_name');
            $table->integer('unique_hits');
            $table->float('commissions');
            $table->float('net_sales');
            $table->integer('number_of_voids');
            $table->integer('number_of_sales');
            $table->string('banner_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shareasale_bannerreport');
    }
}
