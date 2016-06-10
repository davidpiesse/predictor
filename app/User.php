<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['points'];

    public function predictions(){
        return $this->hasMany(Prediction::class);
    }

    public function getPointsAttribute(){
        return $this->points();
    }

    public function points(){
        $count = 0;
        foreach($this->predictions as $prediction)
            $count += $prediction->points;
        return $count;
    }

    public static function standings(){
//        dd($users);
        return User::orderBy('points','desc');
    }

}
