<!DOCTYPE html>
<html lang="en"
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
      direction="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
      style="direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }};">

<head>
    @include('admin.partials._head')
</head>w


<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed  kt-aside--enabled kt-aside--fixed ">


<div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="{{ route('admin.home')}}">
            <img alt="Logo" src="{{ asset('dashboard/media/logos/logo.svg') }}"/>
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler">
            <span></span></button>
        <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                class="flaticon-more"></i></button>
    </div>
</div>

<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        @include('admin.partials._sidebar')
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed align-items-center">

                <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                    <div id="kt_header_menu"
                         class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">

                    </div>
                </div>
                <div class="kt-header__topbar">
{{--                    <div class="kt-header__topbar-item kt-header__topbar-item--langs">--}}
{{--                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">--}}
{{--                            <span class="kt-header__topbar-icon">--}}

{{--                                @if(app()->getLocale() == 'en')--}}
{{--                                <img class="" src="{{ asset('dashboard-assets/media/flags/226-united-states.svg') }}" alt=""/>--}}
{{--                                @endif--}}

{{--                                @if(app()->getLocale() == 'ar')--}}
{{--                                    <img class="" src="{{ asset('dashboard-assets/media/flags/133-saudi-arabia.svg') }}"--}}
{{--                                         alt=""/>--}}
{{--                                @endif--}}

{{--                            </span>--}}
{{--                        </div>--}}
{{--                        <div--}}
{{--                            class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">--}}
{{--                            <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">--}}

{{--                                <li class="kt-nav__item {{ app()->getLocale() == 'ar' ? 'kt-nav__item--active' : '' }}">--}}
{{--                                    <a href="{{ route('admin.change-localization', ['language' =>  'ar']) }}" class="kt-nav__link">--}}
{{--                                        <span class="kt-nav__link-icon">--}}
{{--										<img class="" src="{{ asset('dashboard-assets/media/flags/133-saudi-arabia.svg') }}"--}}
{{--                                             alt=""/>--}}
{{--                                        </span>--}}
{{--                                        <span class="kt-nav__link-text">@lang('general.ar')</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}

{{--                                <li class="kt-nav__item {{ app()->getLocale() == 'en' ? 'kt-nav__item--active' : '' }}">--}}
{{--                                    <a href="{{ route('admin.change-localization', ['language' =>  'en']) }}" class="kt-nav__link">--}}
{{--                                        <span class="kt-nav__link-icon">--}}
{{--										<img class="" src="{{ asset('dashboard-assets/media/flags/226-united-states.svg') }}"--}}
{{--                                             alt=""/>--}}
{{--                                        </span>--}}
{{--                                        <span class="kt-nav__link-text">@lang('general.en')</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}

{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="kt-header__topbar-item kt-header__topbar-item--user">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                            <div class="kt-header__topbar-user">
                                <span class="kt-header__topbar-welcome kt-hidden-mobile">@lang('general.hi'),</span>
                                <span
                                    class="kt-header__topbar-username kt-hidden-mobile">{{ auth('admin')->user()->s_name ?? '' }}</span>
                                <img class="kt-hidden" alt="Pic" src="assets/media/users/300_25.jpg"/>
                                <span
                                    class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">S</span>
                            </div>
                        </div>
                        <div
                            class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                            <div class="kt-notification">
                                <div class="kt-notification__custom kt-space-between">
                                    <a href="{{ route('admin.logout') }}"
                                       class="btn btn-label btn-label-brand btn-sm btn-bold">
                                        @lang('buttons.logout')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                    @include('admin.partials._flash_messages')
                    @include('admin.partials._errors')
                    @yield('content')
                </div>
            </div>

{{--            @include('admin.partials._footer')--}}
        </div>
    </div>
</div>

<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

@include('admin.partials._javascript')

</body>
</html>
