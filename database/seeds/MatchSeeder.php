<?php

use Illuminate\Database\Seeder;
use App\Match;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class MatchSeeder extends Seeder
{
    public function run()
    {
        DB::table('matches')->delete();
        $json = File::get("database/data/matches.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            Match::create(array(
                'kick_off' => \Carbon\Carbon::create($obj->year, $obj->month,$obj->day,$obj->hour,0,0),
                'home_team' => $obj->home_team,
                'away_team' => $obj->away_team,
                'home_team_iso' => $obj->home_iso,
                'away_team_iso' => $obj->away_iso,
                'venue' => $obj->venue,
                'played' => false,
                'home_win' => false,
                'away_win' => false,
                'draw' => false,
                'home_score' => 0,
                'away_score' => 0,
                'goal_diff' => 0,
            ));
        }
    }
}

//$table->dateTime('kick_off');
//$table->string('home_team');
//$table->string('away_team');
//$table->string('home_team_iso');
//$table->string('away_team_iso');
//$table->string('venue');
//$table->boolean('played');
//$table->integer('home_score');
//$table->integer('away_score');
//$table->integer('goal_diff');
//$table->boolean('home_win');
//$table->boolean('away_win');
//$table->boolean('draw');