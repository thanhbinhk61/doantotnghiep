<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->string('title');
            $table->string('keywords');
            $table->string('description');
            $table->string('slug');
            $table->string('image');
            $table->string('intro');
            $table->text('content');
            $table->string('tags');
            $table->integer('price');
            $table->tinyInteger('sale')->default('1');
            $table->string('video');
            $table->integer('price_sale');
            $table->integer('discount_price')->default(0);
            $table->tinyInteger('discount_type')->default(1);
            $table->integer('quantity');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('brand_id')->index();
            $table->integer('provider_id')->index();
            $table->tinyInteger('status')->default('1');
            $table->tinyInteger('section')->default('1');
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
        Schema::drop('products');
    }
}
