<div id="modal_olt" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Nama OLT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-olt" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">Nama OLT</label>
                                <input type="text" class="form-control" required id="nama_olt" name="nama_olt">
                                <span id="error_nama_olt" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Latitude</label>
                                <input type="text" class="form-control" required id="lat" name="lat">
                                <span id="error_lat" class="text-danger"></span>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Longitude</label>
                                <input type="text" class="form-control" required id="lng" name="lng">
                                <span id="error_lng" class="text-danger"></span>
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
