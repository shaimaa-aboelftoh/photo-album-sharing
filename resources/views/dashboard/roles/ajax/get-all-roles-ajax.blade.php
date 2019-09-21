<table class="table text-center table-striped table-bordered dataTable"
       style="width:100%">
    <thead>
    <tr>
        <th>#</th>
        <th>Role Name</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($roles as $key => $role )
        <tr id="row_{{$role['id']}}">
            <th class="text-center">
                {{$key+1}}
            </th>
            <th>{{$role->display_name}}</th>
            <th>{{str_limit($role->description,30)}}</th>
            <th>
                @if(auth()->user()->can(['show-role']))
                    <a href="{{route('dashboard.role.show',['role'=>$role])}}"
                       class="btn btn-primary btn-icon-only rounded-circle" {{tooltip('Show Role')}}>
                                                            <span class="btn-inner--icon"><i
                                                                        class="far fa-eye"></i></span>
                    </a>
                @endif
                @if(!in_array($role->id,[1,2]))
                    @if(auth()->user()->can(['edit-role']))
                        <a href="{{route('dashboard.role.edit',['role'=>$role])}}"
                           class="btn btn-success btn-icon-only rounded-circle" {{tooltip('Update Role')}}>
                                                            <span class="btn-inner--icon"><i
                                                                        class="far fa-edit"></i></span>
                        </a>
                    @endif
                    @if(auth()->user()->can(['delete-role']))
                        <button type="button"
                                deleteURL="{{ route('dashboard.role.delete',['role'=>$role]) }}"
                                renderURL="{{ route('dashboard.role.ajax') }}"
                                class="btn btn-danger btn-icon-only rounded-circle delete-item"{{tooltip('Delete Role')}}>
                                                    <span class="btn-inner--icon"><i
                                                                class="far fa-trash-alt"></i></span>
                        </button>
                    @endif
                @endif
            </th>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>Role Name</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    </tfoot>
</table>
