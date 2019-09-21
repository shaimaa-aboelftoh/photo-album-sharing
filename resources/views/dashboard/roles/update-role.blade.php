@extends('dashboard.layouts.app')
@section('breadcrumbs', Breadcrumbs::render('updateRole', $role))
@section('content')
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0" id="page-title">{{$pageTitle}}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form id="update-role-form" action="{{route('dashboard.role.update',['role'=>$role])}}" method="post">
                @csrf
                <input type="hidden" name="role_id" value="{{$role->id}}">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label"
                                   for="display_name">Role Name</label>
                            <input name="display_name" value="{{old('display_name')?: $role['display_name']}}"
                                   type="text"
                                   class="form-control" id="display_name"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-9">
                        <div class="form-group">
                            <label class="form-control-label" for="description">Description</label>
                            <input name="description" value="{{old('description')?: $role->description}}" type="text"
                                   class="form-control" id="description" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($permissions as $permission)
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="permissions_{{$permission->id}}"
                                       name="permission_ids[]" type="checkbox"
                                       value="{{$permission->id}}" {{checkbox_input_val(old('permission_ids'),$rolePermissionIds,$permission->id)}}>
                                <label class="custom-control-label"
                                       for="permissions_{{$permission->id}}">{{ucwords($permission->display_name)}}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <p id="permissions-validation">
                </p>
                <button type="submit" class="btn btn-primary update-role-submit" id="form-submit-btn">Save Changes</button>
            </form>
        </div>
    </div>
@endsection
