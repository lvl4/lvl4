<?php

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

        for ($i=0; $i < 100 ; $i++) { 
            DB::table('cards')->insert([
                'deck_id' => rand(1,10),
                'question' => $faker->sentence(),
                'answer' => $faker->sentence(),
                'user_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
