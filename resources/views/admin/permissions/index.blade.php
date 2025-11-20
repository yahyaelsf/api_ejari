@extends('admin.layouts.dashboard')
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-list"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    @lang('navigation.permissions')
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @can('permissions-store')
                            <a onclick="openModal()" class="btn text-white btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                @lang('buttons.add_new')
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
                <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>@lang('general.display_name')</th>
                    <th>@lang('general.name')</th>
                    <th width="20%">@lang('general.options')</th>
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
            ajax: '{{ route('admin.permissions.data') }}',
            columns: [
                {data: 'id'},
                {data: 'display_name'},
                {data: 'name'},
                {data: 'actions_column', responsivePriority: -1, sortable: false},
            ]
        });


        function openModal(id = '') {
            $.get('{{ route('admin.permissions.form') }}?id=' + id, function (data) {
                let modal = $('#form-modal');
                // modal.find('.modal-dialog').removeClass('modal-lg');
                modal.find('.modal-title').html(data.title);
                modal.find('.modal-body').html(data.page);
                let modalForm = $('#form-modal form');

                modalForm.submit(function (e) {
                    e.preventDefault();
                }).validate({
                    rules: {
                        name: {
                            required: true
                        },

                    },
                    submitHandler: function (form) {
                        const data = new FormData($('form')[0]);
                        const action = $('form').attr('action');

                        $.ajax({
                            url: action,
                            type: "POST",
                            data: data,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                if (data.success) {
                                    modal.modal('hide');
                                    $('#datatable').DataTable().ajax.reload(null, false);
                                    $('form').find("input[type=text],input[type=file],textarea").val("");
                                    $('form').validate().resetForm();
                                    $('form').find('form-group').removeClass('has-error');
                                    toastr.success(data.message, {timeOut: 5000});
                                } else {
                                    validationErrors(data.errors);
                                }
                            },
                            error: function (danger) {
                                console.log(danger);
                            }
                        });
                    }
                });
                modal.modal('show');
            });

        }

    </script>
@endpush
