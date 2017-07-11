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
    <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap3.3.6/css/custom.css') }}">
     <!-- JavaScripts -->
    <script src="{{ URL::asset('assets/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('assets/bootstrap3.3.6/js/bootstrap.min.js') }}" ></script>
    <!--script src="{{ URL::asset('assets/bootstrap3.3.6/js/bootstrap-multiselect.js') }}" ></script-->
    <script src="{{ URL::asset('assets/bootstrap3.3.6/js/custom.js') }}" ></script>
</head>
<body id="app-layout" >
    @extends('layouts.header')
    <div class='container-fluid m-t-c'>
        @yield('content')
    </div>
    @extends('layouts.footer')
</body>
</html>
