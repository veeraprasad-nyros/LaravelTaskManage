@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-danger">
                <div class="panel-heading text text-center"><span class="text text-info font-size-20">Members List</span></div>

                <div class="panel-body">
                    @if(count($members) == 0)
                        <div class="text text-warning text-center">No members available</div>

                    @endif
                    <?php $i=1; ?>
                    @if(count($members) > 0)
                    <table id="memberstable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Team Name</th>
                          <th>Email</th>
                          <th>Address</th>
                          <th>Created At</th>
                          <th>Action(s)</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($members as $member)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{$member->firstname}}</td>
                          <td>{{$member->lastname}}</td>
                          <td>{{$member->team_name}}</td>
                          <td>{{$member->email}}</td>
                          <td>{{$member->address}}</td>
                          <td>{{$member->created_at}}</td>
                          <td>
                            <a href="{{url('/company/member/view/'.$member->member_id)}}" title="view member details">
                              <i class="fa fa-street-view" aria-hidden="true"></i>
                            </a>&nbsp;
                            <a href="{{url('company/member/edit/name/'.$member->member_id)}}" title="edit member details">
                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a> 
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
