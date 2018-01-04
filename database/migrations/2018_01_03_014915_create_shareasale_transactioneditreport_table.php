<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareasaleTransactioneditreportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareasale_transactioneditreport', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trans_id');
            $table->dateTime('trans_date');
            $table->string('edit_trans_id');
            $table->dateTime('edit_date');
            $table->string('voided');
            $table->string('pending');
            $table->string('locked');
            $table->string('paid_currency');
            $table->string('user_id');
            $table->string('organization');
            $table->string('website');
            $table->float('trans_amount');
            $table->float('original_trans_amount');
            $table->float('new_trans_amount');
            $table->float('commission');
            $table->float('original_commission');
            $table->float('new_commission');
            $table->string('last_ip');
            $table->string('last_port');
            $table->string('last_referer');
            $table->string('u_banner_numb');
            $table->string('u_banner_page');
            $table->string('comment');
            $table->string('original_comment');
            $table->string('new_comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shareasale_transactioneditreport');
    }
}
