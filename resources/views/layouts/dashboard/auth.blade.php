<!DOCTYPE html>
<html class="loading"
    @if (Config::get('app.locale') == 'ar') lang="ar" data-textdirection="rtl" @else  lang="en" data-textdirection="ltr" @endif>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="PIXINVENT">
    <title>
        {!! __('dashboard.dashboard') !!} | @yield('title')
    </title>
    <link rel="apple-touch-icon" href="{!! asset('assets/dashbaord') !!}/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('assets/dashbaord') !!}/images/ico/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord') !!}/fonts/line-awesome/css/line-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord') !!}/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord') !!}/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" type="text/css"
        href="{!! asset('assets/dashbaord') !!}/css-rtl/core/menu/menu-types/vertical-menu-modern.css">


    @if (Config::get('app.locale') == 'ar')
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord') !!}/css-rtl/vendors.css">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord') !!}/css-rtl/app.css">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord') !!}/css-rtl/custom-rtl.css">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord') !!}/css-rtl/core/colors/palette-gradient.css">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord') !!}/css-rtl/pages/login-register.css">
        {{-- <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord') !!}/css/style-rtl.css"> --}}
        <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet" />
        <style>
            body,
            html {
                font-family: "Poppins", "ArbFONTSBEINNormalAR", sans-serif;
                font-weight: normal;
                font-style: normal;
            }
        </style>
    @else
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord') !!}/css/vendors.css">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord') !!}/css/app.css">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord') !!}/css/core/colors/palette-gradient.css">
        <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord') !!}/css/pages/login-register.css">
    @endif

    <link rel="stylesheet" type="text/css" href="{!! asset(path: 'assets/dashbaord/css/my-style.css') !!}">


</head>

<body class="vertical-layout vertical-menu-modern 1-column bg-lighten-2 menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="1-column">
    <!-- fixed-top ////////////////////////////////////////////////////////////////////////////-->

    <nav
        class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-border navbar-shadow">

        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li class="nav-item text-bold-800 " style="justify-content : end">
                <a class="nav-link me-2  text-info" style="justify-content : center" hreflang="{{ $localeCode }}"
                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    @if ($localeCode != Lang())
                        <span style="padding: 10px ;font-size: 16px; font-weight: 700; ">
                            {{ $properties['native'] }} <i class="la la-flag"></i>
                        </span>
                    @endif
                </a>
            </li>
        @endforeach
    </nav>
    <!-- content ////////////////////////////////////////////////////////////////////////////-->
    @yield('content')

    <!-- footer ////////////////////////////////////////////////////////////////////////////-->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow"
        style="  margin-right: 0px !important; margin-top: -12px;">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block">{!! __('dashboard.copyright') !!} &copy;
                {!! date('Y') !!} <a class="text-bold-800 grey darken-2" href="#"
                    target="_blank">{!! setting()->site_name !!}
                </a>, {!! __('dashboard.all_rights_reserved') !!}. </span>
        </p>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="{!! asset('assets/dashbaord') !!}/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{!! asset('assets/dashbaord') !!}/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript">
    </script>
    <script src="{!! asset('assets/dashbaord') !!}/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <!-- BEGIN MODERN JS-->
    <script src="{!! asset('assets/dashbaord') !!}/js/core/app-menu.js" type="text/javascript"></script>
    <script src="{!! asset('assets/dashbaord') !!}/js/core/app.js" type="text/javascript"></script>
    <script src="{!! asset('assets/dashbaord') !!}/js/scripts/customizer.js" type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{!! asset('assets/dashbaord') !!}/js/scripts/forms/form-login-register.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    {!! NoCaptcha::renderJs() !!}

</body>

</html>
