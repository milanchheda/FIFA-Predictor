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
            'name' => 'admin',
            'email' => 'admin@dummy.com',
            'password' => bcrypt('fifa@2018@123'),
        ]);
        DB::table('users')->insert([
            'name' => 'nigel',
            'email' => 'nigel@dummy.com',
            'password' => bcrypt('nigel'),
        ]);
        DB::table('users')->insert([
            'name' => 'ausaf',
            'email' => 'ausaf@dummy.com',
            'password' => bcrypt('ausaf'),
        ]);
    }
}
