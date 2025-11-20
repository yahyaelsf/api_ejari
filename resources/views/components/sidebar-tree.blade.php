<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
        <span class="kt-menu__link-icon">
            <span class="svg-icon svg-icon-primary svg-icon-2x">
                {{ $icon }}
            </span>
        </span>
        <span class="kt-menu__link-text">{{ $name }}</span>
        <i class="kt-menu__ver-arrow la la-angle-right"></i>
    </a>
    <div class="kt-menu__submenu ">
        <span class="kt-menu__arrow"></span>
        <ul class="kt-menu__subnav">
            {{ $slot }}
        </ul>
    </div>
</li>
