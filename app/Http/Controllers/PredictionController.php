<?php

namespace App\Http\Controllers;

use App\Match;
use App\Prediction;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

class PredictionController extends Controller
{
    public function index()
    {
        $matches = Match::all();

        foreach ($matches as $match) {
            //see if prediction exists
            $prediction = $match->predictions()->where('user_id', Auth::user()->id)->first();
            $match->assoc_prediction = $prediction;
        }
        return view('prediction.index', compact('matches'));
    }

    public function update(Request $request){
        //return of the form
//        dd($request->all());
        //
        $home_scores = $request->match_home;
        $away_scores = $request->match_away;
        foreach($home_scores as $match_id => $home_score){
            //test is have prediction

            if($home_score != ""){
                $prediction = Auth::user()->predictions()->where('match_id',$match_id)->first();
                $away_score = $away_scores[$match_id];
                if(is_null($prediction)){
                    $prediction = Prediction::create([
                        'user_id'=> Auth::user()->id,
                        'match_id'=> $match_id,
                        'home_score'=> intval($home_score),
                        'away_score'=> intval($away_score),
                    ]);
                }
                else{
                    //update in case
                    $prediction->home_score = intval($home_score);
                    $prediction->away_score = intval($away_score);
                    $prediction->save();
                }
            }

        }
        //away scores??

        return $this->index();
    }
}
