{!! Form::open(['route' => 'admin.roles.process','files' => false])!!}

@isset($role)
    <input type="hidden" name="pk_i_id" value="{{ $role->getKey() }}"/>
@endisset

<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label">@lang('general.display_name'):</label>
            <input name="display_name" value="{{ $role->display_name ?? '' }}" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label">@lang('general.name'):</label>
            <input name="name" value="{{ $role->name ?? '' }}" type="text" class="form-control" {{ $role ?'readonly': '' }}>
        </div>
    </div>
</div>

<div class="row">
    @foreach($basicPermissions as $basicPermission)
        <div class="col-md-4 permission-type-block">
            <label>
                <input class="checkboxes" type="checkbox"/>
                {{ $basicPermission->display_name }}
            </label>
            <div class="child-permissions">
                @if($basicPermission->children())
                    @foreach($basicPermission->children as $childPermission)
                        <lablel>
                            <input name="permissions[]"
                                   type="checkbox"
                                   class="child_permission"
                                   value="{{ $childPermission->id }}"
                                {{ isset($role) ? $role->hasPermissionTo($childPermission->name) ? 'checked' : '' : '' }} />
                            {{$childPermission->display_name}}
                        </lablel><br>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach
</div>
<hr>

<div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">@lang('buttons.save')</button>
    <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">@lang('buttons.close')</button>
</div>

{!! Form::close() !!}

