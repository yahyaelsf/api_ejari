@extends('admin.layouts.dashboard')
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-list"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    @lang('navigation.edit_account')
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form action="{{ route('admin.update_account') }}" method="post">

                @csrf

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">@lang('general.name'):</label>
                            <input name="s_name" value="{{ $admin->s_name ?? '' }}" type="text" class="form-control">
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">@lang('general.email'):</label>
                            <input name="s_email" value="{{ $admin->s_email ?? '' }}" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">@lang('general.mobile'):</label>
                            <input name="s_mobile" value="{{ $admin->s_mobile ?? '' }}" type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">



                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">@lang('general.address'):</label>
                            <input name="s_address" value="{{ $admin->s_address ?? '' }}" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('general.timezone')</label>
                            <select name="s_timezone" class="custom-select" required>
                                @foreach($timezones as $timezone)
                                    <option @if(($currentTimezone == $timezone)) selected
                                            @endif value="{{ $timezone }}">
                                        {{ $timezone }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">@lang('general.password'):</label>
                            <input name="s_password" type="password" class="form-control">
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">@lang('general.confirm_password'):</label>
                            <input name="s_confirm_password" type="password" class="form-control">
                        </div>
                    </div>
                </div>


                <hr>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">@lang('buttons.save')</button>
                    <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">@lang('buttons.close')</button>
                </div>

            </form>

        </div>
    </div>
@endsection


