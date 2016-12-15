<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
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
            DB::table('tags')->insert([
                'name' => $faker->sentence(),
                'created_at' => date('Y-m-d H:i:s'),
                'user_id' => 1,
            ]);
        }
    }
}
