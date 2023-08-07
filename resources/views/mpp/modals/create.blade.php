<div id="modal_mpp" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">MPP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-mpp" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="form-label">Nama Perusahaan</label>
                                <input type="text" id="nama" name="nama" class="form-control">
                                <span id="error_name" class="text-danger"></span>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">Email Perusahaan</label>
                                <input type="text" id="email" name="email" class="form-control">
                                <span id="error_email" class="text-danger"></span>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">No. Telp</label>
                                <input type="text" id="hp" name="hp" class="form-control">
                                <span id="error_hp" class="text-danger"></span>
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
<!-- /vertical form modal -->
