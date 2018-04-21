<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Property::create([
            'name'=>'Màu đỏ',
            'type'=>'color',
            'value'=>'red',
            ]);
        Property::create([
            'name'=>'Màu xanh',
            'type'=>'color',
            'value'=>'green',
            ]);
        Property::create([
            'name'=>'Màu vàng',
            'type'=>'color',
            'value'=>'orange',
            ]);
    }
}
