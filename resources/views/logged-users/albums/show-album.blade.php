@extends('logged-users.layouts.app')

@section('style')
    {{-- light gallery --}}
    <link type="text/css" rel="stylesheet" href="{{asset('admin/vendor/lightGallery/css/lightGallery.css')}}">
@endsection

@section('breadcrumbs', Breadcrumbs::render('showAlbum',$album))

@section('content')
    <!-- News main Data -->
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">{{$pageTitle}}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="name">Name</label>
                        <p class="show-page form-control"
                           id="name">{{$album['name']}}</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-2">
                    <div class="form-group">
                        <label class="form-control-label" for="name">Type</label>
                        <p class="show-page form-control"
                           id="type">{{$album['type']}}</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label" for="notes">notes</label>
                        <p class="show-page form-control"
                           id="notes">{{$album['notes']}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label" for="cover">Cover Image</label>
                        <p class="show-page lightgallery"
                           id="cover">
                            <a href="{{$album->cover}}">
                                <img src="{{$album->cover}}"
                                     alt="" class="show-img">
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <a href="{{route('album.edit',['album'=>$album])}}"
               class="btn btn-primary">Edit</a>

        </div>
    </div>

    <!-- Album Images -->
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Album Images</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">

            <div class="row justify-content-center" id="results">
                <div class="show-page text-center lightgallery">
                    @forelse($album->image as $image)
                        <a href="{{$image->name}}">
                            <img src="{{$image->name}}"
                                 alt="" class="lightgallery-slide m-4">
                        </a>
                    @empty
                        <p c="show-page">No images added !</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('admin/vendor/lightGallery/js/jquery.mousewheel.min.js')}}"></script>
    <script src="{{asset('admin/vendor/lightGallery/js/lightgallery.min.js')}}"></script>

    <!-- lightgallery plugins -->
    <script src="{{asset('admin/vendor/lightGallery/js/lg-thumbnail.min.js')}}"></script>
    <script src="{{asset('admin/vendor/lightGallery/js/lg-fullscreen.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".lightgallery").lightGallery();
        });
    </script>
@endsection
