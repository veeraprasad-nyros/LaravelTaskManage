@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading text-center font-size-20">New Task </div>
                <div class="panel-body">
                    <div class="alert alert-success fade in" id="Memberalert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Member added successfully!
                      </div>
                    <form id="newTask" class="form-horizontal" enctype="multipart/form-data"  role="form" method="POST" action="{{url('/company/task/add')}}" autocomplete="off" >
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label text text-info">Title:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>Title is required</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label text text-info">Description:</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tstatus') ? ' has-error' : '' }}">
                            <label for="tstatus" class="col-md-4 control-label"><span class="text text-info">Choose Status:</span></label>
                            <div class="col-md-3" id="tstatusajax">
                                <select id="tstatus" name='tstatus'>
                                    <option value="-1">select</option>
                                    <option value="Open">Open</option>
                                    <option value="InProgress">InProgress</option>
                                    <option value="Hold">Hold</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Closed">Closed</option>
                                </select> 
                                @if ($errors->has('tstatus'))
                                    <span class="help-block">
                                        <strong>select status</strong>
                                    </span>
                                @endif                              
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="teamid" class="col-md-4 control-label text text-info">Choose Team:</label>
                            <div class="col-md-3" id="teamselajax">
                                @if(count($teams) == 0)
                                    <select id="teamid" name='teamid' disabled=true>
                                        
                                    </select>
                                @endif
                                @if(count($teams) > 0)
                                <select id="teamid" name='teamid'>
                                    <option value="-1">select</option>
                                    @foreach($teams as $team)
                                    <option value="{{$team->id}}">{{$team->team_name}}</option>
                                    @endforeach
                                </select>
                                @endif
                               
                                @if($errors->has('teamid'))
                                    <span class="help-block">
                                        <strong class="text text-danger">Choose the Team Name!</strong>
                                    </span>
                                @endif
                               
                            </div>
                            <div>
                                <!-- Trigger the modal with a button -->
                                <button type="button" class="btn btn-link colorAnimate" id="newMember" data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-btn fa-user"></i> Add Members
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="members" class="col-md-4 control-label text text-info">Team Members:</label>
                            <div class="col-md-3" >
                                <div id='mlistcontainer'>
                                 <select id="mlist" multiple="multiple" ></select>
                                </div>
                                @if($errors->has('members'))
                                    <span class="help-block">
                                        <strong class="text text-danger">select the Member(s)!</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4" >
                                <ul id="selectedlist" style="list-style-type:none;display:block;border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                                </ul>
                            <!--  
                                <select id="mlist" multiple="multiple">
                                </select> 
                                <ul id="selmemberslist" style="list-style-type:none;display:block">
                                </ul>
                                -->
                            </div>
                            <!-- <div class="col-md-6" id ="members">
                               
                                @if($errors->has('members'))
                                    <span class="help-block">
                                        <strong class="text text-danger">select the Member(s)!</strong>
                                    </span>
                                @endif
                            </div>
                             -->
                        </div>

                        <div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }}">
                            <label for="attachment" class="col-md-4 control-label text text-info">Attachment:</label>

                            <div class="col-md-6">
                                <input id="attachment" type="file" class="form-control" name="attachment" value="{{ old('attachment') }}" required>

                                @if ($errors->has('attachment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attachment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sdate" class="col-md-4 control-label text text-info">Task startdate:</label>

                            <div class="col-md-6">
                            
                               <input type="text" name="sdate" id="sdate" value=""  class="form-control" >
                                <span class="errorsdate text text-danger" id="errorsdate"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edate" class="col-md-4 control-label text text-info">Task deadline:</label>

                            <div class="col-md-6">
                           <?php  $dt = \Carbon\Carbon::now(); ?> 
                                <!-- <input name="year" id="year" type="number" min=2016 max=2060 placeholder="YYYY" value="{{$dt->year}}"> -
                                <input name="month" id ="month" type="number" min=1 max=12 placeholder="MM" value="{{$dt->month}}"> -
                                <input name="day" id="day" type="number" min=1 max=31 placeholder="DD" value="{{$dt->day}}"> 
                                
                                <input name="hour" id="hour" type="number" min=0 max=23 placeholder="hh" value="{{$dt->hour}}">:
                                <input name="minute" id="minute" type="number" min=0 max=59 placeholder="mm" value="{{$dt->minute}}" >:
                                <input name="second" id="second" type="number" min=0 max=59 placeholder="ss" value=59 >
 -->                            <input type="text" name="edate" id="edate" value="" 
                                class="form-control" >
                                <span class="erroredate text text-danger" id="erroredate"></span>
                               <!--  <div id="datetimepicker1" class="input-append date">
                                  <input data-format="dd/MM/yyyy hh:mm:ss" type="text"></input>
                                  <span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                                </div> -->
                                
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-tasks"></i> Add Task
                                </button>
                               
                                <!-- <button type="button" id= 'test' >Test</button> -->

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
                        <!-- Modal for new member adding -->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text text-info text-center">New Member</h4>
        </div>
        <div class="modal-body">  
            <form id="formajax" class="form-horizontal ajax" role="form" method="POST" action="{{url('/company/team/newmember')}}" autocomplete="off">
                        {{ csrf_field() }}

                <div class="form-group">
                    <label for="firstname" class="col-md-4 control-label">First Name</label>
                    <div class="col-md-6">
                        <input id="firstname" type="text" class="form-control" name="firstname"  >
                        <span id='errorfirstname' class="text text-danger ferror"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-md-4 control-label">Last Name</label>
                    <div class="col-md-6">
                        <input id="lastname" type="text" class="form-control" name="lastname">
                        <span id='errorlastname' class="text text-danger ferror"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-md-4 control-label">Email</label>
                    <div class="col-md-6">
                       <input id="email" type="email" class="form-control" name="email" >
                       <span id='erroremail' class="text text-danger ferror"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-4 control-label">Password</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" >
                        <span id='errorpassword' class="text text-danger ferror"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-md-4 control-label">Address</label>
                    <div class="col-md-6">
                        <input id="address" type="text" class="form-control" name="address" >
                        <span id='erroraddress' class="text text-danger ferror"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="teamid" class="col-md-4 control-label">Choose Team</label>
                    <div class="col-md-3">
                        @if(count($teamlist) == 0)
                            <select id="teamid" name='teamid' disabled=true></select>
                        @endif
                        @if(count($teamlist) > 0)
                            <select id="teamid" name='teamid'>
                                @foreach($teamlist as $team)
                                <option value="{{$team->id}}">{{$team->team_name}}</option>
                                 @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="col-md-4" >
                        <span  class="text text-info colorAnimate" id="showinfo" style="cursor:pointer;" data-toggle="tooltip" data-placement="top" title="Information about Teams">
                            <i class="fa fa-info-circle" aria-hidden="true"></i> Team Information
                        </span>
                        <div id="teaminfo" class="pull-right">
                            <div  id="teaminfodiv" class="bg-info">
                               
                            </div>
                        </div>
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
                <!-- Modal ended-->
<style>
    /*team select box style */
    #teamid, #tstatus {
        width:180px;
        height:30px;
        background-color: #ffffff;
    }
    /*team info style */
    #teaminfo {
        position: relative;
        width: 1px;
        height: 1px;
        border:1px solid rgba(0,0,0,0);
    }
    #teaminfodiv {
        position: absolute;
        top: -100px;
        right: -60px;
       
        border: 3px solid rgba(0,0,0,0.2);
        box-shadow: 0 1px 5px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    }

