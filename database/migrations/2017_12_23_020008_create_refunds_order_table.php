<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundsOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id');
            $table->string('status');
            $table->string('currency');
            $table->float('amount');
            $table->string('processed', 1)->default('0');
            $table->unique('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('refunds_order');
    }
}
