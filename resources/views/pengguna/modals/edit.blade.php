<div id="modal_edit_pengguna" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            @csrf
            <div class="modal-body">
                @csrf
                <input type="hidden" id="id_pengguna">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" id="edit_nama_pengguna" name="edit_nama_pengguna"
                                class="form-control">
                            <span id="error_edit_nama_pengguna" class="text-danger"></span>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="text" id="edit_email_pengguna" name="edit_email_pengguna"
                                class="form-control">
                            <span id="error_edit_email_pengguna" class="text-danger"></span>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Nomor WhatsApp</label>
                            <input type="text" id="edit_hp_pengguna" name="edit_hp_pengguna" class="form-control">
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
                        <select multiple ="multiple" class="form-control edit_role" name="edit_role[]" id="edit_role">
                            <option></option>
                            @foreach ($role as $item)
                                <option value="{{ $item->id }}"> {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        <span id="error_role" class="text-danger"></span>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success update">Simpan</button>
            </div>
        </div>
    </div>
</div>
