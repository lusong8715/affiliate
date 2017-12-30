<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareasaleActivitysummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareasale_activitysummary', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->integer('sales');
            $table->float('gross_sales');
            $table->float('commissions');
            $table->float('max_sale');
            $table->float('min_sale');
            $table->float('avg_commission');
            $table->float('net_sales');
            $table->integer('voids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shareasale_activitysummary');
    }
}
