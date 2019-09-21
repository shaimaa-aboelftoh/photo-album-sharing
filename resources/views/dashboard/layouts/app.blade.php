<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Photo Album Sharing</title>
    <!-- Favicon -->
    <link href="{{asset('site/images/logo-m.png')}}" rel="icon" type="image/png">
    <!-- Icons -->
    <link href="{{asset('admin/vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="{{asset('admin/css/argon.css')}}" rel="stylesheet">
    <link type="text/css" href="{{asset('admin/css/custom.css')}}" rel="stylesheet">
    @yield('style')
</head>

<body>
@include('dashboard.layouts.sidebar')
<!-- Main content -->
<div class="main-content">
    @include('dashboard.layouts.navbar')
    @yield('statics')
    <div class="header bg-gradient-primary pb-6 pt-5 pt-md-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        @yield('breadcrumbs')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
        @yield('content')
        @include('dashboard.layouts.footer')
    </div>
</div>
<!-- End Main content -->
<script src="{{asset('admin/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('admin/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
@yield('script')

{{--  SweetAlert  --}}
<script src="{{asset('admin/vendor/sweet-alert/sweetalert.min.js')}}"></script>

<script src="{{asset('admin/js/ajax.js')}}"></script>

<!-- Argon JS -->
<script src="{{asset('admin/js/argon.js')}}"></script>

</body>

</html>
