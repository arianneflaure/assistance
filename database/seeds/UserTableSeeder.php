<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role; 
use App\User;

class UserTableSeeder extends Seeder {

    public function run()
	{
		User::create([
			'name' => 'GreatAdmin',
			'email' => 'chris@gmail.com',
			'phone'=> '123456789',
			'password' => bcrypt('admin'),
			'role' => 'admin',
			
		]);

		User::create([
			'name' => 'GreatRedactor',
			'email' => 'redac@la.fr',
			'phone'=> '123456789',
			'password' => bcrypt('redac'),
			'role' => 'user',
		]);

		DB::table('users')->delete();

		for($i = 0; $i < 10; ++$i)
		{
			DB::table('users')->insert([
				'name' => 'Nom' . $i,
                'email' => 'email' . $i . '@gaiml.fr',
                'phone' => rand(1,9),
				'password' => bcrypt('password' . $i),
				'role' => 'user'
			]);
		}

		Role::create([
			'title' => 'Administrateur général',
			'slug' => 'super_admin'
		]);

		Role::create([
			'title' => 'Administrateur',
			'slug' => 'admin'
		]);

		Role::create([
			'title' => 'User',
			'slug' => 'user'
		]);
	}
}