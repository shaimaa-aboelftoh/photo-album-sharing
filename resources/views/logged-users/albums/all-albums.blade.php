@extends('logged-users.layouts.app')

@section('style')
    {{-- Data table --}}
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendor/datatable/dataTables.bootstrap4.min.css')}}">
@endsection

@section('breadcrumbs', Breadcrumbs::render('allAlbums'))

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
                    <div class="table-responsive py-1">
                        <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12" id="results">
                                    <table class="table text-center table-striped table-bordered dataTable"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Total Images</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($albums as $key => $album)
                                            <tr id="row_{{$album['id']}}">
                                                <th class="text-center">
                                                    {{ $key +1}}
                                                </th>
                                                <th>{{$album['name']}}</th>
                                                <th>{{$album['type']}}</th>
                                                <th>{{$album->image->count()}}</th>
                                                <th>
                                                    <a href="{{route('album.show',['album'=>$album])}}"
                                                       class="btn btn-primary btn-icon-only rounded-circle" {{tooltip('Show Album')}}>
                                                            <span class="btn-inner--icon"><i
                                                                        class="far fa-eye"></i></span>
                                                    </a>
                                                    <a href="{{route('album.edit',['album'=>$album])}}"
                                                       class="btn btn-success btn-icon-only rounded-circle" {{tooltip('Update Album')}}>
                                                        <span class="btn-inner--icon"><i class="far fa-edit"></i></span>
                                                    </a>
                                                    <button type="button"
                                                            deleteURL="{{ route('album.delete',['album'=>$album]) }}"
                                                            renderURL="{{ route('album.ajax') }}"
                                                            class="btn btn-danger btn-icon-only rounded-circle delete-item"{{tooltip('Delete Album')}}>
                                                    <span class="btn-inner--icon"><i
                                                                class="far fa-trash-alt"></i></span>
                                                    </button>
                                                </th>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Total Images</th>
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
            $('.dataTable').dataTable({
                aaSorting: [[0, 'asc']]
            });
        });
    </script>
@endsection
