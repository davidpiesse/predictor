@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Welcome</div>
                        <div class="panel-body">
                            <b>Euro 2016 Predictor!</b><br>
                            <p>Info on how you are doing, league tables etc. will be added below <br>
                                To add/change predictions use the link above.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-fw fa-table"></i> Current Table</div>
                        <div class="panel-body">
                            <table class="table table-striped text-center">
                                <thead>
                                <tr>
                                    <th class="text-center">Position</th>
                                    <th class="text-center">Player</th>
                                    <th class="text-center">Points</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach(\App\User::orderBy('points','desc')->get() as $idx => $user)
                                    <tr>
                                        <td>{{$idx+1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->points}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-fw fa-list"></i> Latest Results</div>
                        <div class="panel-body">
                            <table class="table table-striped text-center">
                                <thead>
                                <tr>
                                    <th class="text-center">Match</th>
                                    <th class="text-center">Result</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($recent as $match)
                                    <tr>
                                        <td>
                                            <span class="flag-icon flag-icon-{{$match->home_team_iso}}"></span> {{$match->home_team}}
                                            v {{$match->away_team}} <span
                                                    class="flag-icon flag-icon-{{$match->away_team_iso}}"></span></td>
                                        <td>
                                            {{$match->home_score}} - {{$match->away_score}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No recent matches</td>
                                        <td><i class="fa fa-fw fa-clock-o"></i></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-fw fa-soccer-ball-o"></i> Upcoming Matches</div>
                        <div class="panel-body">
                            <table class="table table-striped text-center">
                                <thead>
                                <tr>
                                    <th class="text-center">Match</th>
                                    <th class="text-center">Venue (BST)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($upcoming as $match)
                                    <tr>
                                        <td>
                                            <span class="flag-icon flag-icon-{{$match->home_team_iso}}"></span> {{$match->home_team}}
                                            v {{$match->away_team}} <span
                                                    class="flag-icon flag-icon-{{$match->away_team_iso}}"></span></td>
                                        <td>
                                            <small>{{$match->venue}}</small>
                                            <br> {{$match->kick_off->format('j F H:i')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
