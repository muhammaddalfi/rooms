@extends('layouts.master')

@section('content')
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <a href='#' class="btn btn-light add_mpp" data-toggle="modal" data-target="#modal_mpp"><i
                            class="ph-plus-circle me-2"></i>Data Perusahaan</a>
                </div>
                <table class="table datatable-perusahaan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Perusahaan</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Anggota</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <table class="table datatable-anggota-perusahaan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Marketer</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>PIC</th>
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
    @include('mpp.modals.create')
    @include('mpp.modals.anggota')
    @include('mpp.modals.edit_anggota')
    @include('mpp.modals.edit')
@endsection

@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/mpp/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
