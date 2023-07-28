@extends('layouts.master')

@section('content')
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="mb-3">
            <div class="row">
                <div id="map"></div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <a href='#' class="btn btn-light add_rooms" data-toggle="modal" data-target="#modal_daily"><i
                            class="ph-plus-circle me-2"></i>Tambah Dokumentasi Harian</a>
                </div>
                <table class="table datatable-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama OLT</th>
                            <th>Kegiatan</th>
                            <th>Gambar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- /basic responsive configuration -->
    </div>
    @include('rooms.modals.create')
    @include('rooms.modals.edit')
    @include('rooms.modals.view')
@endsection
@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/leaflet/js/leaflet.js') }}"></script>
    <script src="{{ asset('assets/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/media/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/rooms/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
