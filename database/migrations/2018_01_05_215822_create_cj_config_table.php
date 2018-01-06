<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCjConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cj_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('api_url', 64);
            $table->text('api_key')->nullable();
        });
        DB::table('cj_config')->insert([
            'api_url' => 'https://commission-detail.api.cj.com/v3/commissions',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cj_config');
    }
}
