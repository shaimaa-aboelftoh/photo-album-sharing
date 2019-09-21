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