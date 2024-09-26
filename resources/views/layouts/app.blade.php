<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="">
        <meta name="description" content="">
        <meta name="keywords" content="" />

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="canonical" href="">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="120x120" href="../assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../../../assets/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../../assets/img/favicon/favicon-16x16.png">
        <link rel="manifest" href="../../../assets/img/favicon/site.webmanifest">
        <link rel="mask-icon" href="../../../assets/img/favicon/safari-pinned-tab.svg" color="#ffffff">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="theme-color" content="#ffffff">
        @vite(['resources/css/app.css', 'resources/css/volt.css', 'resources/js/app.js'])
        <!-- Sweet Alert -->
        <link type="text/css" href="../../../vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

        <!-- Notyf -->
        <link type="text/css" href="../../../vendor/notyf/notyf.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <!-- Volt CSS -->
{{--        <link type="text/css" href="../../../css/volt.css" rel="stylesheet">--}}

        <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

        <!-- Scripts -->

    </head>
    <body>
    @include('layouts.navbar-dark')
    @include('layouts.sidebar')

    <!-- Page Content -->
    <main class="content">
        @include('layouts.navbar')
        {{ $slot }}
{{--        @include('layouts.footer')--}}
    </main>

    <!-- Core -->
    <script src="/vendor/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Vendor JS -->
    <script src="../../../vendor/onscreen/dist/on-screen.umd.min.js"></script>

    <!-- Slider -->
{{--    <script src="../../../vendor/nouislider/distribute/nouislider.min.js"></script>--}}

    <!-- Smooth scroll -->
    <script src="../../../vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    <!-- Charts -->
    <script src="../../../vendor/chartist/dist/chartist.min.js"></script>
    <script src="../../../vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>

    <!-- Datepicker -->
    <script src="../../../vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

    <!-- Sweet Alerts 2 -->
    <script src="../../../vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Vanilla JS Datepicker -->
    <script src="../../../vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

    <!-- Notyf -->
    <script src="../../../vendor/notyf/notyf.min.js"></script>

    <!-- Simplebar -->
    <script src="../../../vendor/simplebar/dist/simplebar.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>


    <!-- Volt JS -->
    <script src="../../../assets/js/volt.js"></script>

    </body>
</html>
