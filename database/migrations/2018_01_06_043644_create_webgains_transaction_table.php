<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebgainsTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webgains_transaction', function (Blueprint $table) {
            $table->string('id');
            $table->dateTime('date');
            $table->string('campaign_id');
            $table->string('event_id');
            $table->string('customer_id');
            $table->string('order_reference');
            $table->string('voucher_code');
            $table->float('value');
            $table->float('commission');
            $table->string('currency');
            $table->string('status');
            $table->string('comment');
            $table->string('type');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('webgains_transaction');
    }
}
