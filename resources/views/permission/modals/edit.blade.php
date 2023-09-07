<div id="modal_edit_permission" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>


            <div class="modal-body">
                @csrf
                <input type="hidden" id="id_permission">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="form-label">Role</label>
                            <input type="text" class="form-control" required id="edit_name" name="edit_name">
                            <span id="error_name" class="text-danger"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary save">Save</button>
            </div>
        </div>
    </div>
</div>
