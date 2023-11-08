@extends('layouts.master')

@section('content')
    <div class="content">
        <div class="mb-3">
            <div class="row">
                <div id="map"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button href='' class="btn btn-light add" data-toggle="modal" data-target="#modal_pm"><i
                                class="ph-plus-circle me-2"></i>Tambah
                            Jadwal PM</button>
                    </div>
                    <table class="table datatable-pm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>OLT</th>
                                <th>FEEDER</th>
                                <th>FDT</th>
                                <th>FAT</th>
                                <th>Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('pm.modals.fat')
    @include('pm.modals.fdt')
    @include('pm.modals.feeder')
    @include('pm.modals.create')
    @include('pm.modals.olt')
@endsection
@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/leaflet/js/leaflet.js') }}"></script>
    <script src="{{ asset('assets/js/pm/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
