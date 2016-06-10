@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Your Predictions</div>
                        <div class="panel-body">
                            All of your predictions are below. You can only edit those matches that have not yet kicked
                            off.<br>
                            <form action="{{route('predictions.update')}}" method="post">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                @foreach($matches as $match)
                                    <div class="form-group">
                                        <label>
                                            <h4>
                                                <span class="flag-icon flag-icon-{{$match->home_team_iso}}"></span> {{$match->home_team}}
                                                v {{$match->away_team}} <span
                                                        class="flag-icon flag-icon-{{$match->away_team_iso}}"></span> -
                                                <small>{{$match->kick_off->format('j F H:i')}}</small>
                                            </h4>
                                        </label>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Home Score:
                                                <input type="number" name = "match_home[{{$match->id}}]" class="form-control input-sm"
                                                       id="match_{{$match->id}}_home" placeholder=""
                                                       @if($match->kick_off < \Carbon\Carbon::now() || $match->played)
                                                       disabled
                                                       @endif
                                                       @if(!is_null($match->assoc_prediction))
                                                       value="{{$match->assoc_prediction->home_score}}"
                                                        @endif
                                                >
                                            </div>
                                            <div class="col-md-2">
                                                Away Score:
                                                <input type="number" name = "match_away[{{$match->id}}]" class="form-control input-sm"
                                                       id="match_{{$match->id}}_away" placeholder=""
                                                       @if($match->kick_off < \Carbon\Carbon::now() || $match->played)
                                                       disabled
                                                        @endif
                                                       @if(!is_null($match->assoc_prediction))
                                                       value="{{$match->assoc_prediction->away_score}}"
                                                        @endif
                                                >
                                            </div>
                                            <p>
                                                @if($match->played && !is_null($match->assoc_prediction))
                                                    {{$match->assoc_prediction->points}} {{str_plural('point',$match->assoc_prediction->points)}}
                                                @endif
                                            </p>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
