@extends('dashboard.layouts.app')

@section('style')
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="{{asset('admin/vendor/bootstrap-select/bootstrap-select.min.css')}}">
@endsection

@section('breadcrumbs', Breadcrumbs::render('updateUser', $parentPrefix, $user))

@section('content')
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0" id="page-title">{{$pageTitle}}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form id="update-user-form" action="{{route('dashboard.user.update',['user'=>$user])}}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Name</label>
                            <input id="name" type="text" class="form-control" value="{{old('name')?: $user['name']}}"
                                   name="name">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label" for="email">Email</label>
                            <input id="email" type="email" class="form-control"
                                   value="{{old('email') ?: $user['email']}}" name="email">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label" for="password">Password</label>
                            <input name="password" value="" type="password"
                                   class="form-control" id="password" placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label"
                                   for="password_confirmation">Password Confirmation</label>
                            <input name="password_confirmation" value=""
                                   type="password" class="form-control"
                                   id="password_confirmation" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="role_ids">Roles</label>
                            <select id="role_ids" class="form-control selectpicker show-tick"
                                    data-live-search="true" data-title="Please Select Role" name="role_ids[]"
                                    multiple @if ($user->id == auth()->user()->id ) disabled @endif>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{select_array_input_val($role->id,old('role_ids'),$userRoleIds)}}>{{ucwords($role->display_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary update-user-submit" id="form-submit-btn">Save Changes</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <!-- Bootstrap select -->
    <script src="{{asset('admin/vendor/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker({
                style: '',
                styleBase: 'form-control',
            });
        });
    </script>
@endsection
