<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCjCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cj_commissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action_status');
            $table->string('action_type');
            $table->string('aid');
            $table->string('commission_id');
            $table->string('country');
            $table->dateTime('event_date');
            $table->dateTime('locking_date');
            $table->string('order_id');
            $table->string('original', 1);
            $table->string('original_action_id');
            $table->dateTime('posting_date');
            $table->string('website_id');
            $table->string('action_tracker_id');
            $table->string('action_tracker_name');
            $table->string('cid');
            $table->string('publisher_name');
            $table->float('commission_amount');
            $table->float('order_discount');
            $table->float('sale_amount');
            $table->string('is_cross_device', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cj_commissions');
    }
}
