<div id="modal_edit_radius" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Pengaturan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>


            <div class="modal-body">
                @csrf
                <input type="hidden" id="id_radius">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-4">
                            <label class="form-label">Nama Setting</label>
                            <input type="text" class="form-control" required id="edit_nama_setting"
                                name="edit_nama_setting">
                            <span id="error_nama_setting" class="text-danger"></span>
                        </div>

                        <div class="col-sm-4">
                            <label class="form-label">Value Setting</label>
                            <input type="text" class="form-control" required id="edit_value_setting"
                                name="edit_value_setting">
                            <span id="error_value_setting" class="text-danger"></span>
                        </div>

                        <div class="col-sm-4">
                            <label class="form-label">Kode Setting</label>
                            <input type="text" class="form-control" required id="edit_kode_setting"
                                name="edit_kode_setting">
                            <span id="error_kode_setting" class="text-danger"></span>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success save">Simpan</button>
            </div>
        </div>
    </div>
</div>
