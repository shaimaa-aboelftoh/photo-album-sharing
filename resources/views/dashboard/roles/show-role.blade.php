@extends('dashboard.layouts.app')
@section('breadcrumbs', Breadcrumbs::render('showRole', $role))
@section('content')
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">{{$pageTitle}}</h3>
        </div>
        <!-- Card body -->

        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="form-group ">
                        <label class="form-control-label"
                               for="display_name">Role Name</label>
                        <p class="form-control show-page">{{ $role->display_name}}</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-9">
                    <div class="form-group">
                        <label class="form-control-label" for="description">Description</label>
                        <p class="form-control show-page" id="description">{{$role->description}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($permissions as $permission)
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id=""
                                   type="checkbox" readonly {{checkbox_input_val([],$rolePermissionIds,$permission->id)}}>
                            <label class="custom-control-label"
                                   for="">{{$permission->display_name}}</label>
                        </div>
                    </div>
                @empty
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <p>No Permissions attached to this role</p>
                    </div>
                @endforelse
            </div>
            @if(auth()->user()->can(['edit-role']) && !in_array($role->id,[1,2]))
                <a href="{{route('dashboard.role.edit',['role'=>$role])}}"
                   class="btn btn-primary">Edit</a>
            @endif
        </div>
    </div>
@endsection
