<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('store_show');
            $table->string('email');
            $table->string('company_name');
            $table->integer('company_type');
            $table->string('city');
            $table->string('district');
            $table->string('address');
            $table->string('contact');
            $table->string('number_register');
            $table->string('brand');
            $table->integer('category_id');
            $table->text('note');
            $table->tinyInteger('status')->default(1);
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
        Schema::drop('registers');
    }
}
