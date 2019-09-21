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
