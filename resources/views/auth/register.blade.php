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
            <h3 class="text-center">Sign Up To Join Us</h3>

            <div class="row justify-content-center">
                <div class="col-md-7 col-sm-10">
                    <div class="contact-form">
                        <form method="POST" action="{{ route('registerAjax') }}" id="custom-register-form">
                            @csrf
                            <div class="form-group ">
                                <label for="inputName">Write Your Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" id="inputName"
                                       class="form-control"
                                       placeholder="Write Your Name">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Your Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" id="inputEmail"
                                       class="form-control"
                                       placeholder="Write Your Email">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Enter Password </label>
                                <input type="password" name="password" id="inputPassword"
                                       class="form-control"
                                       placeholder=" Write Your password">
                            </div>

                            <div class="form-group">
                                <label for="inputConfirmPassword">Confirm Password </label>
                                <input type="password" name="password_confirmation" id="inputConfirmPassword" class="form-control"
                                       placeholder="  Confirm Your password">
                            </div>

                            <div class="text-center p-2">
                                <button type="submit" class="btn btn-gradiant register-submit">Sign Up</button>
                            </div>

                            <div>
                                <b> <span>Have An Account ?</span> <a href="{{route('login')}}"
                                                                      class="main-color ">Login</a></b>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
