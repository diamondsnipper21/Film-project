<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('title')
    <link rel="stylesheet" type="text/css" href="/home/css/bootstrap.min.css">

    <link rel="stylesheet" href="/home/css/plugins.css">
    <link rel="stylesheet" href="/home/css/main.css">
    <link rel="stylesheet" href="/home/css/themes.css">
    <link rel="stylesheet" href="/home/custom/app.css">

    <script src="/home/js/vendor/modernizr-2.7.1-respond-1.4.2.min.js"></script>
    <script src="/home/js/vuejs/vue.min.js"></script>
    @yield('style')

</head>
<body>
    <div id="page-container">
        @include('layouts.home.header')

        @yield('content')
    </div>

    @include('layouts.home.footer')

    <!-- Scripts -->
    <script src="/home/js/vendor/jquery-1.11.1.min.js"></script>

    <script src="/home/js/vendor/bootstrap.min.js"></script>
    <script src="/home/js/plugins.js"></script>
    <script src="/home/js/app.js"></script>

    @yield('script')
</body>
</html>
