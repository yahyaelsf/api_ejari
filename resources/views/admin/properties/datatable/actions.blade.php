@can('contacts-view')
    <a class="btn btn-sm btn-icon btn-info btn-flat view_message text-white" data-id="{{$row->pk_id}}"
       data-message="{{ json_encode($row) }}">
        <i class="fa fa-eye"></i>
    </a>
@endcan

@can('contacts-delete')
    <a type="button" onclick="deleteItem({{ $row->getKey() }})"
       class="btn btn-sm btn-icon btn-danger btn-sm text-white">
        <i class="la la-trash"></i>
    </a>
@endcan
