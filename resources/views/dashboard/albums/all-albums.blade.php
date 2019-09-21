@extends('dashboard.layouts.app')

@section('style')
    {{-- Data table --}}
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendor/datatable/dataTables.bootstrap4.min.css')}}">
@endsection

@section('breadcrumbs', Breadcrumbs::render('userAlbums', $parentPrefix, $user))

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
                                            <th>Total Images</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $x = 1;?>
                                        @foreach($albums as $album)
                                            <tr id="row_{{$album['id']}}">
                                                <th class="text-center">
                                                    {{ $x}}
                                                </th>
                                                <th>{{$album['name']}}</th>
                                                <th>{{$album->image->count()}}</th>
                                                <th>
                                                    @if(auth()->user()->can(['show-user-album']))
                                                        <a href="{{route('dashboard.album.show',['parentPrefix'=>$parentPrefix,'user'=>$user,'album'=>$album])}}"
                                                           class="btn btn-primary btn-icon-only rounded-circle" {{tooltip('Show Album')}}>
                                                            <span class="btn-inner--icon"><i
                                                                        class="far fa-eye"></i></span>
                                                        </a>
                                                    @endif
                                                    @if(auth()->user()->can(['delete-user-album']))
                                                        <button type="button"
                                                                deleteURL="{{ route('dashboard.album.delete',['album'=>$album]) }}"
                                                                renderURL="{{ route('dashboard.album.ajax',['album'=>$album]) }}"
                                                                class="btn btn-danger btn-icon-only rounded-circle delete-item"{{tooltip('Delete Album')}}>
                                                    <span class="btn-inner--icon"><i
                                                                class="far fa-trash-alt"></i></span>
                                                        </button>
                                                    @endif
                                                </th>
                                            </tr>
                                            <?php $x++;?>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
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
