<?php

use App\Matches;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MatchSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matches')->delete();
        $json = File::get("database/data/matches.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            Matches::create(array(
                'type' => $obj->type,
                'home_team' => $obj->home_team,
                'away_team' => $obj->away_team,
                'home_result' => $obj->home_result,
                'away_result' => $obj->away_result,
                'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse($obj->date), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s'),
                'stadium_id' => $obj->stadium,
            ));
        }
    }
}
