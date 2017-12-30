<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareasaleStaterevenueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareasale_staterevenue', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state');
            $table->float('sales');
            $table->float('commissions');
            $table->float('transactionfees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shareasale_staterevenue');
    }
}
