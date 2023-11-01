@extends('layouts.master')

@section('content')
    <div class="content">
        <!-- Basic layout -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Tambah Roles</h5>
            </div>
            <div class="card-body border-top">
                <form id="form-role">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Role</label>
                        <input type="text" id="role" name="role" class="form-control">
                    </div>


                    <div class="row mb-3">
                        @foreach ($permission as $value)
                            <div class="col-md-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="akses[]" value="{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary" id="save">Simpan></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /basic layout -->
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
@endpush
