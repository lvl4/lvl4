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

        for ($i=0; $i < 20 ; $i++) { 
            DB::table('wikis')->insert([
                'title' => $faker->sentence(),
                'body' => $faker->sentence(),
                'user_id' => 1,
                'portal_id' => rand(1,20),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
