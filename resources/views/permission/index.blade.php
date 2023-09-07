@extends('layouts.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <a href='#' class="btn btn-light add_permission" data-toggle="modal"
                            data-target="#modal_permission"><i class="ph-plus-circle me-2"></i>Tambah Permission</a>
                    </div>
                    <table class="table datatable-permission">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Permission</th>
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
    @include('permission.modals.create')
    @include('permission.modals.edit')
@endsection
@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/permission/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
