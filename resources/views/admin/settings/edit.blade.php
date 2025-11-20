@extends('admin.layouts.dashboard')
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                @lang('navigation.settings')
            </h3>
            <div class="card-toolbar">
                <div class="example-tools justify-content-center">
                    <span class="example-toggle" data-toggle="tooltip" title="" data-original-title="View code"></span>
                    <span class="example-copy" data-toggle="tooltip" title="" data-original-title="Copy code"></span>
                </div>
            </div>
        </div>

        <div class="card-body">
            {!! Form::open(['route' => 'admin.settings.update', 'id' => 'form','files' => true])!!}
            <div class="form-body">
                <div class="row">
                    <div class="col-md-8">

                    </div>
                    @foreach($settingsConfig as $key => $setting)
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label($key, trans($setting['localization_key']), ['class' => 'control-label']) !!}
                                @if($setting['type'] == \SettingsEnums::STRING)
                                    {!! Form::text($key,  $settings[$key] ?? $setting['default_value'], ["class" => 'form-control']) !!}
                                @elseif($setting['type'] == \SettingsEnums::BOOLEAN)
                                    {!! Form::select($key, ['' => __('general.please_choose'), '1' => __('general.active'), '0' => __('general.inactive')],  $settings[$key] ?? $setting['default_value'], ["class" => 'form-control']) !!}
                                @elseif($setting['type'] == \SettingsEnums::TEXT)
                                    {!! Form::textarea($key, $settings[$key] ?? $setting['default_value'], ["class" => 'form-control', 'rows' => 5]) !!}
                                @elseif($setting['type'] == \SettingsEnums::FILE)
                                    {!! Form::file($key, null, ["class" => 'form-control']) !!}
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">@lang('buttons.save')</button>
            <a href="{{ route('admin.home') }}" class="btn btn-secondary">@lang('buttons.close')</a>
        </div>
        {!! Form::close() !!}

    </div>

@endsection

@push('scripts-footer')
    <script src="{{ asset('assets/validation/dist/jquery.validate.js') }}"></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script>
        $.validator.setDefaults({
            errorClass: 'help-block',
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            }
        });

        $('#form').validate();
    </script>
@endpush
