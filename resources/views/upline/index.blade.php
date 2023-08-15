@extends('layouts.master')

@section('content')
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <a href='#' class="btn btn-light add_leader_internal" data-toggle="modal"
                        data-target="#modal_leader_internal"><i class="ph-plus-circle me-2"></i>Data PIC Internal</a>
                </div>
                <table class="table datatable-leader">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>PIC Internal</th>
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
                <table class="table datatable-anggota-leader">
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
    @include('upline.modals.create')
    @include('upline.modals.anggota')
    @include('upline.modals.edit_anggota')
    @include('upline.modals.edit')
@endsection

@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/upline/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
