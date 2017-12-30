<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareasaleAffiliatetimespanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareasale_affiliatetimespan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('affiliate');
            $table->integer('clicks');
            $table->float('gross_sales');
            $table->integer('voids');
            $table->float('net_sales');
            $table->integer('number_of_sales');
            $table->integer('manual_credits');
            $table->float('commissions');
            $table->float('conversion');
            $table->float('epc');
            $table->float('average_order');
            $table->integer('affiliate_id');
            $table->string('organization');
            $table->string('website');
            $table->integer('numb_sales');
            $table->integer('numb_leads');
            $table->integer('numb_two_tier');
            $table->integer('numb_bonuses');
            $table->integer('numb_pay_per_call');
            $table->integer('numb_leapfrog');
            $table->float('sale_commissions');
            $table->float('lead_commissions');
            $table->float('two_tier_commissions');
            $table->float('bonus_commissions');
            $table->float('pay_per_call_commissions');
            $table->float('leapfrog_commissions');
            $table->float('transaction_fees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shareasale_affiliatetimespan');
    }
}
