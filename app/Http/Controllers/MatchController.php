<?php

namespace App\Http\Controllers;

use App\Match;
use Illuminate\Http\Request;

use App\Http\Requests;

class MatchController extends Controller
{
    public function updatePoints(Match $match){
        //get all played games and updates the points and predictions

            if($match->played){
                dd($match);
                $match->updateMatch();
            }
        else{
            //update values
            //revert points?

        }
    }
}
