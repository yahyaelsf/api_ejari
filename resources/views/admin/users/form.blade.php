<form action="{{ route('admin.users.store') }}" method="post">

    @csrf

    @isset($user)
        <input type="hidden" name="pk_i_id"  value="{{ $user->getKey() }}"/>
    @endisset

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label">@lang('general.name'):</label>
                <input name="s_name" value="{{ $user->s_name ?? '' }}" type="text" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">@lang('general.username'):</label>
                <input name="s_username" value="{{ $user->s_username ?? '' }}" type="text" class="form-control">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">@lang('general.email'):</label>
                <input name="s_email" value="{{ $user->s_email ?? '' }}" type="text" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">@lang('general.mobile'):</label>
                <input name="s_mobile" value="{{ $user->s_mobile ?? '' }}" type="text" class="form-control">
            </div>
        </div>


        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">@lang('general.address'):</label>
                <input name="s_address" value="{{ $user->s_address ?? '' }}" type="text" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">@lang('general.password'):</label>
                <input name="s_password" type="password" class="form-control">
            </div>
        </div>


        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label">@lang('general.confirm_password'):</label>
                <input name="s_confirm_password" type="password" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-lg-12 col-xl-12">
                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                    <div class="kt-avatar__holder"
                         style="background-image: url({{ $user && $user->s_avatar ?  asset($user->s_avatar) : '' }})"></div>
                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title=""
                           data-original-title="Change avatar">
                        <i class="fa fa-pen"></i>
                        <input type="file" name="s_avatar">
                    </label>
                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title=""
                          data-original-title="Cancel avatar">
                        <i class="fa fa-times"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>



    <hr>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">@lang('buttons.save')</button>
        <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">@lang('buttons.close')</button>
    </div>

</form>

