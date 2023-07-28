@extends('layouts.master')

@section('content')
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="card">

            <div class="card-body">


                <div class="fullcalendar-basic"></div>
            </div>
        </div>
        <!-- /basic responsive configuration -->
    </div>
    @include('calendars.modals.create')
@endsection
@push('js_page')
    <script src="{{ asset('assets/js/vendor/ui/fullcalendar/main.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/index.js') }}"></script>
@endpush
