<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareasaleTransactionvoidreportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareasale_transactionvoidreport', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trans_id');
            $table->dateTime('trans_date');
            $table->string('void_trans_id');
            $table->dateTime('void_date');
            $table->string('voided');
            $table->string('pending');
            $table->string('locked');
            $table->string('paid_currency');
            $table->string('user_id');
            $table->string('organization');
            $table->string('website');
            $table->float('trans_amount');
            $table->float('commission');
            $table->string('last_ip');
            $table->string('last_port');
            $table->string('last_referer');
            $table->string('u_banner_numb');
            $table->string('u_banner_page');
            $table->string('comment');
            $table->string('void_reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shareasale_transactionvoidreport');
    }
}