</style>
<script>
$(document).ready(function() {
    //form submit
    
    //console.log(checkEmailExisted('veeraprasdadsmart@gmail.com',"{{url('/company/member/emailvalidate')}}"+"/"));
    $('#Memberalert').hide();
    $('form.ajax button[type=submit]').click(function(e) {
     
        e.preventDefault();
      
        var emailvalidatepath = "{{url('/company/member/emailvalidate')}}"+"/";
        var firstname = $('form.ajax #firstname').val();
        var lastname = $('form.ajax #lastname').val();
        var email = $('form.ajax #email').val();
        var secret = $('form.ajax #password').val();
        var address = $('form.ajax #address').val();
        var teamid  = $('form.ajax #teamid :selected').val();     
        //console.log(firstname,lastname,email,secret,address,teamid);
        var path = "{{url('/company/team/newmember')}}";
        
        var list ={
            firstname:firstname, 
            lastname:lastname, 
            email:email, 
            password:secret, 
            address:address 
        };
        var errors = emptyCheck(list);
        //console.log(errors);
        if(errors['count'] > 0)
        {
            for(i in list)
            {   
                if (errors.hasOwnProperty(i) ) {
                   $('#error'+i).text(i+' required');
                }
                else
                {
                    $('#error'+i).text('');
                }
                //console.log('#error'+i);
            }
        }
        if(errors['count'] == 0)
        {
            $('.ferror').empty();
            
                //  /(\w+)+@(gmail|yahoo).com$/
                if(! /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/.test(email))
                {
                    $('#erroremail').html('Email Not valid!');
                }
                else
                {
                    $('#erroremail').empty();
                    if(checkEmailExisted(email,emailvalidatepath))
                    {
                        $('#erroremail').text('Email already existd!');
                    }
                    else
                    {
                        
                        $('#erroremail').empty();
                        submitFormdata();
                    }
                }
        }
        
    });

    function submitFormdata(){

        var emailvalidatepath = "{{url('/company/member/emailvalidate')}}"+"/";
        var firstname = $('form.ajax #firstname').val();
        var lastname = $('form.ajax #lastname').val();
        var email = $('form.ajax #email').val();
        var secret = $('form.ajax #password').val();
        var address = $('form.ajax #address').val();
        var teamid  = $('form.ajax #teamid :selected').val();     
        //console.log(firstname,lastname,email,secret,address,teamid);
        var path = "{{url('/company/team/newmember')}}";
        $('#ajaxLoader').show();
        $.ajax({
            type: "GET",
            url: path,
            data: { firstname:firstname, lastname:lastname, email:email, password:secret, address:address, teamid:teamid },
            success: function( response) {

                //console.log(response)
                
                $("#myModal").modal("hide");
                $('#Memberalert').show();
                $('#teamselajax #teamid').empty();
                $('#teamselajax #teamid').append($("<option></option>").attr("value","-1").text('select')); 
                for(i = 0; i < response.length; i++){
                   $('#teamselajax #teamid').append($("<option></option>").attr("value",response[i]['id']).text(response[i]['team_name'])); 
                }
                $('#ajaxLoader').hide();

            },
            error: function(response) {
                console.log(response);
                $('#errorsubmit').text("You are entered invalid data please check");
            }

        }); 
    }
    //Team information
    $('#teaminfodiv').hide();
    $("#showinfo").click(function(){
        $.ajax({  
            type: "GET" ,  
            url: "{{url('/company/team/info')}}",  
            //data: dataString,
            success: function(response){
                console.log(response);
                //$('#teaminfodiv').empty();
                $info = '<table class="text text-center"><tr class="text text-primary"><th>TeamName&nbsp;</th><th> Tot.Members</th></tr>';
                for(var i=0; i < response.length; i++)
                {
                    $info += '<tr><td>'+response[i]['team_name']+'</td><td>'+response[i]['mtot']+'</td></tr>';
                }
                $info += '</table>';
                $('#teaminfodiv').html($info);
            }
        });
        $('#teaminfodiv').toggle();
           
    });
    

    //Adding Team Members
    // $('#test').click(function(){
    //    console.log("clicked");
    //    window.open("{{url('/company/member/new')}}", 'NewMember', 'type=fullWindow,fullscreen,scrollbars=yes');
    // });
    $('#mlist').multiselect({
        //enableFiltering: true,
        selectAllValue: 'multiselect-all',
    });

    //team selection and members multi-select and displaying members selected 
    $('#teamselajax #teamid').change(function(){
        $("#mlistcontainer").empty();
        $('#selectedlist').empty();
        //console.log('team select ajax teamid');
        $('#mlistcontainer').append($("<select></select>",{ id: "mlist", name:"members[]", multiple:"multiple" }));
        $value = $('#teamselajax #teamid  option:selected').val();
        $text  = $('#teamselajax #teamid  option:selected').text();
        $path = "{{ url('/company/team/members')}}" + "/"+ $value;
        //$('#mlist').append($('<option></option>',{value:'123',text: "456"}));  
        $('#ajaxLoader').show();       
        $.ajax({  
                type: "GET" ,  
                url: $path,  
                //data: dataString,
                success: function(response)
                {
                    for(i = 0; i < response.length; i++){
                        $('#mlist').append($("<option></option>").attr("value",response[i]['id']).text(response[i]['lastname'])); 
                    }
                    $('#mlist').multiselect({
                        //enableFiltering: true,
                        selectAllValue: 'multiselect-all',
                        //includeSelectAllOption: true,
                        //buttonWidth: '30%',
                        onChange: function(element, checked) {
                            var brands = $('#mlist option:selected');
                            var selected = []; //"";
                            $(brands).each(function(index, brand){
                                //selected.push([$(this).text()]);
                                selected.push($(this).text());
                                //selected += $(this).text();
                            });
                            $('#selectedlist').empty();
                            //console.log(selected.length);
                            if(selected.length == 0){
                                $('<li></li>',{text: "No members selected", class:"text text-warning"}).appendTo('#selectedlist');
                            }else{
                                $('<span></span>',{text: "Selected Members", class:"text text-primary"}).appendTo('#selectedlist');
                                for(var i=0; i< selected.length; i++){
                                  
                                    $('<li></li>',{text: selected[i], class:"text text-success"}).appendTo('#selectedlist');
                                    //console.log(selected[i]);
                                }    
                            }
                           
                        }               
                    }); 
                                       
                }
        }); 
        $('#ajaxLoader').hide();
    });

  
});

