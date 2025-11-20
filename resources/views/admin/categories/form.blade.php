<form action="{{ route('admin.categories.store') }}" method="post">

    @csrf

    @isset($category)
        <input type="hidden" name="pk_i_id" value="{{ $category->getKey() }}" />
    @endisset

    {{-- <x-localizable-inputs :inputs="$inputs" :item="$category">
    </x-localizable-inputs> --}}


        <div class="form-group">
            <label class="form-control-label">الإسم:</label>
            <input name="s_name" value="{{ old('s_name', isset($category) ? $category->s_name : '') }}" type="text" class="form-control">
        </div>






    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">@lang('buttons.save')</button>
        <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">@lang('buttons.close')</button>
    </div>

</form>
