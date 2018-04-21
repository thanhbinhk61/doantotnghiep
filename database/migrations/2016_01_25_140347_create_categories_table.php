<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('icon_fa')->default('fa-cog');
            $table->string('slug')->nullable();
            $table->string('title');
            $table->text('description');
            $table->string('keywords');
            $table->text('intro');
            $table->string('color');
            $table->integer('parent_id')->index();
            $table->integer('order');
            $table->string('image');
            $table->string('type')->default('product');
            $table->tinyInteger('feature')->default(1);
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
        Schema::drop('categories');
    }
}
