{{--@can('permissions-store')--}}
    <a onclick="openModal({{ $row->getKey() }})" type="button" class="btn btn-success btn-sm btn-icon text-white">
        <i class="la la-edit"></i>
    </a>
{{--@endcan--}}

{{--@can('permissions-delete')--}}
    <a type="button" onclick="deleteItem({{ $row->getKey() }})" class="btn btn-danger btn-sm btn-icon text-white">
        <i class="la la-trash"></i>
    </a>
{{--@endcan--}}
