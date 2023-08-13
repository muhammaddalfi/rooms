@extends('layouts.master')

@section('content')
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="card">
            <div class="card-body">
                <a href='#' class="btn btn-light add_olt" data-toggle="modal" data-target="#modal_olt"><i
                        class="ph-plus-circle me-2"></i>Tambah Nama OLT</a>
            </div>
            <table class="table datatable-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama OLT</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <!-- /basic responsive configuration -->
    </div>
    @include('olt.modals.create')
    @include('olt.modals.edit')
@endsection
@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/olt/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
