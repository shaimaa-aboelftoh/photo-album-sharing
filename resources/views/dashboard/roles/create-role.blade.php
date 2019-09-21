@extends('dashboard.layouts.app')
@section('breadcrumbs', Breadcrumbs::render('createRole'))
@section('content')
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">{{$pageTitle}}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form id="create-role-form" action="{{route('dashboard.role.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label" for="display_name">Role Name</label>
                            <input name="display_name" value="{{old('display_name')}}" type="text"
                                   class="form-control" id="display_name"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-9">
                        <div class="form-group">
                            <label class="form-control-label" for="description">Description</label>
                            <input name="description" value="{{old('description')}}" type="text"
                                   class="form-control" id="description"
                                   placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($permissions as $permission)
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="permissions_{{$permission->id}}"
                                       name="permission_ids[]" type="checkbox"
                                       value="{{$permission->id}}" {{checkbox_input_val($permission->id,old('permission_ids'))}}>
                                <label class="custom-control-label"
                                       for="permissions_{{$permission->id}}">{{ucwords($permission->display_name)}}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <p id="permissions-validation">
                </p>
                <button type="submit" class="btn btn-primary create-role-submit" id="form-submit-btn">Save</button>
            </form>
        </div>
    </div>
@endsection
