<?php

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
        // $this->call(UsersTableSeeder::class);
        // $this->call(PortalsTableSeeder::class);
        $this->call(WikisTableSeeder::class);
        // $this->call(DecksTableSeeder::class);
        // $this->call(TagsTableSeeder::class);
        // $this->call(WikisTagsTableSeeder::class);
        // $this->call(CardsTableSeeder::class);
    }
}
