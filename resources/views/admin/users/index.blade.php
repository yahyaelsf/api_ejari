@extends('admin.layouts.dashboard')
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-list"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    @lang('navigation.users')
                </h3>
            </div>
            {{-- <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">&nbsp;
                        @can('users-store')
                            <a onclick="openModal()" class="btn text-white btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                @lang('buttons.add_new')
                            </a>
                        @endcan
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="kt-portlet__body">
            <form class="report-form" id="filterForm">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>@lang('general.status')</label>
                            {!! Form::select('enabled', [
                                    '' => trans('general.please_choose'),
                                    '1' => trans('general.enabled'),
                                    '0' => trans('general.disabled'),
                               ] , null , ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label>@lang('general.date')</label>
                        <div class="input-group date-picker input-daterange">
                            <input type="text" readonly="readonly" style="background:white;"
                                   class="form-control date_from" name="dt_from_date" value="">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                            </div>
                            <input type="text" readonly="readonly" style="background:white;"
                                   class="form-control date_to" name="dt_to_date" value="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <br>
                            <button type="submit" class="btn btn-primary">@lang('buttons.search')</button>
                            <button type="reset" id="reset"
                                    class="btn btn-danger resetButton"> @lang('buttons.reset')</button>
                        </div>
                    </div>
                </div>

            </form>
            <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
                <thead>
                <tr>
                    <th>#</th>
                    <th width="20%">@lang('general.name')</th>
                    <th>@lang('general.email')</th>
                    <th>@lang('general.status')</th>
                    <th>@lang('general.created_at')</th>
                    <th>@lang('general.updated_at')</th>
                    <th>@lang('general.options')</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection


@push('js')

    <script>
        const table = $('#datatable');
        table.DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.users.data') }}',
            columns: [
                {data: 'pk_i_id'},
                {data: 's_name'},
                {data: 's_email'},
                {data: 'enabled_html', searchable: false, sortable: false, visible: {{ (int) auth()->user()->can('users-status') }}},
                {data: 'dt_created_date'},
                {data: 'dt_modified_date'},
                {
                    data: 'actions_column',
                    searchable: false,
                    sortable: false,
                    responsivePriority: -1,
                    visible: {{ (int) (auth()->user()->can('users-store') || auth()->user()->can('users-delete')) }}
                },
            ]
        });


        function openModal(id = '') {
            $.get('{{ route('admin.users.form') }}?id=' + id, function (data) {
                let modal = $('#form-modal');
                modal.find('.modal-title').html(data.title);
                modal.find('.modal-body').html(data.page);

                let modalForm = $('#form-modal form');

                var KTAvatarDemo = function () {
                    // Private functions
                    var initDemos = function () {
                        var avatar1 = new KTAvatar('kt_user_avatar_1');
                    }

                    return {
                        init: function () {
                            initDemos();
                        }
                    };
                }();

                KTUtil.ready(function () {
                    KTAvatarDemo.init();
                });


                const submitButton = modalForm.find(':button[type=submit]');
                const spinnerClasses = "kt-spinner kt-spinner--left kt-spinner--sm kt-spinner--light";

                modalForm.submit(function (e) {
                    e.preventDefault();
                    submitButton.prop('disabled', true);
                    submitButton.addClass(spinnerClasses);
                }).validate({
                    submitHandler: function (form) {
                        const data = new FormData(form);
                        const action = $('form').attr('action');

                        $.ajax({
                            url: action,
                            type: "POST",
                            data: data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (data) {
                                console.log(data);

                                if (data.success) {
                                    modal.modal('hide');
                                    $('#datatable').DataTable().ajax.reload(null, false);
                                    $('form').find("input[type=text],input[type=file],textarea").val("");
                                    $('form').validate().resetForm();
                                    $('form').find('form-group').removeClass('has-error');
                                    toastr.success(data.message, {timeOut: 5000});
                                    $('#validation-errors').empty();
                                } else {
                                    validationErrors(data.errors);
                                    submitButton.prop('disabled', false);
                                    submitButton.removeClass(spinnerClasses);
                                }
                            }
                        });
                    }
                });


                modal.modal('show');
            });

        }

    </script>
@endpush
