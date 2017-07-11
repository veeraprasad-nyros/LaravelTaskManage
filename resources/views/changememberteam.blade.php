@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><span class="text text-info">Change Team of Member </span></div>

                <div class="panel-body">
                 @include('layouts.member')
                <div class="col-md-10">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/company/member/team/update')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value ="{{$member->id}}" />
                        <div class="form-group">
                            <div class="container">
                                <label for="teamid" class="col-md-4 control-label">Current Team Name:</label>
                                <label class="col-md-8">
                                    {{$cuser_team_name->name}}
                                </label>
                            </div>
                            <div class="container">
                                <label class="col-md-4 control-label">
                                    Choose New Team Name:
                                </label>

                                <div class="col-md-4">
                                    @if(count($teams) == 0)
                                        <select id="teamid" name='teamid' disabled=true>
                                            
                                        </select>
                                    @endif
                                    @if(count($teams) > 0)
                                    <select id="teamid" name='teamid'>
                                        @foreach($teams as $team)
                                        @if($cuser_team_name->name == $team->team_name)
                                             <option value="{{$team->id}}" selected>{{$team->team_name}}</option>
                                        @endif
                                        @if($cuser_team_name->name != $team->team_name)
                                        <option value="{{$team->id}}">{{$team->team_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @endif

                                    @if($errors->has('teamid'))
                                        <span class="help-block">
                                            <strong>Choose the Team Name If no teams available first create team(s)</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4 ">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>
                 </div>
                </div>
           </div>
        </div>
    </div>
</div>
@endsection