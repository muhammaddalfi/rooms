@extends('layouts.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <a href='#' class="btn btn-light add_katdeb" data-toggle="modal" data-target="#modal_katdeb"><i
                                class="ph-plus-circle me-2"></i>Tambah Kategori BadDeb</a>
                    </div>
                    <table class="table datatable-katdeb">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
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
    @include('katdeb.modals.create')
    @include('katdeb.modals.edit')
@endsection
@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/katdeb/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
