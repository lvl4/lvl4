<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class DecksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        for ($i=1; $i <= 10 ; $i++) { 
            DB::table('decks')->insert([
                'name' => $faker->sentence,
                'wiki_id' => $i,
                'user_id' => $i,
            ]);
        }
    }
}
