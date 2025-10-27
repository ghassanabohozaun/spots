    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow expanded" data-scroll-to-active="true">
        <div class="main-menu-content">

            <!-- begin: Dashboard -->
            <ul class="navigation navigation-main mt-1">
                <li class=" nav-item @if (Request::is('*welcome*')) active @endif">
                    <a href="{!! route('dashboard.index') !!}">
                        <i class="icon-home"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">{!! __('dashboard.dashboard') !!}</span>
                        {{-- <span class="badge badge badge-info badge-pill float-right mr-2">3</span> --}}
                    </a>
                </li>
            </ul>
            <!-- end: Dashboard -->



            <!-- begin: settings -->
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item">
                    <a href="#">
                        <i class="icon-settings"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">{!! __('dashboard.settings') !!}</span>
                        {{-- <span class="badge badge badge-info badge-pill float-right mr-2">3</span> --}}
                    </a>
                    <!-- begin: settings -->
                    <ul class="menu-content">
                        @can('settings')
                            <li class="@if (str_contains(url()->current(), 'settings')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.settings.index') !!}" data-i18n="nav.dash.settings">
                                    {!! __('settings.settings') !!}
                                </a>
                            </li>
                        @endcan

                        @can('sliders')
                            <li class="@if (str_contains(url()->current(), 'sliders')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.sliders.index') !!}" data-i18n="nav.dash.sliders">
                                    {!! __('sliders.sliders') !!}
                                </a>
                            </li>
                        @endcan
                        @can('pages')
                            <li class="@if (str_contains(url()->current(), 'pages')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.pages.index') !!}" data-i18n="nav.dash.pages">
                                    {!! __('pages.pages') !!}
                                </a>
                            </li>
                        @endcan

                    </ul>
                    <!-- end: settings -->
                </li>
            </ul>
            <!-- end: settings -->


            <!-- begin: roles -->
            @can('roles')
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class=" nav-item">
                        <a href="#">
                            <i class="icon-lock"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">{!! __('dashboard.roles') !!}</span>
                            {{-- <span class="badge badge badge-info badge-pill float-right mr-2">3</span> --}}
                        </a>
                        <!-- begin: roles -->
                        <ul class="menu-content">
                            <li class="@if (str_contains(url()->current(), 'roles')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.roles.index') !!}" data-i18n="nav.dash.roles">
                                    {!! __('roles.roles') !!}
                                </a>

                            </li>
                        </ul>
                        <!-- end: roles -->
                    </li>
                </ul>
            @endcan
            <!-- end: roles -->

            <!-- begin: admins -->
            @can('admins')
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class=" nav-item">
                        <a href="#">
                            <i class="icon-user"></i>
                            <span class="menu-title" data-i18n="nav.dash.admins">{!! __('dashboard.admins') !!}</span>
                            {{-- <span class="badge badge badge-info badge-pill float-right mr-2">{!! $admins_count !!}</span> --}}
                        </a>
                        <!-- begin: admins -->
                        <ul class="menu-content">
                            <li class="@if (str_contains(url()->current(), 'admins')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.admins.index') !!}" data-i18n="nav.dash.admins">
                                    {!! __('admins.admins') !!}
                                </a>

                            </li>
                        </ul>
                        <!-- end: admins -->
                    </li>
                </ul>
            @endcan
            <!-- end: admins -->


            <!-- begin: users -->
            @can('users')
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class=" nav-item">
                        <a href="#">
                            <i class="icon-users"></i>
                            <span class="menu-title" data-i18n="nav.dash.users">{!! __('dashboard.users') !!}</span>
                            {{-- <span class="badge badge badge-info badge-pill float-right mr-2">{!! $users_count !!}</span> --}}
                        </a>
                        <!-- begin: users -->
                        <ul class="menu-content">
                            <li class="@if (str_contains(url()->current(), 'users')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.users.index') !!}" data-i18n="nav.dash.users">
                                    {!! __('users.users') !!}
                                </a>

                            </li>
                        </ul>
                        <!-- end: users -->
                    </li>
                </ul>
            @endcan
            <!-- end: users -->

            <!-- begin: world -->
            @can('world')
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class=" nav-item">
                        <a href="#">
                            <i class="icon-flag"></i>
                            <span class="menu-title" data-i18n="nav.dash.brand">{!! __('dashboard.world') !!}</span>
                            {{-- <span class="badge badge badge-info badge-pill float-right mr-2">3</span> --}}
                        </a>

                        <ul class="menu-content">
                            <!-- begin: countries -->
                            <li class="@if (str_contains(url()->current(), 'countries')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.countries.index') !!}" data-i18n="nav.dash.countries">
                                    {!! __('world.countries') !!}
                                </a>
                            </li>
                            <!-- end: countries -->

                            <!-- begin: cities -->
                            <li class="@if (str_contains(url()->current(), 'cities')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.cities.index') !!}" data-i18n="nav.dash.cities">
                                    {!! __('world.cities') !!}
                                </a>
                            </li>
                            <!-- end: cities -->

                        </ul>

                    </li>
                </ul>
            @endcan
            <!-- end: world -->


            <!-- begin: tickets -->
            @can('tickets')
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class=" nav-item">
                        <a href="#">
                            <i class="icon-wallet"></i>
                            <span class="menu-title" data-i18n="nav.dash.tickets">{!! __('dashboard.tickets') !!}</span>
                            {{-- <span class="badge badge badge-info badge-pill float-right mr-2">{!! $tickets_count !!}</span> --}}
                        </a>
                        <!-- begin: tickets -->
                        <ul class="menu-content">
                            <li class="@if (str_contains(url()->current(), 'tickets')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.tickets.index') !!}" data-i18n="nav.dash.tickets">
                                    {!! __('tickets.tickets') !!}
                                </a>
                            </li>
                        </ul>
                        <!-- end: tickets -->
                    </li>
                </ul>
            @endcan
            <!-- end: tickets -->

            <!-- begin: tours -->
            @can('tours')
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class=" nav-item">
                        <a href="#">
                            <i class="icon-paper-plane"></i>
                            <span class="menu-title" data-i18n="nav.dash.tours">{!! __('dashboard.tours') !!}</span>
                            {{-- <span class="badge badge badge-info badge-pill float-right mr-2">{!! $tours_count !!}</span> --}}
                        </a>
                        <!-- begin: tours -->
                        <ul class="menu-content">
                            <li class="@if (str_contains(url()->current(), 'tours')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.tours.index') !!}" data-i18n="nav.dash.tours">
                                    {!! __('tours.tours') !!}
                                </a>
                            </li>
                        </ul>
                        <!-- end: tours -->
                    </li>
                </ul>
            @endcan
            <!-- end: tours -->


            <!-- begin: flights -->
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item">
                    <a href="#">
                        <i class="icon-plane"></i>
                        <span class="menu-title" data-i18n="nav.dash.flights">{!! __('dashboard.flights') !!}</span>
                        {{-- <span class="badge badge badge-info badge-pill float-right mr-2">{!! $flights_count !!}</span> --}}
                    </a>
                    <!-- begin: flights -->
                    <ul class="menu-content">
                        @can('flights')
                            <li class="@if (str_contains(url()->current(), 'flights')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.flights.index') !!}" data-i18n="nav.dash.flights">
                                    {!! __('flights.flights') !!}
                                </a>
                            </li>
                        @endcan

                        @can('categories')
                            <li class="@if (str_contains(url()->current(), 'categories')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.categories.index') !!}" data-i18n="nav.dash.categories">
                                    {!! __('categories.categories') !!}
                                </a>
                            </li>
                        @endcan
                    </ul>
                    <!-- end: flights -->
                </li>
            </ul>
            <!-- end: flights -->

            <!-- begin: mailing -->
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item">
                    <a href="#">
                        <i class="icon-envelope"></i>
                        <span class="menu-title" data-i18n="nav.dash.mailing">{!! __('dashboard.mailing') !!}</span>
                        {{-- <span class="badge badge badge-info badge-pill float-right mr-2">{!! $mailing_count !!}</span> --}}
                    </a>
                    <!-- begin: mailing -->
                    <ul class="menu-content">
                        @can('mailing')
                            <li class="@if (str_contains(url()->current(), 'mailing')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.mailing.index') !!}" data-i18n="nav.dash.mailing">
                                    {!! __('mailing.mailing') !!}
                                </a>
                            </li>
                        @endcan
                    </ul>
                    <!-- end: mailing -->
                </li>
            </ul>
            <!-- end: mailing -->

            <!-- begin: notifications -->
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item">
                    <a href="#">
                        <i class="ficon ft-bell"></i>
                        <span class="menu-title" data-i18n="nav.dash.notifications">{!! __('dashboard.notifications') !!}</span>
                        {{-- <span class="badge badge badge-info badge-pill float-right mr-2">{!! $notifications_count !!}</span> --}}
                    </a>
                    <!-- begin: notifications -->
                    <ul class="menu-content">
                        @can('notifications')
                            <li class="@if (str_contains(url()->current(), 'notifications')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.notifications.index') !!}" data-i18n="nav.dash.notifications">
                                    {!! __('notifications.notifications') !!}
                                </a>
                            </li>
                        @endcan
                    </ul>
                    <!-- end: notifications -->
                </li>
            </ul>
            <!-- end: notifications -->



        </div>
    </div>
