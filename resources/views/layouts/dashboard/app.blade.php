<!DOCTYPE html>
<html class="loading"
    @if (Config::get('app.locale') == 'ar') lang="ar" data-textdirection="rtl" @else  lang="en" data-textdirection="ltr" @endif>

<head>
    @include('layouts.dashboard.app-parts._head')
    @stack('style')
    {{-- @livewireStyles --}}
</head>

<body class="vertical-layout vertical-menu-modern 2-columns  menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">


    @include('layouts.dashboard.app-parts._header')
    @include('layouts.dashboard.app-parts._sidebar')

    @yield('content')

    @include('layouts.dashboard.app-parts._footer')

    @include('layouts.dashboard.app-parts._scripts')
    @stack('scripts')
    {{-- @livewireScripts --}}
</body>

</html>
