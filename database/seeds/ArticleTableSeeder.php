<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class ArticleTableSeeder extends Seeder {

    private function randDate()
	{
		return Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
	}

	public function run()
	{
		DB::table('articles')->delete();

		for($i = 0; $i < 5; ++$i)
		{	
			$date = $this->randDate();
			DB::table('articles')->insert([
				'titre' => 'Titre' . $i,
				'slug' => 'demande' . $i,
				'contenu' => 'Contenu' . $i . ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
				'user_id' => rand(1, 5),
				'type'=>'Bug du système',
				'priorite'=>'Très urgent',
				'statut'=>'Non Résolu',
				'created_at' => $date,
				'updated_at' => $date
			]);
		}

		for($i = 5; $i < 10; ++$i)
		{	
			$date = $this->randDate();
			DB::table('articles')->insert([
				'titre' => 'Titre' . $i,
				'slug' => 'demande' . $i,
				'contenu' => 'Contenu' . $i . ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
				'user_id' => rand(6, 9),
				'type'=>'Requête',
				'priorite'=>'Urgent',
				'statut'=>'Non Résolu',
				'created_at' => $date,
				'updated_at' => $date
			]);
		}
	}
}