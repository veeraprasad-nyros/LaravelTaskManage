@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.
                    {{ ImageResize::eventImage("http://www.planwallpaper.com/static/images/6775415-beautiful-images.jpg", "./uploads/attachments/") }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
