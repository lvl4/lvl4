<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($x=1; $x <= 10 ; $x++) { 
           for ($i=0; $i < 20 ; $i++) { 
               DB::table('cards')->insert([
                   'deck_id' => $x,
                   'question' => $faker->sentence.'?',
                   'answer' => $faker->sentence,
               ]);
           }
        }
    }
}
