<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Product;
use App\Eloquent\Category;
use App\Eloquent\Property;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = app(Category::class)->where('type','product');
        $propertiesColor = app(Property::class)->where('type','color');
        factory(Product::class, 30)->create()->each(function ($product) use ($categories, $propertiesColor) {
            $product->categories()->attach([1,2,3]);
            $product->colors()->attach($propertiesColor->lists('id')->random(2)->all());
        });
    }
}
