<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid bg-sidebar">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true"
            data-kt-menu-expand="false">
            @foreach(config('sidebar-menu') as $menu)
                @if($menu->items)
                    @can($menu->permission)
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                        @foreach($menu->items as $item)
                            {{ Request::routeIs($item->route) ? 'show' : '' }}
                        @endforeach">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="{{ $menu->icon }}"></i>
                            </span>
                            <span class="menu-title">{{ $menu->label }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion ">
                            @foreach($menu->items as $menuItem)
                                @can($menuItem->permission)
                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs($menuItem->route) ? 'disable-link active' : '' }}" href="{{ route($menuItem->route) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                        <span class="menu-title">{{ $menuItem->label }}</span>
                                    </a>
                                </div>
                                @endcan
                            @endforeach
                        </div>
                    </div>
                    @endcan
                @else
                    @can($menu->permission)
                    <div class="menu-item">
                        <a class="menu-link {{ Request::routeIs($menu->route) ? 'disable-link active' : '' }}" href="{{ route($menu->route) }}">
                    <span class="menu-icon">
                        <i class="{{ $menu->icon }}"></i>
                    </span>
                            <span class="menu-title">{{ $menu->label }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    @endcan
                @endif
            @endforeach
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
