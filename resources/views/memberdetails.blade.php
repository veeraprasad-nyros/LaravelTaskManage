@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text text-center"><span class="text text-info">Member Details</span></div>

                <div class="panel-body">
                  <div class="container">
                    <label class="col-md-2">First Name<span class="pull-right">:</span></label>
                    <div class="col-md-10">{{$member->firstname}}</div>
                  </div>
                  <div class="container">
                    <label class="col-md-2">Last Name<span class="pull-right">:</span></label>
                    <div class="col-md-10">{{$member->lastname}}</div>
                  </div>
                  <div class="container">
                    <label class="col-md-2">Team Name<span class="pull-right">:</span></label>
                    <div class="col-md-10">{{$member->team_name}}</div>
                  </div>
                  <div class="container">
                    <label class="col-md-2">Email<span class="pull-right">:</span></label>
                    <div class="col-md-10">{{$member->email}}</div>
                  </div>
                  <div class="container">
                    <label class="col-md-2">Address<span class="pull-right">:</span></label>
                    <div class="col-md-10">{{$member->address}}</div>
                  </div>
                  <div class="container">
                    <label class="col-md-2">Created At<span class="pull-right">:</span></label>
                    <div class="col-md-10">{{$member->created_at}}</div>
                  </div>
                  <div class="container">
                    <div class="col-md-12 m-t-f">
                      <a href="{{url('/company/member/view/')}}" title="view member details" class="clearfix">
                        <i class="fa fa-street-view" aria-hidden="true"></i>
                        View Members
                      </a>
                      <a href="{{url('company/member/edit/name/'.$member->member_id)}}" title="edit member details" class="clearfix">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Edit
                      </a> 
                     
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
