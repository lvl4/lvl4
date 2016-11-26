<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CardsTableSeeder::class);
        $this->call(DecksTableSeeder::class);
        $this->call(WikisTableSeeder::class);
        $this->call(RolesTableSeeder::class);
    }
}
