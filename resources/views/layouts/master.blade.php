<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Monster Jabar - Monitoring Sales Untuk Cluster</title>

    <!-- Global stylesheets -->
    <link href="{{ asset('assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/ltr/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->


    <style>
        #map {
            height: 300px;
        }
    </style>
    <style>
        #spinner {
            display: none;
        }
    </style>

    <link href="{{ asset('assets/js/vendor/leaflet/css/leaflet.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/loading_ajax/loading.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sweet_alert/sweetalert.css') }}" rel="stylesheet">
    <!-- Theme JS files -->

    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <!-- Core JS files -->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- /core JS files -->

    @stack('js_page')
    <script src="{{ asset('assets/js/loading_ajax/loading.js') }}"></script>

    <!-- /theme JS files -->



</head>

<body>
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    <!-- Main navbar -->
    @include('layouts.navbar')
    <!-- /main navbar -->

    <!-- Page content -->
    <div class="page-content">


        <!-- Main sidebar -->
        @include('layouts.sidebar')
        <!-- /main sidebar -->

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            @yield('content')
            <!-- /content area -->
        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->


    <!-- Footer -->
    @include('layouts.footer')
    <!-- /footer -->

</body>

</html>
