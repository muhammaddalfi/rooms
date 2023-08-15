<div id="modal_edit_leader" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            @csrf
            <div class="modal-body">
                @csrf
                <input type="hidden" id="id_leader">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Nama PIC</label>
                            <input type="text" id="edit_nama_leader" name="edit_nama_leader" class="form-control">
                            <span id="error_edit_nama_leader" class="text-danger"></span>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="text" id="edit_email_leader" name="edit_email_leader" class="form-control">
                            <span id="error_edit_email_leader" class="text-danger"></span>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Handphone</label>
                            <input type="text" id="edit_handphone_leader" name="edit_handphone_leader"
                                class="form-control">
                            <span id="error_edit_handphone_leader" class="text-danger"></span>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">password</label>
                            <input type="password" id="edit_password_leader" name="edit_password_leader"
                                class="form-control">
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
