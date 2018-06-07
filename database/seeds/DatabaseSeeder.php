<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(StadiumSeederTable::class);
        $this->call(TeamSeederTable::class);
        $this->call(MatchSeederTable::class);
        $this->call(PredictionSeederTable::class);
    }
}
