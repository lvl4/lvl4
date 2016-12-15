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

        for ($i=0; $i < 10 ; $i++) { 
            DB::table('decks')->insert([
                'portal_id' => rand(1,20),
                'name' => $faker->sentence(),
                'user_id' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
