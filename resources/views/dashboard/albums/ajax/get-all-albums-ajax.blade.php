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
