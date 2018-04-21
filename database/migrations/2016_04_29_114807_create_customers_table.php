<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password', 60);
            $table->string('phone');
            $table->string('address');
            $table->integer('amount');
            $table->string('avatar');
            $table->string('facebook_id');
            $table->string('google_id');
            $table->tinyInteger('gender')->default(1);
            $table->integer('age');
            $table->text('description');
            $table->integer('category_id')->index();
            $table->integer('provider_id')->index();
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customers');
    }
}
