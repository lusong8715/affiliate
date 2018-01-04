<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareasaleLedgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareasale_ledger', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ledger_id');
            $table->string('action');
            $table->dateTime('dt');
            $table->string('trans_type');
            $table->string('trans_id');
            $table->string('deposit');
            $table->float('commission');
            $table->float('shareasale_amount');
            $table->float('impact');
            $table->string('comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shareasale_ledger');
    }
}
