@extends('layouts.master')

@section('content')
    <div class="content">
        <!-- Basic layout -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Roles</h5>
            </div>
            <div class="card-body border-top">
                <form id="form-role" action="{{ url('role', $role->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Role</label>
                        <input type="hidden" id="id_role" value="{{ $role->id }}">
                        <input type="text" id="role" name="role" class="form-control"
                            value="{{ $role->name }}">
                    </div>

                    <div class="mb-3">
                        @foreach ($permissions as $permission)
                            <div class="col-md-3 mb-1">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                        value="{{ $permission->name }}" id="check-{{ $permission->id }}"
                                        @if ($role->permissions->contains($permission)) checked @endif>
                                    <label class="form-check-label" for="check-{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        {{-- @foreach ($permission as $value)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="akses[]" value="{{ $value->id }}">
                                    {{ $value->name }}
                                </label>
                            </div>
                        @endforeach --}}
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

    {{-- <script src="{{ asset('assets/js/role/index.js') }}"></script> --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