/*
$(document).ready(function() {
    // $( "form" ).submit(function( event ) {
    //     if ( $( "#teamid" ).val() == -1 ) {
    //        alert('Select the Team');
    //        event.preventDefault();
    //        return;
    //     }
       
    // });
    $('#teamid').change(function(){
        //alert($('#teamid  option:selected').val());
        $value = $('#teamid  option:selected').val();
        $text  = $('#teamid  option:selected').text();
        if($value != -1){
            $path = "{{ url('/company/team/members')}}" + "/"+ $value;
            //alert("{{ url('/company/team/members')}}"+ "/"+ $value);
            //alert($value)
            //console.log($path);
            $.ajax({  
                type: "GET" ,  
                url: $path,  
                //data: dataString,
                success: function(response)
                {
                    //console.log(response.length);
                    $('#members').prop( "disabled", false );
                    $('#members').empty();
                    $('#selmemberslist').empty();
                    if(response.length  != 0){
                        for(i = 0; i < response.length; i++){
                            //$('#members').append($("<option></option>").attr("value",response[i]['id']).text(response[i]['lastname'])); 
                           
                            $('<input />', { type: 'checkbox',name: 'members[]', id: response[i]['id'], value: response[i]['id'] }).appendTo($('#members'));

                            $('<label />', { 'for': response[i]['id'], text: ' '+response[i]['lastname'],id:'memberlbl'+response[i]['id'] }).appendTo('#members');
                            $('<br>').appendTo('#members');

                        }
                       
                    }
                    else{
                        $('#members').empty();
                    }
                   
                }
            }); 
        }
        else{
             $('#members').empty();
        }
       
    });
       
    $('body').on('click', 'input[type=checkbox]', function() {
       $check = $( "input[type=checkbox]:checked" );
       $('#selmemberslist').empty();
       
       $('<span></span>',{text: $check.length+" member(s) selected.",class:"text text-primary"}).appendTo('#selmemberslist');

       for(var i=0; i < $check.length; i++){
         $lblid = '#memberlbl'+$check[i]['id'];
         //console.log($($lblid).text());
         $('<li></li>',{text: $($lblid).text(),class:"text text-success"}).appendTo('#selmemberslist');
       }
    }); 

    // $("input[type=checkbox]").on("click", function(){
    //     console.log($( "input:checked" ).length);
    // });
}); 
*/



