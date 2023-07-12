<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rooms Meeting Management</title>

    <!-- Global stylesheets -->
    <link href="{{ asset('assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/ltr/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    @can('admin read')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
            integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

        <style>
            #map {
                height: 400px;
            }
        </style>
    @endcan

    @can('ptl read')
        <style>
            #spinner {
                display: none;
            }
        </style>
        <style>
            .datepicker {
                z-index: 2000 !important
            }
        </style>
    @endcan

    <!-- Theme JS files -->

    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <!-- Core JS files -->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

    @stack('js_page')
    <!-- /theme JS files -->


</head>

<body>

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
