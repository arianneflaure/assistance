<?php

use Illuminate\Database\Seeder;
use App\Role; 
use App\User;

class RoleTableSeeder extends Seeder {

    
	public function run()
	{
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