<?php

use App\Eloquent\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
		$user->name = 'Hệ thống';
		$user->username = 'nobody';
		$user->email = 'nobody@system.com';
		$user->password = bcrypt('nobody@1308+');
		$user->save();

		$user = new User();
		$user->name = 'Quản trị';
		$user->username = 'admin';
		$user->email = 'admin@system.com';
		$user->password = bcrypt('admin@123+');
		$user->save();
    }
}
