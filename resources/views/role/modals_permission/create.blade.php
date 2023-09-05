<div id="modal_permission" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-permission" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">Permission</label>
                                <input type="text" class="form-control" required id="name" name="name">
                                <span id="error_name" class="text-danger"></span>
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
