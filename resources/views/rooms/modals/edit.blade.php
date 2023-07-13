<div id="modal_edit_cyberkey" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Ubah Cyberkey</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            @csrf
            <input type="hidden" id="id_serial_number">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Serial Number</label>
                            <input type="text" id="edit_serial_number" name="edit_serial_number"
                                class="form-control">
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary update">Simpan</button>
            </div>
        </div>
    </div>
</div>
