@extends('dashboard.layouts.app')
@section('style')
    {{-- Data table --}}
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendor/datatable/dataTables.bootstrap4.min.css')}}">
@endsection

@section('breadcrumbs', Breadcrumbs::render($breadcrumb))
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0">{{$pageTitle}}</h3>
                    <p class="text-sm mb-0">
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive py-4">
                        <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12" id="results">
                                    <table class="table text-center table-striped table-bordered dataTable"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $key => $user )
                                            <tr id="row_{{$user['id']}}">
                                                <th class="text-center">
                                                    {{$key + 1}}
                                                </th>
                                                <th>{{$user->name}}</th>
                                                <th>{{$user->email}}</th>
                                                <th>
                                                    <ul>
                                                        @foreach($user->roles as $role)
                                                            <li>{{ucwords($role->display_name)}}</li>
                                                        @endforeach
                                                    </ul>
                                                </th>
                                                <th>
                                                    @if(auth()->user()->can(['user-albums']))
                                                        <a href="{{route('dashboard.album.all',['prefix'=>$parentPrefix,'user'=>$user])}}"
                                                           class="btn btn-warning btn-icon-only rounded-circle" {{tooltip('User Albums')}}>
                                                            <span class="btn-inner--icon"><i
                                                                        class="far fa-images"></i></span>
                                                        </a>
                                                    @endif
                                                    @if(auth()->user()->can(['show-user']))
                                                        <a href="{{route('dashboard.user.show',['prefix'=>$parentPrefix,'user'=>$user])}}"
                                                           class="btn btn-primary btn-icon-only rounded-circle" {{tooltip('Show User')}}>
                                                            <span class="btn-inner--icon"><i
                                                                        class="far fa-eye"></i></span>
                                                        </a>
                                                    @endif
                                                    @if(auth()->user()->can(['edit-user']) && ($user->id != 1 || ($user->id == 1 && auth()->user()->id ==1)))
                                                        <a href="{{route('dashboard.user.edit',['prefix'=>$parentPrefix,'user'=>$user])}}"
                                                           class="btn btn-success btn-icon-only rounded-circle" {{tooltip('Update User')}}>
                                                            <span class="btn-inner--icon"><i
                                                                        class="far fa-edit"></i></span>
                                                        </a>
                                                    @endif
                                                    @if(auth()->user()->can(['delete-user']) && $user->id != 1)
                                                        <button type="button"
                                                                deleteURL="{{ route('dashboard.user.delete',['user'=>$user]) }}"
                                                                renderURL="{{ route('dashboard.user.'.$parentPrefix.'Ajax') }}"
                                                                class="btn btn-danger btn-icon-only rounded-circle delete-item"{{tooltip('Delete User')}}>
                                                    <span class="btn-inner--icon"><i
                                                                class="far fa-trash-alt"></i></span>
                                                        </button>
                                                    @endif
                                                </th>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{-- Data table --}}
    <script type="text/javascript" src="{{asset('admin/vendor/datatable/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/vendor/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.dataTable').DataTable();
        });
    </script>
    @if(App::getLocale() == 'ar')
        <script src="{{asset('admin/js/datatable-ar.js')}}"></script>
    @endif
@endsection
