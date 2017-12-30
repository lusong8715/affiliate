<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareasaleWeeklyprogressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareasale_weeklyprogress', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('rep_date');
            $table->integer('clicks')->unsigned()->default(0);
            $table->float('gross_sales');
            $table->integer('voids')->unsigned()->default(0);
            $table->float('net_sales');
            $table->integer('number_of_sales')->unsigned()->default(0);
            $table->integer('manual_credits')->unsigned()->default(0);
            $table->float('commissions');
            $table->integer('affiliates')->unsigned()->default(0);
            $table->integer('active_affiliates')->unsigned()->default(0);
            $table->integer('numb_sales')->unsigned()->default(0);
            $table->integer('numb_leads')->unsigned()->default(0);
            $table->integer('numb_two_tier')->unsigned()->default(0);
            $table->integer('numb_bonuses')->unsigned()->default(0);
            $table->integer('numb_pay_per_call')->unsigned()->default(0);
            $table->integer('numb_leapfrog')->unsigned()->default(0);
            $table->float('sale_commissions');
            $table->float('lead_commissions');
            $table->float('two_tier_commissions');
            $table->float('bonus_commissions');
            $table->float('pay_per_call_commissions');
            $table->float('leapfrog_commissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shareasale_weeklyprogress');
    }
}
