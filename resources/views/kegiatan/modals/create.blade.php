<div id="modal_activity" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jenis Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-activity" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">Jenis Kegiatan</label>
                                <input type="text" class="form-control" required id="jenis_kegiatan"
                                    name="jenis_kegiatan">
                                <span id="error_name" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
