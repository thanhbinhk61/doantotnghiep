<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Eloquent\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'parent_id' => 0,
        'type' => 'product',
        'order' => '1'
    ];
});

$factory->define(App\Eloquent\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(mt_rand(2, 5)),
        'code' => $faker->ean8,
        'intro' => $faker->paragraph(2),
        'tags' => $faker->word(5),
        'content' => $faker->paragraph(6),
        'price' => $faker->randomNumber(6),
        'price_sale' => $faker->randomNumber(6),
        'sale' => rand(1,2),
        'quantity' => rand(4,20),
        'user_id' => '2',
        'image' => $faker->randomElement([
            'assets/frontend/data/option7/p6.jpg','assets/frontend/data/option7/p7.jpg','assets/frontend/data/option7/p10.jpg','assets/frontend/data/option7/p9.jpg'
        ]),
        'status' => '1',
        'section' => rand(1,2),
    ];
});
