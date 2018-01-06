<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateWebgainsConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webgains_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('api_url');
            $table->string('program_ids')->nullable();
            $table->string('api_key')->nullable();
        });
        DB::table('webgains_config')->insert([
            'api_url' => 'http://api.webgains.com/2.0/transaction/',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('webgains_config');
    }
}
