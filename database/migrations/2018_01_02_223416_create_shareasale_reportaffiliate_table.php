<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareasaleReportaffiliateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareasale_reportaffiliate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('organization');
            $table->dateTime('apply_date');
            $table->string('status');
            $table->string('website');
            $table->float('commissions_today');
            $table->float('commissions_month');
            $table->float('commissions_last_month');
            $table->float('commissions_total');
            $table->float('sales_today');
            $table->float('sales_month');
            $table->float('sales_last_month');
            $table->float('sales_total');
            $table->integer('hits_today');
            $table->integer('hits_month');
            $table->integer('hits_last_month');
            $table->integer('hits_total');
            $table->string('group');
            $table->string('referred');
            $table->float('hit_commission');
            $table->float('lead_commission');
            $table->float('sale_commission');
            $table->string('sign_up_campaign');
            $table->string('country');
            $table->string('state');
            $table->string('tags');
            $table->integer('number_of_sales_today');
            $table->integer('commissions_sales_today');
            $table->integer('number_of_leads_today');
            $table->integer('commissions_leads_today');
            $table->integer('number_of_two_tier_today');
            $table->integer('commissions_two_tier_today');
            $table->integer('number_of_bonuses_today');
            $table->integer('commissions_bonus_today');
            $table->integer('number_of_pp_calls_today');
            $table->integer('commissions_pp_call_today');
            $table->integer('number_of_leapfrogs_today');
            $table->integer('commissions_leapfrog_today');
            $table->integer('number_of_sales_month');
            $table->integer('commissions_sales_month');
            $table->integer('number_of_leads_month');
            $table->integer('commissions_leads_month');
            $table->integer('number_of_two_tier_month');
            $table->integer('commissions_two_tier_month');
            $table->integer('number_of_bonuses_month');
            $table->integer('commissions_bonus_month');
            $table->integer('number_of_pp_call_smonth');
            $table->integer('commissions_pp_call_month');
            $table->integer('number_of_leapfrogs_month');
            $table->integer('commissions_leapfrog_month');
            $table->integer('number_of_sales_last_month');
            $table->integer('commissions_sales_last_month');
            $table->integer('number_of_leads_last_month');
            $table->integer('commissions_leads_last_month');
            $table->integer('number_of_two_tier_last_month');
            $table->integer('commissions_two_tier_last_month');
            $table->integer('number_of_bonuses_last_month');
            $table->integer('commissions_bonus_last_month');
            $table->integer('number_of_pp_calls_last_month');
            $table->integer('commissions_pp_call_last_month');
            $table->integer('number_of_leapfrogs_last_month');
            $table->integer('commissions_leapfrog_last_month');
            $table->string('notes');
            $table->integer('feedback_count');
            $table->float('feedback_ave');
            $table->integer('feedback_rating');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shareasale_reportaffiliate');
    }
}
