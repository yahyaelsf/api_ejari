{!! Form::open(['route' => 'admin.permissions.process','files' => false])!!}

@isset($permission)
    <input type="hidden" name="pk_i_id" value="{{ $permission->getKey() }}"/>
@endisset


<div class="form-group">
    <label class="form-control-label">@lang('general.display_name'):</label>
    <input name="display_name" value="{{ $permission->display_name ?? '' }}" type="text" class="form-control">
</div>

<div class="form-group">
    <label class="form-control-label">@lang('general.name'):</label>
    <input name="name" value="{{ $permission->name ?? '' }}" type="text"
           class="form-control" {{ $permission ?'readonly': '' }}>
</div>

<div class="form-group">
    <label class="form-control-label">@lang('general.parent'):</label>
    {{ Form::select('parent_id', $parents , $permission->parent_id ?? '', ['class' => 'form-control']) }}
</div>

<div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">@lang('buttons.save')</button>
    <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">@lang('buttons.close')</button>
</div>

{!! Form::close() !!}

