<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Match;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $matches = Match::where('kick_off','<',Carbon::now())->take(8);
//        dd($matches);
//        return view('home',compact('matches'));
    }

    public function welcome(){
        $upcoming = Match::upcoming();
        $recent = Match::recent();
//        dd($matches);
        return view('welcome',compact('upcoming','recent'));
    }
}
