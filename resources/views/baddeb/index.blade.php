@extends('layouts.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @can('piutang create')
                        <div class="card-body">
                            <a href='#' class="btn btn-light add_beddeb" data-toggle="modal" data-target="#modal_beddeb"><i
                                    class="ph-plus-circle me-2"></i>Tambah Pelanggan</a>

                            <a href='#' class="btn btn-outline-success import_data" data-toggle="modal"
                                data-target="#modal_import_data"><i class="ph-microsoft-excel-logo me-2"></i>Import Data</a>
                        </div>
                    @endcan
                    <table class="table datatable-baddeb">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>ID Pelanggan</th>
                                <th>Layanan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Basic responsive configuration -->



        <!-- /basic responsive configuration -->
    </div>
    @include('baddeb.modals.import')
    @include('baddeb.modals.fu')
    @include('baddeb.modals.create')
    @include('baddeb.modals.edit')
@endsection
@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/baddebt/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
