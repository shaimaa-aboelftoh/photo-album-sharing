<!DOCTYPE html>
<html>

<head>
    <title>Photo Album Sharing</title>
    <link href="{{asset('site/images/logo-m.png')}}" rel="icon" type="image/png">
    <meta charset="UTF-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="RoQaY">
    <meta name="robots" content="index, follow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=" Smart Movies website">
    <meta name="keywords" content=" Smart Movies ">
    <meta name="csrf-token" content="V2G8zLS7dL5HzdfwxaBDewvJvAKCyeThQE4NBtJv">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('site/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('site/css/fontawesome.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('site/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('site/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('site/css/style.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('site/css/responsive.css')}}">
</head>

<body>
<div class="body_wrapper">
    <div class="preloader">
        <div class="preloader-loading">
            <img src="{{asset('site/images/logo-m.png')}}" data-src="{{asset('site/images/logo-m.png')}}" class="lazyload">
        </div>
    </div>
    @include('layouts.header')
    @yield('navbar')
    @yield('content')
    @include('layouts.footer')
    <span class="scroll-top"> <a href="#"><i class="fas fa-chevron-up"></i></a> </span>
</div>
<script src="{{asset('site/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('site/js/bootstrap.min.js')}}"></script>
<script src="{{asset('site/js/popper.min.js')}}"></script>
<script src="{{asset('site/js/lazysizes.min.js')}}"></script>
<script src="{{asset('site/js/fontawesome.min.js')}}"></script>
<script src="{{asset('site/js/all.min.js')}}"></script>
<script src="{{asset('site/js/wow.min.js')}}"></script>

{{--  SweetAlert  --}}
<script src="{{asset('admin/vendor/sweet-alert/sweetalert.min.js')}}"></script>

@yield('script')

<script src="{{asset('site/js/ajax.js')}}"></script>
<script src="{{asset('site/js/main.js')}}"></script>
</body>

</html>