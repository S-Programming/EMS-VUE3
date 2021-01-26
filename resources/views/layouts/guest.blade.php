<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'KodeStudio Checkin System') }}</title>
    <meta name="description" content="KodeStudio.net Checking System">
    <meta name="author" content="KodeStudio.net">
    <meta name="robots" content="noindex, nofollow">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

    <!-- CSS Before -->
    @yield('css_before')

    <!-- Fonts and Styles -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ mix('/css/oneui.css') }}" id="css-main">
    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/css/toastr.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">

    <!-- CSS After -->
    @yield('css_after')

    <!-- Required JS -->
    <script>var baseURL = <?php echo json_encode(url('/')); ?>  </script>
    <script>var isUserCheckin = '{{$is_user_checkin??0}}'  </script>
    <script>var userLastCheckinTime = '{{$user_last_checkin??''}}'  </script>
    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>

</head>
<body>
<!-- Page Container -->
<!--
    Available classes for #page-container:

GENERIC

    'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

SIDEBAR & SIDE OVERLAY

    'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
    'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
    'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
    'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
    'sidebar-dark'                              Dark themed sidebar

    'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
    'side-overlay-o'                            Visible Side Overlay by default

    'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

    'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

HEADER

    ''                                          Static Header if no class is added
    'page-header-fixed'                         Fixed Header

HEADER STYLE

    ''                                          Light themed Header
    'page-header-dark'                          Dark themed Header

MAIN CONTENT LAYOUT

    ''                                          Full width Main Content if no class is added
    'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
    'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
-->
<div id="page-container">
    <!-- Main Container -->
    <main id="main-container">
        {{ $slot }}
    </main>
    <!-- END Main Container -->
</div>
<!-- END Page Container -->

<!-- OneUI Core JS -->
<!--
    OneUI JS Core

    Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
    to handle those dependencies through webpack. Please check out assets/_js/main/bootstrap.js for more info.

    If you like, you could also include them separately directly from the assets/js/core folder in the following
    order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

    assets/js/core/jquery.min.js
    assets/js/core/bootstrap.bundle.min.js
    assets/js/core/simplebar.min.js
    assets/js/core/jquery-scrollLock.min.js
    assets/js/core/jquery.appear.min.js
    assets/js/core/js.cookie.min.js
-->
<script src="{{ asset('js/oneui.core.min.js') }}"></script>
<!--
    OneUI JS
    Custom functionality including Blocks/Layout API as well as other vital and optional helpers
    webpack is putting everything together at assets/_js/main/app.js
-->
<script src="{{ mix('/js/oneui.app.js') }}"></script>


<!-- JS Before -->
@yield("js_before")


<!-- Plugins -->
<script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('plugins/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/pages/op_auth_signin.min.js') }}"></script>

<!-- toastr -->
<script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
<!-- custom js -->
<script src="{{ asset('js/custom.js') }}"></script>


@yield('js_after')

<!-- OneUI Helpers (don't replace its position) -->
<script src="{{ asset('js/oneui-helpers.js') }}"></script>

</body>
</html>
