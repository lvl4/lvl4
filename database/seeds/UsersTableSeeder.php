<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Timothy',
            'last_name' => 'de Jongh',
            'username' => 'icetimux',
            'email' => 'icetimux@gmail.com',
            'password' => bcrypt('eustacio'),
            'image' => 'https://api.adorable.io/avatars/285/icetimux@gmailcom.png',
            'role_id' => 1
        ]);
    }
}
