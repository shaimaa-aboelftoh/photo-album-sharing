@extends('layouts.custom-app')

@section('navbar')
    <div class="logo text-center">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('site/images/logo-m.png')}}"
                                                         data-src="{{asset('site/images/logo-m.png')}}"
                                                         class="lazyload"></a>
    </div>
@endsection

@section('content')
    <section class="contact-us bg-light">
        <div class="container">
            <h3 class="text-center">Login To Join Us</h3>

            <div class="row justify-content-center">
                <div class="col-md-7 col-sm-10">
                    <div class="contact-form">
                        <form method="POST" action="{{ route('loginAjax') }}" id="custom-login-form">
                            @csrf
                            <div class="form-group">
                                <label for="inputEmail">Your Email Addrss</label>
                                <input type="email" name="email" value="{{ old('email') }}" id="inputEmail"
                                       class="form-control"
                                       placeholder="Write Your Email">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Your Password </label>
                                <input type="password" name="password" id="inputPassword"
                                       class="form-control"
                                       placeholder=" Write Your password">
                            </div>

                            <div class="text-center p-2">
                                <button type="submit" class="btn btn-gradiant login-submit">login</button>
                            </div>

                            <div>
                                <b> <span>Don't Have An Account ?</span> <a href="{{route('register')}}" class="main-color ">Sign
                                        Up</a></b>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
