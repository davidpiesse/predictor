<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Match extends Model
{
    protected $dates = ['created_at', 'updated_at', 'kick_off'];

    protected $casts = [
        'played' => 'boolean',
        'home_win' => 'boolean',
        'away_win' => 'boolean',
        'draw' => 'boolean'
    ];

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    public static function upcoming($n = 8){
        return Match::where('kick_off','>',Carbon::now())->orderBy('kick_off')->get()->take($n);
    }

    public static function recent($n = 8){
        return Match::where('kick_off','<',Carbon::now())->orderBy('kick_off','desc')->get()->take($n);
    }

    public function updateMatch(){
        $this->record_result($this->home_score,$this->away_score);
    }

    public function record_result($home_score, $away_score)
    {
        //record a result against a match
        $this->home_score = $home_score;
        $this->away_score = $away_score;
        //result
        if ($this->home_score == $this->away_score)
            $this->draw = true;
        if ($this->home_score > $this->away_score)
            $this->home_win = true;
        if ($this->home_score < $this->away_score)
            $this->away_win = true;
        //goal diff
        $this->goal_diff = $this->home_score - $this->away_score;
        //positive -home win
        //negative away win
        //0 draw
        $this->played = true;
        $this->save();

        //update all predictions linked to this match
        foreach ($this->predictions as $prediction) {
            $prediction->points = 0;
            $p_home = $prediction->home_score > $prediction->away_score;
            $p_away = $prediction->home_score < $prediction->away_score;
            $p_draw = $prediction->home_score == $prediction->away_score;
            $p_diff = $prediction->home_score - $prediction->away_score;
            $p_exact = ($prediction->home_score == $this->home_score && $prediction->away_score == $this->away_score);

            //exact
            if ($p_exact) {
                $prediction->points = 6;
                $prediction->save();
                return;
            }
            //home win check
            if ($this->home_win && $p_home) {
                $prediction->points = 2;
                //check gd
                if ($this->goal_diff == $p_diff)
                    $prediction->points += 1;
                $prediction->save();
                return;
            }
            //away win check
            if ($this->away_win && $p_away) {
                $prediction->points = 2;
                //check gd
                if ($this->goal_diff == $p_diff)
                    $prediction->points += 1;
                $prediction->save();
                return;
            }
            //draw
            if ($this->draw && $p_draw) {
                $prediction->points = 4;
                $prediction->save();
                return;
            }
            if($this->home_win && $p_away){
                $prediction->points = -2;
                $prediction->save();
                return;
            }
            if($this->away_win && $p_home){
                $prediction->points = -2;
                $prediction->save();
                return;
            }
        }
    }
}
