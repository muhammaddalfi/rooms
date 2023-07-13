@extends('layouts.master')

@section('content')
    <div class="content">
        <!-- Basic responsive configuration -->

        <div class="card">
            <div class="card-body">
                <a href='#' class="btn btn-light add_rooms" data-toggle="modal" data-target="#modal_rooms"><i
                        class="ph-plus-circle me-2"></i>Add Rooms</a>
            </div>
            <table class="table datatable-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Rooms</th>
                        <th>Capacity</th>
                        <th>Facility</th>
                        <th>Images</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- /basic responsive configuration -->
    </div>
    @include('rooms.modals.create')
@endsection
@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/rooms/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
