<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'user_id','match_id','home_score', 'away_score', 'points',
    ];

    public function match(){
        return $this->belongsTo(Match::class);
    }
}
