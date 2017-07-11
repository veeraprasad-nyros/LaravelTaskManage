@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><span class="text text-info">Edit Email Id</span></div>

                <div class="panel-body">
                 @include('layouts.member')
                <div class="col-md-10">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/company/member/reset/update')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value ="{{$member->id}}" />
                         <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password:</label>
                           
                            <div class="col-md-4">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
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