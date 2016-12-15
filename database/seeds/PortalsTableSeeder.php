<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class PortalsTableSeeder extends Seeder
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
            DB::table('portals')->insert([
                'name' => $faker->sentence(),
                'description' => $faker->sentence(),
                'user_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
