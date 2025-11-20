

<li class="kt-menu__item {{ request()->routeIs($route) ? 'kt-menu__item--active' : ''  }}" aria-haspopup="true">
    <a href="{{  route($route)  }}" class="kt-menu__link">
        <span class="kt-menu__link-icon">
            {{ $slot }}
        </span>
        <span class="kt-menu__link-text">{{ $name }}</span>
    </a>
</li>
