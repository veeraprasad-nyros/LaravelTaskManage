@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                 <div class="panel-heading text text-center"><span class="text text-info">{{Auth::user()->lastname}} Tasks</span></div>
                
                <div class="panel-body">
                   @if(count($tasks) == 0)
                   <div> No tasks available</div>
                   @endif
                   @if(count($tasks) > 0)
                   <?php $i=1; ?>
                   @foreach($tasks as $task)
                    <div class="col-md-12  <?php if($i%2 == 0){echo 'well well-sm';} $i++; ?> ">
                       
                        <div class="col-md-10">
                            <label>Task:</label>
                            &nbsp;&nbsp;
                            <span>{{$task->task_name}}</span>
                        </div>
                        <div class="col-md-10">
                            <label>Team Name:</label>
                            &nbsp;&nbsp;
                            <span>{{$task->team_name}}</span>
                        </div>
                        <div class="col-md-10">
                            <label>Member Name:</label>
                            &nbsp;&nbsp;
                            <span>{{$task->member_name}}</span>
                        </div>
                        <div class="col-md-10">
                            <label>Task Description:</label>
                            &nbsp;&nbsp;
                            <span>{{$task->description}}</span>
                        </div>
                        <div class="col-md-10">
                            <label>Created At:</label>
                            &nbsp;&nbsp;
                            <span>{{$task->created_at}}</span>
                        </div>
                        <div class="col-md-10" id='statusdiv'>
                            <label>Status:</label>
                            &nbsp;&nbsp;
                            <span id='statusspan' class="text text-danger font-size-18">{{$task->tstatus}}</span>
                        </div>
                        <div class="col-md-12 m-t-f">
                            <a class="statuschange" href="{{url('members/task/status/'.$task->task_id)}}" title="change task status">
                            <i class="fa fa-pencil-square-o text text-success" aria-hidden="true"></i>
                            change status
                            </a>
                        </div>
                    </div>
                   @endforeach
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="statusModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text text-info text-center">Change status</h4>
        </div>
        <div class="modal-body">  
            <form id="formStatusAjax" class="form-horizontal ajax" role="form" method="POST" action="" autocomplete="off">
                        {{ csrf_field() }}

                <div class="form-group">
                  <label class="col-md-4 control-label">Current Status:</label>
                  <label class="col-md-5 text text-success" id = "cstatuslbl">Place here current task status</label>
                </div>
                <div class="form-group">
                  <label for="tstatus" class="col-md-4 control-label">Choose New Status:</label>
                  <div class="col-md-3" id="tstatusajax">
                    <select id="tstatus" name='tstatus'>
                        <option value="-1">select</option>
                        <option value="Open">Open</option>
                        <option value="InProgress">InProgress</option>
                        <option value="Hold">Hold</option>
                        <option value="Completed">Completed</option>
                        <option value="Closed">Closed</option>
                    </select> 
                    <span class="text text-danger" id="errorstatus"></span>                             
                  </div>
                </div>
                

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary" id="submit">
                            <i class="fa fa-btn fa-user"></i> Add
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
<style>
 .well {
    background-color: #bce8f1 !important;
 }
  #tstatus{
    width:180px;
    height:30px;
    background-color: #ffffff;
  }
</style>
<script>
$(document).ready(function(){
  //change status link events
  $('a.statuschange').click(function(event){
    event.preventDefault();
    $path = $(this).attr('href');
    //alert($path);
    $cstatus = $(this).parent().siblings('#statusdiv').children('#statusspan').text();
    $(this).parent().siblings('#statusdiv').children('#statusspan').addClass('dynamicstatus');
    //console.log($cstatus);
    $('#statusModal form').attr('action',$path);
    $('#statusModal form #cstatuslbl').text($cstatus);
    $('#statusModal #tstatus').val($cstatus);
    $('#statusModal').modal('show');
  });
  //change status model events
  $('#formStatusAjax button[type=submit]').click(function(event){
     event.preventDefault();
     $path = $('#formStatusAjax').attr('action');
    
     $status = 0;
      if($('#formStatusAjax #tstatus :selected').val() == -1)
      {
        $('#formStatusAjax #errorstatus').text('Select status !');
        $status = 1;
      }
      else
      {
        $('#formStatusAjax #errorstatus').text('');
        $status = 0;
        if( $('#formStatusAjax #tstatus :selected').val() == $('#formStatusAjax #cstatuslbl').text())
        {
          $('#formStatusAjax #errorstatus').text('Select new status!');
          $status = 1;
        }
        else
        {
          $('#formStatusAjax #errorstatus').text('');
          $status = 0;
        }
      }     
     
      if($status == 0)
        statusChangeTask($path);

  });

   function statusChangeTask($path)
   {
    $('#statusModal').modal('hide');
    $('.ajaxLoader').show();
       //console.log('called the statusChangeTask method');
    $.ajax({  
      type: "GET" ,  
      url: $path, 
      async: true, 
      data: {tstatus: $('#formStatusAjax #tstatus :selected').val()},
      success: function(response){
        $('.ajaxLoader').hide();
        $('span.dynamicstatus').text(response['tstatus']);
        $('span.dynamicstatus').removeClass('dynamicstatus');
      }
    });
   }

});
</script>
@endsection
