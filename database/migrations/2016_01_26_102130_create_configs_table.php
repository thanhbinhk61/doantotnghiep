<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('keywords');
            $table->string('facebook');
            $table->string('youtube');
            $table->string('twitter');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('timework');
            $table->text('content');
            $table->string('intro');
            $table->string('logo');
            $table->string('banner_login');
            $table->string('icon');
            $table->dateTime('countdown');
            $table->string('note');
            $table->text('scripts');
            $table->text('card_atm');
            $table->text('label');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('configs');
    }
}
