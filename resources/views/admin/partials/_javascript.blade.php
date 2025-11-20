<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };
</script>


<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('dashboard-assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
<script src="{{ asset('dashboard-assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('dashboard-assets/js/pages/crud/file-upload/ktavatar.js') }}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="{{ asset('dashboard-assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"
        type="text/javascript"></script>
<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
<script src="{{ asset('dashboard-assets/plugins/custom/gmaps/gmaps.js') }}" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('dashboard-assets/plugins/custom/datatables/datatables.bundle.js') }}"
        type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"
        type="text/javascript"></script>
<script>

    let arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }


    function loadSwitches() {
        if ($('.js-switch').length > 0) {
            $('body').on('change', '.js-switch', function () {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let elementId = $(this).data('id');
                let isFrequent = $(this).data('value');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('admin.home') }}/" + "{{ request()->segment(2) }}" + '/update_status',
                    data: {'enabled': status, 'id': elementId, 'frequent': isFrequent},
                    success: function (data) {
                        console.log(data.message);
                    }
                });
            });
        }
    }

    openSidebarTree();

    function openSidebarTree() {
        $('.kt-menu__item--submenu').each(function (index) {
            const submenu = $(this);
            const isActive = submenu.find('.kt-menu__submenu ul li ').hasClass('kt-menu__item--active');

            if (isActive) {
                submenu.addClass('kt-menu__item--open');
                console.log('submenu index', index);
            }

        })
    }


    $.extend(true, $.fn.dataTable.defaults, {
        @if(app()->getLocale() == "ar")
        "language": {
            "url": "{{ asset('dashboard-assets/js/arabic-datatable.json') }}"
        },
        @endif
        "columnDefs": [{
            "targets": '_all',
            "defaultContent": "",
            "className": 'text-center'
        }],
        "order": [[0, "DESC"]],
        "initComplete": function (settings, json) {
            loadSwitches();
        }
    });


    loadSwitches();

    $.validator.setDefaults({
        ignore: ":hidden",
        errorPlacement: function (error, element) {
            var group = element.closest('.input-group');
            if (group.length) {
                group.after(error.addClass('invalid-feedback'));
            } else {
                element.after(error.addClass('invalid-feedback'));
            }
        },
        invalidHandler: function (event, validator) {
            var alert = $('#kt_form_1_msg');
            alert.removeClass('kt--hide').show();
            KTUtil.scrollTop();
            $('.modal-body').scrollTop(50);
        },
        errorElement: 'span',
        errorClass: 'validation-error-message help-block form-helper',
        highlight: function (element) {
            $(element).parent().addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).parent().removeClass('has-error');
        },

    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });

    @if(app()->getLocale() === 'ar')

    $.extend($.validator.messages, {
        required: "هذا الحقل مطلوب.",
        remote: "العنصر موجود مسبقاً.",
        email: "الرجاء إدخال بريد صحيح.",
        url: "الرجاء إدخال رابط صحيح.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "الرقم غير صحيح.",
        digits: "مسموع أرقام فقط.",
        equalTo: "الرجاء إدخال نفس القيمة مرة أخرى.",
        accept: "الرجاء إدخال صيغة مقبولة.",
        maxlength: $.validator.format("الرجاء ادخال قيمة اقل من {0} رمز."),
        minlength: $.validator.format("الرجاء ادخال قيمة اكبر من {0} رمز."),
        rangelength: $.validator.format("Please enter a value between {0} and {1} characters long."),
        range: $.validator.format("Please enter a value between {0} and {1}."),
        max: $.validator.format("الرجاء ادخال قيمة اقل من {0}."),
        min: $.validator.format("Please enter a value greater than or equal to {0}.")
    });
    @endif



    function validationErrors(errors, type = "modal") {
        if (errors) {

            let validationBlock = '<div id="validation-errors" class="flex-column validation-errors" role="alert">'
                + '<h6>' + 'الرجاء تعديل الأخطاء' + '</h6>'
                + '<ul class="list-unstyled">';

            for (let i = 0; i < errors.length; i++) {
                validationBlock += '<li>' + errors[i] + '</li>';
            }
            validationBlock += '</ul>';

            let validationErrors = $('#validation-errors');

            if (validationErrors.length) {
                validationErrors.replaceWith(validationBlock)
            } else {
                if (type == "modal") {
                    $(document).find('#form-modal').find('.modal-body').prepend(validationBlock);
                } else {
                    $(document).find('.alert-section').append(validationBlock);
                }
            }
        }
    }


    if (jQuery().datepicker) {
        $('.date-picker').datepicker({
            autoclose: true,
            rtl: false,
            format: 'yyyy-mm-dd',
            maxDate: new Date(),
            orientation: "bottom right" // left bottom of the input field
        });
    }

    var resetButton = $('#filterForm button[type=reset]');
    @if(Route::has(currentSectionData()))
    $('#filterForm').submit(function (e) {
        e.preventDefault();
        let formData = $('#filterForm').serialize();
        console.log('formData', formData);
        $('#datatable').DataTable().ajax.url("{{ route(currentSectionData()) }}" + '?' + formData).load();
        resetButton.show();
    });
    @endif

    $('#filterForm').on('reset', function () {
        $(".user_select").val('').trigger('change');
        $(".multiple-select").val('').trigger('change');
        $(".subscription-select").val('').trigger('change');
        setTimeout(function () {
            $('#filterForm').submit();
            resetButton.hide();
        }, 1);
    });

    function deleteItem(item, path = "{{ request()->segment(2) }}") {
        swal.fire({
            title: "{{ trans('alerts.you_sure') }}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ trans('general.yes') }}',
            cancelButtonText: '{{ trans('general.no') }}'
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: "delete",
                    dataType: 'json',
                    url: "{{ route('admin.home') }}/" + path + '/' + item,
                    data: {_token: '{{ csrf_token() }}', id: item},
                    success: function (data) {
                        if (data.success) {
                            swal.fire({
                                confirmButtonText: "@lang('general.yes')",
                                title: "{{ trans('alerts.successfully_deleted') }}",
                                type: 'success'
                            });
                            $('#datatable').DataTable().ajax.reload(null, false);

                        } else {
                            swal.fire({
                                confirmButtonText: "@lang('buttons.close')",
                                title: data.message,
                                type: 'error'
                            });
                        }

                    }
                });
            }
        });
    }

    $(window).on('load', function () {
        if ($('select[name="datatable_length"]').length > 0) {
            $('select[name="datatable_length"]').change();
        }
    });


</script>

@livewireScripts
@stack('js')
