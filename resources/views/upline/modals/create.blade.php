<div id="modal_leader" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sales</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-leader" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" id="nama_leader" name="nama_leader" class="form-control">
                                <span id="error_nama_leader" class="text-danger"></span>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">Email</label>
                                <input type="text" id="email_leader" name="email_leader" class="form-control">
                                <span id="error_email_leader" class="text-danger"></span>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">No. Handphone</label>
                                <input type="text" id="handphone_leader" name="handphone_leader"
                                    class="form-control">
                                <span id="error_handphone_leader" class="text-danger"></span>
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
