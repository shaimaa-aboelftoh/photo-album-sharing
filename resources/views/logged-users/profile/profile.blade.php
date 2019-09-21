@extends('logged-users.layouts.app')
@section('breadcrumbs', Breadcrumbs::render('profile',$user))
@section('content')
    <div class="card mb-6">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0" id="page-title">{{$pageTitle}}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" id="update-profile-form" action="{{ route('profile.update') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Name</label>
                            <input name="name" value="{{old('name') ?: $user['name']}}" type="text"
                                   class="form-control" id="name" placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label" for="email">Email</label>
                            <input name="email" value="{{old('email') ?: $user['email']}}" type="email"
                                   class="form-control" id="email" placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label" for="password">Password</label>
                            <input name="password" type="password"
                                   value="{{old('password') ?: $user['visible_password']}}"
                                   class="form-control" id="password" placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label" for="password_confirmation">Password Confirmation</label>
                            <input name="password_confirmation" type="password"
                                   value="{{old('password_confirmation') ?: $user['visible_password_confirmation']}}"
                                   class="form-control" id="password_confirmation" placeholder="">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary profile-submit" id="form-submit-btn">Save Changes
                </button>
            </form>
        </div>
    </div>
@endsection