</script>

<link rel="stylesheet" href="{{ URL::asset('assets/jquery/jquery.simple-dtpicker.css') }}" >
<script src="{{ URL::asset('assets/jquery/jquery.simple-dtpicker.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('#sdate').appendDtpicker({
            "dateFormat": "YYYY-MM-DD hh:mm",
            "locale": "en",
            "minuteInterval": 30,
            "autodateOnStart": true,
            "inline": false,
            "futureOnly": true,
            "allowWdays": [1, 2, 3, 4, 5],
            "todayButton": true,
            "calendarMouseScroll": false,
            "animation": false
        });
        $('#edate').appendDtpicker({
            "dateFormat": "YYYY-MM-DD hh:mm",
            "locale": "en",
            "minuteInterval": 30,
            "autodateOnStart": true,
            "inline": false,
            "futureOnly": true,
            "allowWdays": [1, 2, 3, 4, 5],
            "todayButton": true,
            "calendarMouseScroll": false,
            "animation": false
        });
        $('#newTask').submit('click', function(event){
           
            $sdate = $('#sdate').val();
            $('#sdate').val($sdate);
            $edate = $('#edate').val();
            $('#edate').val($edate);
            $days = daysBetween( new Date($sdate), new Date($edate) );
            if($days <= 0 )
            {
                event.preventDefault();
                console.log("Task deadline must be greater than the Task start date..");
                $('#erroredate').text('Must be greater than the Task start date..!');
            }
            else
            {
                $('#erroredate').text();
                $hredate = new Date($('#edate').val());
                if(! hourBetweenRange($hredate, 10, 18) )
                {
                    event.preventDefault();
                    console.log("Task deadline hours should be between 11 and 18 ..");
                    $('#erroredate').text('Hours between the 10 and 18 ..!');
                }
            }
            $('#erroredate').text();
        });
       
        var daysBetween = function( date1, date2 ) {
          //Get 1 day in milliseconds
          var one_day=1000*60*60*24;

          // Convert both dates to milliseconds
          var date1_ms = date1.getTime();
          var date2_ms = date2.getTime();

          // Calculate the difference in milliseconds
          var difference_ms = date2_ms - date1_ms;
            
          // Convert back to days and return
          return Math.round(difference_ms/one_day); 
        }
        var hourBetweenRange = function(date, minhour, maxhour)
        {
            console.log(date.getHours());

            if(date.getHours() >= minhour && date.getHours() <= maxhour)
                return true;
            
            return false;
        }
        
    });
</script>
@endsection