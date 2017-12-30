<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareasaleTransactiondetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareasale_transactiondetail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trans_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->dateTime('trans_date');
            $table->float('trans_amount');
            $table->float('commission');
            $table->float('ssamount');
            $table->string('comment');
            $table->integer('voided')->unsigned();
            $table->integer('locked')->unsigned();
            $table->integer('pending')->unsigned();
            $table->string('last_ip');
            $table->string('last_referer');
            $table->integer('banner_number')->unsigned();
            $table->text('banner_page');
            $table->dateTime('date_of_trans');
            $table->dateTime('date_of_click');
            $table->string('time_of_click');
            $table->dateTime('date_of_reversal');
            $table->integer('return_days')->unsigned();
            $table->integer('tool_id')->unsigned();
            $table->integer('store_id')->unsigned();
            $table->dateTime('lock_date');
            $table->string('transaction_type');
            $table->string('commission_type');
            $table->string('sku_list');
            $table->string('price_list');
            $table->string('quantity_list');
            $table->string('order_number');
            $table->string('parent_trans');
            $table->string('banner_name');
            $table->string('banner_type');
            $table->string('coupon_code');
            $table->string('reference_trans');
            $table->string('new_customer_flag', 1);
            $table->text('useragent');
            $table->string('original_currency');
            $table->float('original_currency_amount');
            $table->string('is_mobile', 1);
            $table->string('used_a_coupon', 1);
            $table->string('merchant_defined_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shareasale_transactiondetail');
    }
}
