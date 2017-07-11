@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading text-center">
                	<span class="text text-primary font-size-20">Dashboard</span>
                </div>

                <div class="panel-body">
                    <div class="col-md-12">
                    	<div class="row">
                    		<div class="col-md-4">
                   				<button type="button" class="btn btn-block btn-primary font-size-20 p-y-10" id ="tcount"><i class="fa fa-users fa-lg" aria-hidden="true"></i> Teams <span class="badge font-size-18">7</span></button>
                   			</div>
                   			<div class="col-md-4">
						  		<button type="button" class="btn btn-block btn-success font-size-20 p-y-10" id="tmcount"><i class="fa fa-user-plus fa-lg" aria-hidden="true"></i> Members <span class="badge font-size-18">3</span></button>
						  	</div>
						  	<div class="col-md-4">
						  		<button type="button" class="btn btn-block btn-danger font-size-20 p-y-10" id="tscount"><i class="fa fa-tasks fa-lg" aria-hidden="true"></i> Tasks <span class="badge font-size-18">5</span></button>
						  	</div>
						</div>
                    </div>
                     
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	$(document).ready(function(){
		$stats = getStats("{{url('/company/stats/')}}");
		$('#tcount span').text($stats['tcount']);
		$('#tmcount span').text($stats['tmcount']);
		$('#tscount span').text($stats['tscount']);       
	});
</script>
@endsection
