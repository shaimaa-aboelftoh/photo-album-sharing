@extends('dashboard.layouts.app')

@section('breadcrumbs', Breadcrumbs::render('showUser', $parentPrefix, $user))

@section('content')
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">{{$pageTitle}}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="form-group ">
                        <label class="form-control-label">Name</label>
                        <p class="form-control show-page"> {{$user->name}} </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label" for="email">Email</label>
                        <p class="form-control show-page"> {{$user->email}} </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="email">Roles</label>
                        <p class=" show-page">
                        <ul>
                            @foreach($user->roles as $role)
                                <li>{{ucwords($role->display_name)}}</li>
                            @endforeach
                        </ul>
                        </p>
                    </div>
                </div>
            </div>

            @if(auth()->user()->can(['edit-user']) && ($user->id != 1 || ($user->id == 1 && auth()->user()->id ==1)))
                <a href="{{route('dashboard.user.edit',['prefix'=>$parentPrefix,'user'=>$user])}}"
                   class="btn btn-primary">Edit</a>
            @endif
        </div>
    </div>
@endsection
