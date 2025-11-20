@extends('admin.layouts.dashboard')
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-list"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    @lang('navigation.properties')
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form class="report-form" id="filterForm">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>@lang('general.status')</label>
                            {!! Form::select('seen', [
                                    '' => trans('general.please_choose'),
                                    '1' => trans('general.seen'),
                                    '0' => trans('general.unseen'),
                               ] , null , ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>@lang('general.type')</label>
                            {!! Form::select('type', [
                                    '' => trans('general.please_choose'),
                                    App\Enums\ContactEnums::CONTACT => trans('general.contact'),
                                    App\Enums\ContactEnums::SUGGESTION => trans('general.suggestion'),
                                    App\Enums\ContactEnums::COMPLAINT => trans('general.complaint'),
                                    App\Enums\ContactEnums::ANOTHER => trans('general.another'),
                               ] , null , ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label>@lang('general.date')</label>
                        <div class="input-group date-picker input-daterange">
                            <input type="text" readonly="readonly" style="background:white;" class="form-control date_from" name="dt_from_date" value="">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                            </div>
                            <input type="text" readonly="readonly" style="background:white;" class="form-control date_to" name="dt_to_date" value="">
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
                    <th width="20%">الرقم المرجعي</th>
                    <th dir="ltr">القسم</th>
                    <th>مقدم الطلب</th>
                    <th>@lang('general.created_at')</th>
                    <th>@lang('general.status')</th>
                    <th>@lang('general.options')</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Message</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tr>
                            <td width="25%">الرقم المرجعي:</td>
                            <td class="message-reference-number"></td>
                        </tr>
                        <tr>
                            <td width="25%">إسم مقدم الطلب:</td>
                            <td class="message-user" dir="ltr"></td>
                        </tr>
                         <tr>
                            <td width="10%">القسم:</td>
                            <td class="message-category"></td>
                        </tr>
                        <tr>
                            <td width="10%">السعر:</td>
                            <td class="message-price"></td>
                        </tr>
                         <tr>
                            <td width="10%">المساحة:</td>
                            <td class="message-area"></td>
                        </tr>
                         <tr>
                            <td width="10%">عدد أفراد العائلة:</td>
                            <td class="message-family"></td>
                        </tr>
                         <tr>
                            <td width="10%">عدد الغرف:</td>
                            <td class="message-rooms"></td>
                        </tr>
                         <tr>
                            <td width="10%">عدد الحمامات:</td>
                            <td class="message-bathrooms"></td>
                        </tr>
                         <tr>
                            <td width="10%">عدد الدواوين:</td>
                            <td class="message-lounges"></td>
                        </tr>
                        <tr>
                            <td width="10%"> الطابق:</td>
                            <td class="message-floors"></td>
                        </tr>
                        <tr>
                            <td width="10%"> التاثيث:</td>
                            <td class="message-furnished"></td>
                        </tr>
                         <tr>
                            <td width="10%"> الحالة:</td>
                            <td class="message-status"></td>
                        </tr>
                        <tr>
                            <td width="10%"> التشطيب والجودة:</td>
                            <td class="message-finishing-quality"></td>
                        </tr>
                        <tr>
                            <td width="10%">  المميزات:</td>
                            <td class="message-additional-features"></td>
                        </tr>
                        <tr>
                            <td width="10%">  المنطقة المحيطة:</td>
                            <td class="message-surrounding-area"></td>
                        </tr>
                        <tr>
                            <td width="10%">الشروط المطلوبة:</td>
                            <td class="message-conditions"></td>
                        </tr>

                        <tr>
                            <td width="10%">الوصف:</td>
                            <td class="message-details"></td>
                        </tr>
                         <tr>
                            <td width="10%">@lang('general.sent_at'):</td>
                            <td class="message-date"></td>
                        </tr>



                        <tr class="message-image" style="display: none">
                            <td width="10%">@lang('general.image'):</td>
                            <td>
                                <img width="100%" class="image-src" src=""/>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        @lang('buttons.close')
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('js')

    <script>


        $(document).on('click', '.view_message', function () {
            let message = JSON.parse($(this).attr('data-message'));

            console.log('message', message);

            let modal = $('#messageModal');
            modal.find('.modal-title').text(message.s_reference_number);
            modal.find('.message-reference-number').text(message.s_reference_number);
            modal.find('.message-user').text(message.user.s_name);
            modal.find('.message-category').text(message.category.s_name);
            modal.find('.message-price').text(message.n_price);
            modal.find('.message-area').text(message.s_area);
            modal.find('.message-family').text(message.n_family_members);
            modal.find('.message-rooms').text(message.n_rooms);
            modal.find('.message-bathrooms').text(message.n_bathrooms);
            modal.find('.message-lounges').text(message.n_lounges);
            modal.find('.message-floors').text(message.s_floors);
            modal.find('.message-additional-features').text(message.s_additional_features);
            modal.find('.message-surrounding-area').text(message.s_surrounding_area);
            modal.find('.message-details').text(message.s_description);
            modal.find('.message-conditions').text(message.s_conditions);
            modal.find('.message-date').text(message.dt_created_date);

            let furnished = '';

            if(message.e_furnished == "Unfurnished") {
                furnished = "{{ trans('general.Unfurnished') }}";
            }

            if(message.e_furnished == "Semi-furnished") {
                furnished = "{{ trans('general.Semi-furnished') }}";
            }

            if(message.e_furnished == "Furnished") {
                furnished = "{{ trans('general.Furnished') }}";
            }

            modal.find('.message-furnished').text(furnished);


            let status = '';

            if(message.e_status == "new") {
                status = "{{ trans('general.new') }}";
            }

            if(message.e_status == "uses") {
                status = "{{ trans('general.uses') }}";
            }

            modal.find('.message-status').text(status);

            let finishing_quality = '';

            if(message.e_finishing_quality == "Deluxe") {
                finishing_quality = "{{ trans('general.Deluxe') }}";
            }

            if(message.e_finishing_quality == "Normal") {
                finishing_quality = "{{ trans('general.Normal') }}";
            }

            modal.find('.message-finishing-quality').text(finishing_quality);

            $('#toggleReadStatus').attr('data-id', message.pk_i_id);



            modal.modal('show');
        });




        const table = $('#datatable');
        table.DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.properties.data') }}',
            columns: [
                {data: 'pk_i_id'},
                {data: 's_reference_number'},
                {data: 'category.s_name'},
                {data: 'user.s_name'},
                {data: 'dt_created_date'},
                {data: 'enabled_html', name: "b_seen", searchable: false},
                {data: 'actions_column', searchable: false, sortable: false, responsivePriority: -1},
            ]
        });

        $(document).on('click','#exportBtn',function (e) {
            let _href = $(this).data('href');
            let formData = $('#filterForm').serialize();
            $(this).attr('href',_href+ '?' + formData);
        })
    </script>
@endpush
