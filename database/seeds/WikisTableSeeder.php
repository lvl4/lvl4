<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class WikisTableSeeder extends Seeder
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
            DB::table('wikis')->insert([
                'title' => $faker->sentence,
                'body' => $faker->sentence,
                'created_at' => $faker->datetime,
            ]);
        }
    }
}
