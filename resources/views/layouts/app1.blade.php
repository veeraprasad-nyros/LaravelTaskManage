<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TaskManage</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ URL::asset('assets/fontawesome/css/font-awesome.css') }}" >
    <link rel="stylesheet" href="{{ URL::asset('assets/Lato/Lato.css') }}" >

    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap3.3.6/css/bootstrap.min.css') }}" >
    <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap3.3.6/css/dataTables.bootstrap-1.10.12.min.css') }}">
     <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap3.3.6/css/custom.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/ajaxloader/ajaxloader.css') }}">
    <link href="{{ URL::asset('assets/bootstrap3.3.6/css/bootstrap-multiselect.css') }}"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap3.3.6/css/popup.css') }}" >
     <!-- JavaScripts -->
    <script src="{{ URL::asset('assets/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('assets/bootstrap3.3.6/js/bootstrap.min.js') }}" ></script>
    <script src="{{ URL::asset('assets/jquery/jquery.dataTables-1.10.12.min.js')}}"></script>
    <script src="{{ URL::asset('assets/bootstrap3.3.6/js/dataTables.bootstrap-1.10.12.min.js') }}" ></script>
    
    
</head>
<body id="app-layout">
    <div class="ajaxLoader" id="ajaxLoader">
        <img src="{{ URL::asset('assets/ajaxloader/ajax-loader2.gif') }}" />
    </div>
    <div class='container-fluid m-t-c'>
        @yield('content')
    </div>
     

     <script src="{{ URL::asset('assets/bootstrap3.3.6/js/bootstrap-multiselect.js') }}" ></script>
     <script src="{{ URL::asset('assets/bootstrap3.3.6/js/jquery.popup.js') }}" ></script>
     <script src="{{ URL::asset('assets/bootstrap3.3.6/js/custom.js') }}" ></script>
</body>
</html>
