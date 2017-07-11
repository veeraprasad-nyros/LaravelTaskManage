@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading text text-center"><span class="text text-info font-size-20">Teams List</span></div>

                <div class="panel-body">
                    <div class="m-b-6">
                      <label class="text text-info">Add New Team 
                      <a href="#" id="newTeam" class="btn btn-link" data-toggle="modal" data-target="#newTeamModal" ><span id="clickme" class="colorAnimate">click<sup><i class="fa fa-star fa-lg" aria-hidden="true"></i></sup></span></a> </label>
                      <div class="alert alert-success" id="teamalert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Team added successfully.
                      </div>
                    </div>
                    @if(count($teamsdetails) == 0)
                    <table id="teamstable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Team Name</th>
                          <th>Created At</th>
                          <th>Updated At</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th></th>
                          <th>Team Name</th>
                          <th>Created At</th>
                          <th>Updated At</th>
                        </tr>
                    </tfoot>
                    </table>

                    @endif
                   
                    @if(count($teamsdetails) > 0)
                    <table id="teamstable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Team Name</th>
                          <th>Created At</th>
                          <th>Updated At</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($teamsdetails as $detail)
                        <tr>
                          <td></td>
                          <td>{{$detail->team_name}}</td>
                          <td>{{$detail->created_at}}</td>
                          <td>{{$detail->updated_at}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th></th>
                          <th>Team Name</th>
                          <th>Created At</th>
                          <th>Updated At</th>
                        </tr>
                    </tfoot>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="newTeamModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center text-info" id="myModalLabel">New Team</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal ajax" role="form" id="newTeamForm" method="POST" action="{{ url('/company/team/add')}}" autocomplete="off">
                        {{ csrf_field() }}

          <div class="form-group">
            <label for="name" class="col-md-4 control-label">Team Name</label>
            <div class="col-md-6">
              <input id="name" type="text" class="form-control" name="name" >
                <span id="errorname" class= "text text-danger"></span>
            </div>
          </div>
                      
          <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-users" aria-hidden="true"></i></i> Add
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('#teamalert').hide();
     $('form.ajax button[type=submit]').click(function(e) {
     
        e.preventDefault();
       
        $path = "{{url('company/team/exist')}}"+"/";
        $teamname = $('form.ajax #name').val();

        if($teamname.length == 0)
          $('#errorname').text("Team name field required");
        else
        {
          $('#errorname').empty();
          if(checkTeamExisted($teamname, $path))
            $('#errorname').text("Team name already existed");
          else{
            $('#errorname').empty();
            submitData();
          }
        }
    });
    function submitData(){
      //console.log('called');
      $path = "{{url('/company/team/add/')}}"+"/";
      $path += $('form.ajax #name').val();
      //console.log($path);
           
      $.ajax({  
          type: "GET" ,  
          url: $path ,
          async: false,  
          //data: {'email':value,'_token':$token},
          success: function(response){
            $row = response[0];
            //console.log($row['team_name'],$row['created_at'], $row['updated_at']);
            $('#newTeamModal form.ajax #name').val('');
            $('#newTeamModal').modal("hide");
            $table = $('#teamstable').DataTable();
            $count = $table.rows()[0].length;
            $table.row.add([ $count ,$row['team_name'],$row['created_at'], $row['updated_at']]).draw();
            $('#teamalert').show();
          }
      });
    }
    
  });

</script>
@endsection

