<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#full') }}"></use>
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#signet') }}"></use>
        </svg>
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.dashboard')"
                :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                icon="c-sidebar-nav-icon cil-speedometer"
                :text="__('Dashboard')" />
        </li>

        @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.access.user.list') ||
                $logged_in_user->can('admin.access.user.deactivate') ||
                $logged_in_user->can('admin.access.user.reactivate') ||
                $logged_in_user->can('admin.access.user.clear-session') ||
                $logged_in_user->can('admin.access.user.impersonate') ||
                $logged_in_user->can('admin.access.user.change-password')
            )
        )
            <li class="c-sidebar-nav-title">@lang('Orders')</li>
            <li class="c-sidebar-nav-item">
                <x-utils.link
                    class="c-sidebar-nav-link"
                    :href="route('admin.order.index')"
                    :active="activeClass(Route::is('admin.order.*'), 'c-active')"
                    icon="c-sidebar-nav-icon cil-speedometer"
                    :text="__('Order Management')" />
            </li>

            <li class="c-sidebar-nav-title">@lang('Service')</li>
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-list"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Service Management')" />

                <ul class="c-sidebar-nav-dropdown-items">
                     <li class="c-sidebar-nav-item">
                         <x-utils.link
                             class="c-sidebar-nav-link"
                             :href="route('admin.services-category.index')"
                             :active="activeClass(Route::is('admin.services-category.*'), 'c-active')"
                             :text="__('Category')" />
                        <x-utils.link
                            class="c-sidebar-nav-link"
                            :href="route('admin.services.index')"
                            :active="activeClass(Route::is('admin.services.*'), 'c-active')"
                            :text="__('Services')" />
                    </li>
                </ul>
            </li>



            <li class="c-sidebar-nav-title">@lang('Messages')</li>

            <li class="c-sidebar-nav-item">
                <x-utils.link
                    :href="route('admin.consultation.index')"
                    :active="activeClass(Route::is('admin.consultation.*'), 'c-active')"
                    class="c-sidebar-nav-link"
                    icon="c-sidebar-nav-icon cil-description"
                    >
                    {{ __('Consultation') }}
                    @if($unread_consultations > 0)
                        <span class="badge text-bg-danger bg-danger">{{ $unread_consultations }}</span>
                    @endif
                </x-utils.link>
            </li>

            <li class="c-sidebar-nav-item">
                <x-utils.link
                    :href="route('admin.contact.index')"
                    class="c-sidebar-nav-link"
                    :active="activeClass(Route::is('admin.contact.*'), 'c-active')"
                    icon="c-sidebar-nav-icon cil-send"
                    >
                    {{ __('Contact Us') }}
                    @if($unread_contacts > 0)
                        <span class="badge text-bg-danger bg-danger">{{ $unread_contacts }}</span>
                    @endif
                </x-utils.link>
            </li>


            <li class="c-sidebar-nav-title">@lang('System')</li>

            <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*'), 'c-open c-show') }}">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-user"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Access')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.user.list') ||
                            $logged_in_user->can('admin.access.user.deactivate') ||
                            $logged_in_user->can('admin.access.user.reactivate') ||
                            $logged_in_user->can('admin.access.user.clear-session') ||
                            $logged_in_user->can('admin.access.user.impersonate') ||
                            $logged_in_user->can('admin.access.user.change-password')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.user.index')"
                                class="c-sidebar-nav-link"
                                :text="__('User Management')"
                                :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                        </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.role.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Role Management')"
                                :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')" />
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if ($logged_in_user->hasAllAccess())
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-list"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Logs')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::dashboard')"
                            class="c-sidebar-nav-link"
                            :text="__('Dashboard')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::logs.list')"
                            class="c-sidebar-nav-link"
                            :text="__('Logs')" />
                    </li>
                </ul>
            </li>
        @endif
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
