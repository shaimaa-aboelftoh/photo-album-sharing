@extends('logged-users.layouts.app')

@section('style')
    {{-- File input--}}
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendor/fileinput/fileinput.css')}}">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="{{asset('admin/vendor/bootstrap-select/bootstrap-select.min.css')}}">
    {{-- light gallery --}}
    <link type="text/css" rel="stylesheet" href="{{asset('admin/vendor/lightGallery/css/lightGallery.css')}}">
@endsection

@section('breadcrumbs', Breadcrumbs::render('updateAlbum',$album))

@section('content')
    <div id="album-data">
        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0" id="page-title">{{$pageTitle}}</h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <!-- Form groups used in grid -->
                <form id="update-album-form" action="{{route('album.update',['album'=>$album])}}"
                      data-load-after-ajax="{{route('album.image.ajax',['album'=>$album])}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Name</label>
                                <input name="name" type="text" value="{{old('name') ?: $album->name}}"
                                       class="form-control"
                                       id="name" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="type">Type</label>
                                <select id="type" class="form-control selectpicker show-tick"
                                        data-title="Please Select Type" name="type">
                                    <option value="public" {{select_input_val( 'public',old('type'),$album->type)}}>
                                        Public
                                    </option>
                                    <option value="private" {{select_input_val('private', old('type'),$album->type)}}>
                                        private
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="notes">Notes</label>
                                <input name="notes" type="text" value="{{old('notes')?: $album['notes']}}"
                                       class="form-control"
                                       id="notes" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label"
                                       for="cover">Cover Image</label>
                                <p class="show-page lightgallery"
                                   id="cover">
                                    <a href="{{$album->cover}}">
                                        <img src="{{$album->cover}}"
                                             alt="" class="show-img">
                                    </a>
                                </p>
                                <input id="cover" name="cover" type="file"
                                       class="file">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-9">
                            <div class="form-group">
                                <label class="form-control-label"
                                       for="images">Images</label>
                                <input id="images" name="images[]" multiple type="file"
                                       class="file">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary update-album-submit" id="form-submit-btn">Save Changes</button>
                </form>
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
                    @forelse($album->image as $image)
                        <div class="col-sm-2 col-md-2 show-page mt-4 mb-4 text-center">
                            <div class="lightgallery">
                                <a href="{{$image->name}}">
                                    <img src="{{$image->name}}"
                                         alt="" class="show-img">
                                </a>
                            </div>
                            <div class="clearfix"></div>
                            <button type="button"
                                    deleteURL="{{ route('album.image.delete',['image'=>$image]) }}"
                                    renderURL="{{route('album.image.ajax',['album'=>$album])}}"
                                    renderType="html"
                                    class="btn btn-danger mt-2 delete-item" {{tooltip('Delete Image')}}>
                                                    <span class="btn-inner--icon"><i
                                                                class="far fa-trash-alt"></i></span>
                            </button>
                        </div>
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

    {{-- File input --}}
    <script type="text/javascript" src="{{asset('admin/vendor/fileinput/fileinput.js')}}"></script>

    <script>
        $(".file").fileinput({
            showUpload: false,
            showRemove: true,
            dropZoneEnabled: false,
            allowedFileExtensions: ["jpg", "png", "gif"],
            autoOrientImage: false,
            maxFileCount: 14,
        });
    </script>
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
