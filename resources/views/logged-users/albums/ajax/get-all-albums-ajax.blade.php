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
