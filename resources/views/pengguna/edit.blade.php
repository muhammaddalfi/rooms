@extends('layouts.master')

@section('content')
    <div class="content">
        <!-- Basic layout -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Roles</h5>
            </div>
            <div class="card-body border-top">
                <form id="form-edit-pengguna" action="{{ url('/pengguna/update', $users->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="hidden" id="id_pengguna" value="{{ $users->id }}">
                                <input type="text" id="edit_nama_pengguna" name="edit_nama_pengguna" class="form-control"
                                    value="{{ $users->name }}">
                                <span id="error_edit_nama_pengguna" class="text-danger"></span>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Email</label>
                                <input type="text" id="edit_email_pengguna" name="edit_email_pengguna"
                                    class="form-control" value="{{ $users->email }}">
                                <span id="error_edit_email_pengguna" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Nomor WhatsApp</label>
                                <input type="text" id="edit_hp_pengguna" name="edit_hp_pengguna" class="form-control"
                                    value="{{ $users->handphone }}">
                                <span id="error_edit_hp_pengguna" class="text-danger"></span>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">password</label>
                                <input type="password" id="edit_password_pengguna" name="edit_password_pengguna"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Role</label>
                            <select multiple="multiple" class="form-control edit_role" name="edit_role[]" id="edit_role">
                                <option></option>
                                @foreach ($role as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $users->roles->contains($item->id) ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="error_role" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
    <script src="{{ asset('assets/js/pengguna/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
