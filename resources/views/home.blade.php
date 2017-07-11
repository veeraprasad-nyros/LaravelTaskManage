@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>

                <div class="panel-body">
                    <h4 class= 'text text-success'>Welcome {{Auth::user()->lastname}} {{Auth::user()->firstname}} !</h4>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
//alert('hai');
</script>
@endsection
