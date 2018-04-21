<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('note');
            $table->tinyInteger('status')->default('1');
            $table->integer('total');
            $table->integer('ship');
            $table->string('code')->unique();
            $table->integer('card_id')->index();
            $table->integer('coupon_id')->index();
            $table->integer('customer_id')->index();
            $table->integer('expense_id')->index();
            $table->integer('address_id')->index();
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
        Schema::drop('orders');
    }
}
