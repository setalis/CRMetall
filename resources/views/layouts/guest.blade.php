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

    <!-- Volt CSS -->
    {{--        <link type="text/css" href="../../../css/volt.css" rel="stylesheet">--}}

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

    <!-- Scripts -->

</head>
    <body class="font-sans text-gray-900 antialiased">
        {{ $slot }}
{{--        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">--}}
{{--            <div>--}}
{{--                <a href="/">--}}
{{--                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--                </a>--}}
{{--            </div>--}}

{{--            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">--}}
{{--                {{ $slot }}--}}
{{--            </div>--}}
{{--        </div>--}}
    </body>
</html>
