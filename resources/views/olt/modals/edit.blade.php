<div id="modal_edit_olt" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Nama OLT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>


            <div class="modal-body">
                @csrf
                <input type="hidden" id="id_olt">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Nama OLT</label>
                            <input type="text" class="form-control" required id="edit_nama_olt" name="edit_nama_olt">
                            <span id="error_name" class="text-danger"></span>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Prioritas</label>
                            <select class="form-control edit_prioritas" required name="edit_prioritas"
                                id="edit_prioritas" data-minimum-results-for-search="Infinity" data-fouc>
                                <option value="P1">P1</option>
                                <option value="P2">P2</option>
                                <option value="P3">P3</option>
                                <option value="P4">P4</option>
                                <option value="P5">P5</option>
                            </select>
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
