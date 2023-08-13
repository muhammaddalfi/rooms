<div id="modal_radius" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengaturan Radius</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-radius" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="form-label">Nama Setting</label>
                                <input type="text" class="form-control" required id="nama_setting"
                                    name="nama_setting">
                                <span id="error_nama_setting" class="text-danger"></span>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">Value</label>
                                <input type="text" class="form-control" required id="value_setting"
                                    name="value_setting">
                                <span id="error_value_setting" class="text-danger"></span>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Kode Setting</label>
                                <input type="text" class="form-control" required id="kode_setting"
                                    name="kode_setting">
                                <span id="error_kode_setting" class="text-danger"></span>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="save" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
