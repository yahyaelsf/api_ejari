<base href="">
<meta charset="utf-8"/>

<title>{{ config('app.name') }} - @yield('title', $pageTitle ?? '')</title>
<meta name="description" content="@yield('page_description', $pageDescription ?? '')"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

@if(app()->getLocale() == 'ar')
    <link href="{{ asset('dashboard-assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/css/skins/header/base/light.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/css/skins/header/menu/light.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/css/skins/brand/dark.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/css/skins/aside/dark.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
@else
    <link href="{{ asset('dashboard-assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/css/skins/header/base/light.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/css/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/css/skins/brand/dark.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endif


<link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}"/>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">

<link href="{{ asset('dashboard-assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>

@livewireStyles

@stack('css')

{{--<script>--}}
{{--    window._locale = '{{ app()->getLocale() }}';--}}
{{--    window._translations = {!! cache('translations') !!};--}}
{{--</script>--}}
