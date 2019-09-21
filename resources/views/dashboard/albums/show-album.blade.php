@extends('dashboard.layouts.app')

@section('style')
    {{-- light gallery --}}
    <link type="text/css" rel="stylesheet" href="{{asset('admin/vendor/lightGallery/css/lightGallery.css')}}">
@endsection

@section('breadcrumbs', Breadcrumbs::render('showUserAlbum', $parentPrefix, $user, $album))

@section('content')
    <!-- Album Images -->
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">{{$pageTitle}}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <div id="results">
                <div class="row justify-content-center">
                    @forelse($album->image as $image)
                        <div class="col-sm-2 col-md-2 show-page mt-4 mb-4 text-center">
                            <div class="lightgallery">
                                <a href="{{$image->name}}">
                                    <img src="{{$image->name}}"
                                         alt="" class="show-img">
                                </a>
                            </div>
                            <div class="clearfix"></div>
                            @if(auth()->user()->can(['delete-user-image']))
                                <button type="button"
                                        deleteURL="{{ route('dashboard.album.image.delete',['image'=>$image]) }}"
                                        renderURL="{{route('dashboard.album.image.ajax',['album'=>$album])}}"
                                        renderType="html"
                                        class="btn btn-danger mt-2 delete-item" {{tooltip('Delete Image')}}>
                                                    <span class="btn-inner--icon"><i
                                                                class="far fa-trash-alt"></i></span>
                                </button>
                            @endif
                        </div>
                    @empty
                        <p c="show-page">No images Found !</p>
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
