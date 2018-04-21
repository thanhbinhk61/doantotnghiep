<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Config::create([
            'title'=>'Umzila Thời trang Collection độc đáo nhất',
            'description'=>'Umzila',
            'keywords'=>'Umzila, umzila, Product',
            'facebook'=>'http://facebook.com',
            'youtube'=>'https://youtube.com/',
            'twitter'=>'https://twitter.com/',
            'email'=>'babymall.feedback@gmail.com',
            'phone'=>'0466.872.558',
            'content'=>'content',
            'address' => 'Carelife Việt Nam',
            'timework' => 'Mọi ngày 9h Am đến 8h Pm',
            'countdown'=>date('Y-m-d H:i:s'),
            ]);
    }
}
