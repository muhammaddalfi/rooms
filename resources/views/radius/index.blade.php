@extends('layouts.master')

@section('content')
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="alert alert-warning alert-icon-start alert-dismissible fade show">
            <span class="alert-icon bg-warning text-white">
                <i class="ph-warning-circle"></i>
            </span>
            <span class="fw-semibold">Peringatan!</span> contoh pengisian radius map :
            <br> Jika radius <b>1KM</b> maka penulisannya <b>1.0</b><br>
            Jika radius <b>500M</b> maka penulisanya <b>0.5</b>
        </div>
        <div class="card">
            <table class="table datatable-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pengaturan</th>
                        <th>Radius</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <!-- /basic responsive configuration -->
    </div>
    @include('radius.modals.create')
    @include('radius.modals.edit')
@endsection
@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/radius/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
