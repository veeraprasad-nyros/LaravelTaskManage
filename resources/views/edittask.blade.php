@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center">Edit Task </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{url('/company/task/update')}}">
                        {{ csrf_field() }}
                        <input type='hidden' name='id' value = "{{$task->task_id}}" />
                        <div class="col-md-10 col-md-offset-1">
                        	<label class="col-md-4 bg-success">Current Task Title:</label>
                        	<lable class="col-md-7 bg-warning">{{$task->task_name}}</lable>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Enter New Title:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>Title is required</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-10 col-md-offset-1">
                        	<label class="col-md-4 bg-success">Current Task Description:</label>
                        	<lable class="col-md-7 bg-warning">{{$task->description}}</lable>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Enter New Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}">

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-tasks"></i> Update
                                </button>
                                <a class="btn btn-primary" href="{{url('/company/task/view')}}" >Back Tasks</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection