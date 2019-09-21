@extends('layouts.custom-app')

@section('navbar')
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('site/images/logo-m.png')}}"
                                                             data-src="{{asset('site/images/logo-m.png')}}"
                                                             class="lazyload"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <ul class="menu-bars">
                            <li><span></span></li>
                            <li><span></span></li>
                            <li><span></span></li>
                        </ul>
                    </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('profile.edit')}}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('album.all')}}">My Albums</a>
                        </li>
                    @endauth
                    @if (auth()->check() && auth()->user()->can(['show-dashboard']))
                        <li class="nav-item">
                            <a class="nav-link" href="#"> Admin Panel</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <button class="btn btn-gradiant">
                            @auth
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                                <a href="{{route('logout')}}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            @else
                                <a href="{{route('login')}}">login</a>
                            @endauth
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <section class="check_demo_movie">
        <div class="container">
            <h2 class=" wow fadeInDown">Images of <span class="main-color">{{$album['name']}}</span></h2>
            <p>{{$album['notes']}}</p>
            <div class="row">
                @php
                    $animationTimer = 0.5;
                @endphp
                @forelse($images as $image)
                    <div class="col-md-4">
                        <div class="card wow fadeInUp" data-wow-duration="{{$animationTimer}}s"
                             data-wow-delay="{{$animationTimer}}s">
                            <div class="card-header">
                                <img src="{{$image->name}}"
                                     class="lazyload">
                            </div>
                        </div>
                    </div>
                    @php
                        $animationTimer += 0.1;
                    @endphp
                @empty
                    <p>No Images found !</p>
                @endforelse
            </div>
            {{$images->links()}}
        </div>
    </section>
@endsection

@section('footer-links')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('site/images/logo-m.png')}}"
                                                                 data-src="{{asset('site/images/logo-m.png')}}"
                                                                 class="lazyload"></a>
                <p> Interact With The Content In An Interesting Educational Experience, Using Studying Means
                    Anywhere & Anytime Directly From your Computer. </p>
            </div>
            <div class="col-md-4">
                <h5>Links</h5>
                <div class="links d-flex">
                    <ul>
                        <li><a href="#"> > Create Account</a></li>
                        <li><a href="#"> > movie</a></li>
                        <li><a href="#"> > Team </a></li>
                        <li><a href="#"> > Company </a></li>
                    </ul>
                    <ul>
                        <li><a href="#"> > Questions</a></li>
                        <li><a href="#"> > Blog</a></li>
                        <li><a href="#"> > Terms of Privacy </a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Contact Us</h5>
                <div><a href="mailto:info@smartmovie.com"> <i class="fas fa-envelope"></i>
                        info@smartmovie.com</a></div>
                <form action="">
                    <div class="input-group mb-2">
                        <input type="email" class="form-control" id="inlineFormInputGroup"
                               placeholder=" Your Email ">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <button class="btn btn-gradiant m-0">
                                    <a href="#">Send</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <ul class="d-flex social ">
                    <li><a href="#"> <i class="fab fa-facebook-f"></i> </a></li>
                    <li><a href="#"> <i class="fab fa-twitter"></i> </a></li>
                    <li><a href="#"> <i class="fab fa-instagram"></i> </a></li>
                    <li><a href="#"> <i class="fab fa-snapchat-ghost"></i> </a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
