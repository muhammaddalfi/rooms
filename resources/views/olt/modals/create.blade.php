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
                            <div class="col-sm-6">
                                <label class="form-label">Nama OLT</label>
                                <input type="text" class="form-control" required id="nama_olt" name="nama_olt">
                                <span id="error_name" class="text-danger"></span>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Prioritas</label>
                                <select class="form-control prioritas" required name="prioritas" id="prioritas"
                                    data-minimum-results-for-search="Infinity" data-fouc>
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
