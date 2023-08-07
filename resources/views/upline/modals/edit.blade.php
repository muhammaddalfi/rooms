<div id="modal_edit_upline" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            @csrf
            <div class="modal-body">
                @csrf
                <input type="hidden" id="id_edit_upline">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" id="edit_nama" name="edit_nama" class="form-control">
                            <span id="error_edit_nama" class="text-danger"></span>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="text" id="edit_email" name="edit_email" class="form-control">
                            <span id="error_edit_email" class="text-danger"></span>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Handphone</label>
                            <input type="text" id="edit_handphone" name="edit_handphone" class="form-control">
                            <span id="error_edit_handphone" class="text-danger"></span>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">password</label>
                            <input type="password" id="edit_password" name="edit_password" class="form-control">
                        </div>
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
