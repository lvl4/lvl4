<?php

use Illuminate\Database\Seeder;

class WikisTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20 ; $i++) { 
            DB::table('wikis_tags')->insert([
                'wiki_id' => rand(1,20),
                'tag_id' => rand(1,20),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
