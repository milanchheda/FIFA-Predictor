<?php

use App\Stadiums;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class StadiumSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stadiums')->delete();
        $json = File::get("database/data/stadium.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            Stadiums::create(array(
                'name' => $obj->name,
                'city' => $obj->city
            ));
        }
    }
}
