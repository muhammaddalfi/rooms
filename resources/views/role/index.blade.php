@extends('layouts.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a href='{{ route('role.create') }}' class="btn btn-teal"><i class="ph-plus-circle me-2"></i>Tambah
                            Role</a>
                    </div>
                    <table class="table datatable-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Role</th>
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
    </div>
@endsection
@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/role/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    {{-- <script>
        @if (session()->has('success'))
            
        @endif
    </script> --}}
@endpush
