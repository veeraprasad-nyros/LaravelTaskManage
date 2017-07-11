@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-danger">
                 <div class="panel-heading text text-center"><span class="text text-info font-size-20">Tasks</span></div>

                <div class="panel-body">
                   @if(count($tasks) == 0)
                   <div> No tasks available</div>
                   @endif
                   @if(count($tasks) > 0 )
                   <?php $i=1; ?>
                   @foreach($tasks as $task)
                   @if($task->estatus == 1)
                    <div class="col-md-12  <?php if($i%2 == 0){echo 'well well-sm';} $i++; ?> taskblock" id="{{$task->task_id}}">
                       
                        <div class="row">
                          <div class="col-md-3">
                            <label>Task</label><span class="pull-right">:</span>
                          </div>
                          <div class="col-md-9" title="Edit task Name">
                            <span id="name-{{$task->task_id}}" >{{$task->task_name}}</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>Team Name</label><span class="pull-right">:</span>
                          </div>
                          <div class="col-md-9">
                            <span >{{$task->team_name}}</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3" >
                            <label>Member Name</label><span class="pull-right">:</span>
                          </div>
                          <div class="col-md-9" title="Change Member">
                            <span id="member-{{$task->task_id}}-{{$task->cuser_id}}-{{$task->team_id}}-{{$task->muser_id}}">{{$task->member_name}}</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3" >
                            <label>Task Description</label><span class="pull-right">:</span>
                          </div>
                          <div class="col-md-9" title="Edit task description" >
                            <span id="description-{{$task->task_id}}">{{$task->description}}</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>Created At</label><span class="pull-right">:</span>
                          </div>
                          <div class="col-md-9">
                            <span>{{$task->created_at}}</span>
                          </div>
                        </div>
                        <div class="row" id='statusdiv'>
                          <div class="col-md-3">
                            <label>Status</label><span class="pull-right">:</span>
                          </div>
                          <div class="col-md-9" title="Change Status of Task">
                            <span id='statusspan-{{$task->task_id}}' class="text text-danger font-size-18">{{$task->tstatus}}</span>
                          </div>
                        </div>
                        <div class="row" id='attach-{{$task->task_id}}'>
                          <div class="col-md-3">
                            <label>Attachment</label><span class="pull-right">:</span>
                          </div>
                          <div class="col-md-9" >
                            @if(count($task->attach) != 0)
                            <span id='attachspan' class="text text-warning font-size-18">{{$task->attach}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a id="download" class="click" href="{{url('company/task/attach/download/'.$task->task_id)}}" title="download"><i class="fa fa-download" aria-hidden="true"></i></a> 
                            <a id="viewing" class="click" href="{{url('company/task/attach/view/'.$task->task_id)}}" title="view the attachment"><i class="fa fa-street-view" aria-hidden="true"></i></a>  
                            <a id="remove" class="click remove" href="{{url('company/task/attach/remove/'.$task->task_id)}}" title="remove the attachment"><i class="fa fa-times" aria-hidden="true"></i></a> 
                            <a class="changeAttach" href="{{url('company/task/attach/change/'.$task->task_id)}}" title="Change the attachment"><i class="fa fa-paperclip" aria-hidden="true"></i></a>
                            @endif
                            @if(count($task->attach) == 0)
                            <span id='attachspan' class="text text-warning font-size-18">No attachment</span>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a id="download" class="hide" href="{{url('company/task/attach/download/'.$task->task_id)}}" title="download"><i class="fa fa-download" aria-hidden="true"></i></a>  
                            <a id="viewing" class="hide" href="{{url('company/task/attach/view/'.$task->task_id)}}" title="view the attachment"><i class="fa fa-street-view" aria-hidden="true"></i></a>  
                            <a id="remove" class="hide remove" href="{{url('company/task/attach/remove/'.$task->task_id)}}" title="remove the attachment"><i class="fa fa-times" aria-hidden="true"></i></a> 
                            <a class="changeAttach" href="{{url('company/task/attach/change/'.$task->task_id)}}" title="Change the attachment"><i class="fa fa-paperclip" aria-hidden="true"></i></a>
                            @endif
                            <div id="changeAttachdiv" class="clearfix" ></div>
                          </div>
                        </div>
                        <div class="col-md-12 m-t-f">
                          <a href="{{url('company/task/delete/'.$task->task_id)}}" title="delete task" >
                            <i class="fa fa-times text text-danger" aria-hidden="true"></i>
                            Delete
                          </a>&nbsp;&nbsp;
                          <a class="edittask" href="{{url('company/task/edit/'.$task->task_id)}}" title="edit task details">
                            <i class="fa fa-pencil-square-o text text-success" aria-hidden="true"></i>
                            Edit
                          </a> &nbsp;&nbsp;
                          <a class="statuschange" href="{{url('company/task/status/'.$task->task_id)}}" title="change task status">
                            <i class="fa fa-pencil-square-o text text-success" aria-hidden="true"></i>
                            change status
                          </a>
                        </div>
                    </div>
                    @endif
                   @endforeach
                   <div class="col-md-12 bg-danger text-center">
                     <label class="text text-primary font-size-18">Experied Tasks</label>
                   </div>
                   <?php $i=1; ?>
                   @foreach($tasks as $task)
                   @if($task->estatus == 0)
                    <div class="col-md-12  <?php if($i%2 == 0){echo 'well well-sm';} $i++; ?> taskblock" id="{{$task->task_id}}">
                       
                        <div class="row">
                          <div class="col-md-3">
                            <label>Task</label><span class="pull-right">:</span>
                          </div>
                          <div class="col-md-9" title="Edit task Name">
                            <span id="name-{{$task->task_id}}" >{{$task->task_name}}</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>Team Name</label><span class="pull-right">:</span>
                          </div>
                          <div class="col-md-9">
                            <span >{{$task->team_name}}</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3" >
                            <label>Member Name</label><span class="pull-right">:</span>
                          </div>
                          <div class="col-md-9" title="Change Member">
                            <span id="member-{{$task->task_id}}-{{$task->cuser_id}}-{{$task->team_id}}-{{$task->muser_id}}">{{$task->member_name}}</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3" >
                            <label>Task Description</label><span class="pull-right">:</span>
                          </div>
                          <div class="col-md-9" title="Edit task description" >
                            <span id="description-{{$task->task_id}}">{{$task->description}}</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label>Created At</label><span class="pull-right">:</span>
                          </div>
                          <div class="col-md-9">
                            <span>{{$task->created_at}}</span>
                          </div>
                        </div>
                        <div class="row" id='statusdiv'>
                          <div class="col-md-3">
                            <label>Status</label><span class="pull-right">:</span>
                          </div>
                          <div class="col-md-9" title="Change Status of Task">
                            <span id='statusspan-{{$task->task_id}}' class="text text-danger font-size-18">{{$task->tstatus}}</span>
                          </div>
                        </div>
                        <div class="row" id='attach-{{$task->task_id}}'>
                          <div class="col-md-3">
                            <label>Attachment</label><span class="pull-right">:</span>
                          </div>
                          <div class="col-md-9" >
                            @if(count($task->attach) != 0)
                            <span id='attachspan' class="text text-warning font-size-18">{{$task->attach}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a id="download" class="click" href="{{url('company/task/attach/download/'.$task->task_id)}}" title="download"><i class="fa fa-download" aria-hidden="true"></i></a> 
                            <a id="viewing" class="click" href="{{url('company/task/attach/view/'.$task->task_id)}}" title="view the attachment"><i class="fa fa-street-view" aria-hidden="true"></i></a>  
                            <a id="remove" class="click remove" href="{{url('company/task/attach/remove/'.$task->task_id)}}" title="remove the attachment"><i class="fa fa-times" aria-hidden="true"></i></a> 
                            <a class="changeAttach" href="{{url('company/task/attach/change/'.$task->task_id)}}" title="Change the attachment"><i class="fa fa-paperclip" aria-hidden="true"></i></a>
                            @endif
                            @if(count($task->attach) == 0)
                            <span id='attachspan' class="text text-warning font-size-18">No attachment</span>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a id="download" class="hide" href="{{url('company/task/attach/download/'.$task->task_id)}}" title="download"><i class="fa fa-download" aria-hidden="true"></i></a>  
                            <a id="viewing" class="hide" href="{{url('company/task/attach/view/'.$task->task_id)}}" title="view the attachment"><i class="fa fa-street-view" aria-hidden="true"></i></a>  
                            <a id="remove" class="hide remove" href="{{url('company/task/attach/remove/'.$task->task_id)}}" title="remove the attachment"><i class="fa fa-times" aria-hidden="true"></i></a> 
                            <a class="changeAttach" href="{{url('company/task/attach/change/'.$task->task_id)}}" title="Change the attachment"><i class="fa fa-paperclip" aria-hidden="true"></i></a>
                            @endif
                            <div id="changeAttachdiv" class="clearfix" ></div>
                          </div>
                        </div>
                        <div class="col-md-12 m-t-f">
                          <a href="{{url('company/task/delete/'.$task->task_id)}}" title="delete task" >
                            <i class="fa fa-times text text-danger" aria-hidden="true"></i>
                            Delete
                          </a>&nbsp;&nbsp;
                          <a class="edittask" href="{{url('company/task/edit/'.$task->task_id)}}" title="edit task details">
                            <i class="fa fa-pencil-square-o text text-success" aria-hidden="true"></i>
                            Edit
                          </a> &nbsp;&nbsp;
                          <a class="statuschange" href="{{url('company/task/status/'.$task->task_id)}}" title="change task status">
                            <i class="fa fa-pencil-square-o text text-success" aria-hidden="true"></i>
                            change status
                          </a>
                        </div>
                    </div>
                    @endif
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
 .borderEdit {
    border:1px solid #555;
    background-color: #D2F3F3; 
    color:#1826B5;
    padding-top:2px;
    padding-bottom:2px;
    padding-left:2px;
    padding-right: 4px;
 }
 .upload 
 {
    background-color: rgba(0,0,0,0.3);
    padding-top:5px;
    padding-bottom: 5px;
 }
  
  #changeAttachdiv input[type='button'], #changeAttachdiv input[type='submit']
  {
    width:100%;
    margin-left: 0px;
    font-size: 18px;
  }
  #changeAttachdiv input[type='file']
  {
    width:100%;
    margin-right: 5px;
    font-size: 18px;
    padding-top: 5px;
    padding-bottom: 6px;
    border-radius: 5px;
  }
  #changeAttachdiv div {
    padding:0px;
  }
</style>

<script>

$(document).ready(function(){
  //showing attachment form dynamic
  $("a.changeAttach").click(function(event){
    event.preventDefault();
    $path = $(this).attr('href');
    $parent = $(this).parent();
    $visibleForms = $('.visibleone');
    console.log($visibleForms.length);
    if($visibleForms.length == 0)
    {
      $($parent).children('#changeAttachdiv').addClass('upload').addClass('visibleone');
      $formContainer = $($parent).children('#changeAttachdiv');
      $form = 
             "<form enctype='multipart/form-data' method='post' action='"+$path+"'' id='upload_form'><input type='hidden' name='_token' value='{{csrf_token()}}' >"
             +"<div class='col-md-6'><input type='file' name='attach' id='attach' class='btn-warning'> </div>"
             +"<div class='col-md-3'><input  type='submit' value='upload' class='btn btn-sm btn-primary' ></div>"
             +"<div class='col-md-3'><input type='button' value='cancle' class='btn btn-sm btn-danger' ></div>"
             +"</form>";
            
      $($formContainer).empty();
      $($formContainer).append($form);
    }
    else
    {
      $('#changeAttachdiv').removeClass('upload').removeClass('visibleone').empty()
    }
  });
  //removing or hidding the attachment form 
  $("body").on("click", "input[value='cancle']", function(){
    $(this).parent().parent().parent().removeClass('upload').removeClass('visibleone').empty();
  });
  //removing the attachment 
  $("a.click.remove").click(function(event){
    event.preventDefault();
    $path = $(this).attr('href');
    $parent = $(this).parent();
    $attachspan = $($parent).children('#attachspan').text();
    console.log($attachspan, $path);
    $.ajax({  
        type: "GET" ,  
        url: $path, 
        async: false, 
        //data: {cuser_id: $cuserid, team_id:$teamid},
        success: function(response){
           console.log(response);
           $($parent).children('#attachspan').text('No attachment');
           $($parent).children('a.click').addClass('hide').removeClass('click');
        }
    });

  });
  //changing attachment
  $('body').on('submit', 'form#upload_form', function(event){
    event.preventDefault();
    $path   = $('form#upload_form').attr('action');
     
     $.ajax({  
        type: "post",  
        url: $path, 
        async: false, 
        data: new FormData($("form#upload_form")[0]),
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
         //console.log(response['filename']);
         $parent = $('form#upload_form').parent().parent();
         $($parent).children('#attachspan').text(response['filename']);
         $($parent).children('#download').removeClass('hide').addClass('click');
         $($parent).children('#viewing').removeClass('hide').addClass('click');
         $($parent).children('#remove').removeClass('hide').addClass('click');
         $('form#upload_form').parent().removeClass('upload').removeClass('visibleone').empty();
         //alert(response);
        }
      });
  });

  //highlighting the editable elements when mouseenter
  $("body").on('mouseenter', "span[id|='name'],span[id|='description'],span[id|='statusspan'],span[id|='member']",function(){
    $(this).addClass('borderEdit');
  }).on('mouseleave', "span[id|='name'],span[id|='description'],span[id|='statusspan'],span[id|='member']",function(){
    $(this).removeClass('borderEdit');
  });
  //task name edit
  $("body").on('click', "span[id|='name']", function(){
    //console.log($(this));
    $list = $("[class|='name']");
    //console.log($list.length);
    if($list.length != 0)
    {
      return;
    }
    $cobjId = $(this).attr('id');
    $id = $cobjId.slice($cobjId.lastIndexOf('-')+1, $cobjId.length);
    $nameObj = $(this).parent();
    $spanTxt = $($nameObj).children('span').text();
    $($nameObj).empty();
    $($nameObj).html('<input type="text" value="'+$spanTxt+'"  > ');
    $($nameObj).children('input').attr('id', "name-"+$id).attr('class', "name-"+$id);
    $($nameObj).children('input').focus();
  });
 
  //task description edit
  $("body").on('click', "span[id|='description']", function(){
    //console.log($(this));
    $list = $("[class|='description']");
   // console.log($list.length);
    if($list.length != 0)
    {
      return;
    }
    $cobjId = $(this).attr('id');
    //console.log($cobjId);
    $id = $cobjId.slice($cobjId.lastIndexOf('-')+1, $cobjId.length);
    $nameObj = $(this).parent();
    $spanTxt = $($nameObj).children('span').text();
    $($nameObj).empty();
    $($nameObj).html('<input type="text" value="'+$spanTxt+'"  > ');
    $($nameObj).children('input').attr('id', "description-"+$id).attr('class', "description-"+$id);
    $($nameObj).children('input').focus();
    //console.log('going focusout');
  });
  //task status edit
  $("body").on('click', "span[id|='statusspan']", function(){
    //console.log($(this));
    $list = $("[class|='statusspan']");
   // console.log($list.length);
    if($list.length != 0)
    {
      return;
    }
    $cobjId = $(this).attr('id');
    //console.log($cobjId);
    $id = $cobjId.slice($cobjId.lastIndexOf('-')+1, $cobjId.length);
    $nameObj = $(this).parent();
    $spanTxt = $($nameObj).children('span').text();
    $($nameObj).empty();
    //Open/InProgress/Hold/Completed/Closed

    $options  = "<option value='Open'>Open</option>";
    $options += "<option value='InProgress'>InProgress</option>";
    $options += "<option value='Hold'>Hold</option>";
    $options += "<option value='Completed'>Completed</option>";
    $options += "<option value='Closed'>Closed</option>";
    $($nameObj).html('<select>'+ $options +'</select>');
    $($nameObj).children('select').attr('id', "statusspan-"+$id).attr('class', "statusspan-"+$id);
    $("#statusspan-"+$id).css({'width':'180px','height':'30px','background-color':'#ffffff'});
    $("#statusspan-"+$id).val($spanTxt);
    $($nameObj).children('select').focus();
    //console.log('going focusout');
  });
  //task member change
  $("body").on('click', "span[id|='member']", function(){
    //console.log($(this));
    $list = $("[class|='member']");
    //console.log($list.length);
    if($list.length != 0)
    {
      return;
    }
    $cobjId = $(this).attr('id');
    //console.log($cobjId);
    //$msuerId = $cobjId.slice($cobjId.lastIndexOf('-')+1, $cobjId.length);
    $parentObj = $(this).parent();
    $spanTxt = $($parentObj).children('span').text();
    $ids = $cobjId.split("-");
    $members = getMembers($ids[2], $ids[3], "{{url('/company/team/members')}}");
    //console.log($members);
    $options = "";
    for($i = 0; $i < $members.length; $i++){
       $options += "<option value='"+$members[$i]['id']+"'>"+$members[$i]['lastname']+"</option>";
    }
    $($parentObj).empty();
    $($parentObj).html('<select>'+ $options +'</select>');
    $($parentObj).children('select').attr('id', $cobjId).attr('class', $cobjId);
    $("#"+$cobjId).css({'width':'180px','height':'30px','background-color':'#ffffff'});
    $("#"+$cobjId).val($ids[4]);
    $($parentObj).children('select').focus();
  });

  function getMembers($cuserid,$teamid,$path)
  { 
      $data = [];
      $.ajax({  
        type: "GET" ,  
        url: $path, 
        async: false, 
        data: {cuser_id: $cuserid, team_id:$teamid},
        success: function(response){
         $data=response;
        }
      });

      return $data;
  }

  $("body").focusout(function(event) {
    $nameObj = $(this).find("input[id|='name']");
    if($nameObj.length == 1)
      nameEdit($nameObj);

    $descriptionObj = $(this).find("input[id|='description']");
    if($descriptionObj.length == 1)
      descriptionEdit($descriptionObj);

    $statusObj = $(this).find("select[id|='statusspan']");
    if($statusObj.length == 1)
      statusEdit($statusObj);

    $memberObj = $(this).find("select[id|='member']");
    if($memberObj.length == 1)
      memberChange($memberObj);

  });

  function nameEdit($nameObj)
  {
    // console.log('Name function called');
    // console.log($nameObj);
    $selector = $nameObj['selector'];
    $parent = $($selector).parent();
    // console.log($selector);
    $nameObj = $($parent).html();
    $inputid = $($nameObj).attr('id');
    $inputdata = $("#"+$inputid).val();
    if($inputdata.length == 0)
    {
      //alert("Not empty");
      $($parent).children().focus();
      return;
    }
    $html = '<span id="'+$($nameObj).attr('id')+'">'+$inputdata+'</span>';
    $($parent).empty();
    $($parent).html($html);
    $path = 
      "{{url('/company/task/update/name/')}}"+"/"+$inputid.slice($inputid.lastIndexOf('-')+1, $inputid.length);
    $data = $("#"+$inputid).text();
    saveData($data,$path);
  }

  function descriptionEdit($descriptionObj)
  {
    // console.log('Description function called');
    // console.log($descriptionObj);

    $selector = $descriptionObj['selector'];
    $parent = $($selector).parent();
   // console.log($selector);
    $desObj = $($parent).html();
    $inputid = $($desObj).attr('id');
    $inputdata = $("#"+$inputid).val();
    if($inputdata.length == 0)
    {
      //alert("Not empty");
      $($parent).children().focus();
      return;
    }
    $html = '<span id="'+$($desObj).attr('id')+'">'+$inputdata+'</span>';
    $($parent).empty();
    $($parent).html($html);
    $path = 
      "{{url('/company/task/update/description/')}}"+"/"+$inputid.slice($inputid.lastIndexOf('-')+1, $inputid.length);
    $data = $("#"+$inputid).text();
    saveData($data,$path);
  }

  function statusEdit($statusObj)
  {
    // console.log('Description function called');
    // console.log($statusObj);

    $selector = $statusObj['selector'];
    $parent = $($selector).parent();
    //console.log($selector);
    $selObj = $($parent).html();
    $selid = $($selObj).attr('id');
    $seldata = $("#"+$selid).val();
    // if($inputdata == -1)
    // {
    //   //alert("Not empty");
    //   $($parent).children().focus();
    //   return;
    // }
    //console.log($seldata);
    $html = '<span id="'+$($selObj).attr('id')+'">'+$seldata+'</span>';
    $($parent).empty();
    $($parent).html($html);
    $($parent).children('span').addClass('text text-danger font-size-18');
    $path = 
      "{{url('/company/task/update/status/')}}"+"/"+$selid.slice($selid.lastIndexOf('-')+1, $selid.length);
    $data = $("#"+$selid).text();
    saveData($data,$path);

  }

  function memberChange($memberObj)
  {
    //console.log($memberObj);
    $selector = $memberObj['selector'];
    $parent = $($selector).parent();
    //console.log($selector);
    $selObj = $($parent).html();
    $selid = $($selObj).attr('id');
    $ids   = $selid.split('-');
    $seldata   = $("#"+$selid+" option:selected").text();
    $seldataId = $("#"+$selid).val();
    //console.log($seldata,$seldataId);
    $newId = $ids[0]+"-"+$ids[1]+"-"+$ids[2]+"-"+$ids[3]+"-"+$seldataId;
    //console.log($newId);
    $html = '<span id="'+$newId+'">'+$seldata+'</span>';
    $($parent).empty();
    $($parent).html($html);
    //$($parent).children('span').addClass('text text-danger font-size-18');
    $path = 
      "{{url('/company/task/update/member/')}}"+"/"+$ids[1];

    saveData($seldataId,$path);

  }
  function saveData($data,$path){
    $.ajax({  
      type: "GET" ,  
      url: $path, 
      async: true, 
      data: {data: $data},
      success: function(response){
       console.log(response);
      }
    });
  }

 
  
  //change status link events
  $('a.statuschange').click(function(event){
    event.preventDefault();
    $path = $(this).attr('href');
    $taskId = $path.slice($path.lastIndexOf('/')+1, $path.length);
    //alert($path);
    $cstatus = $('#statusspan-'+$taskId).text();
    //$(this).siblings('#statusdiv').children('#statusspan-'+$taskId).addClass('dynamicstatus');
    $('#statusspan-'+$taskId).addClass('dynamicstatus');
    console.log($cstatus);
    $('#statusModal form').attr('action',$path);
    $('#statusModal form #cstatuslbl').text($cstatus);
    $('#statusModal #tstatus').val($cstatus);
    $('#statusModal').modal('show');
  });
  //change status model events
  $('#formStatusAjax button[type=submit]').click(function(event){
     event.preventDefault();
     $path = $('#formStatusAjax').attr('action');
     //console.log($path);
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
