@extends('logged-users.layouts.app')

@section('style')
    {{-- File input--}}
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendor/fileinput/fileinput.css')}}">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="{{asset('admin/vendor/bootstrap-select/bootstrap-select.min.css')}}">
@endsection

@section('breadcrumbs', Breadcrumbs::render('createAlbum'))

@section('content')
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">{{$pageTitle}}</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" id="create-album-form" action="{{route('album.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Name</label>
                            <input name="name" type="text" value="{{old('name')}}"
                                   class="form-control"
                                   id="name" placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label" for="type">Type</label>
                            <select id="type" class="form-control selectpicker show-tick"
                                    data-title="Please Select Type" name="type">
                                <option value="public" {{select_input_val('public', old('type'))}}>Public</option>
                                <option value="private" {{select_input_val('private', old('type'))}}>private</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="notes">Notes</label>
                            <input name="notes" type="text" value="{{old('notes')}}"
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
                <button type="submit" class="btn btn-primary create-album-submit" id="form-submit-btn">Save</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
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
