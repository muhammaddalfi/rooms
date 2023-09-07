<div id="modal_enable_permission" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>


            <div class="modal-body">
                @csrf
                <input type="hidden" id="id_pengguna">
                <div class="mb-3">
                    <div class="row">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="cc_ls_c">
                                    <label class="form-check-label" for="cc_ls_c">Create</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="cc_ls_c">
                                    <label class="form-check-label" for="cc_ls_c">Read</label>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="cc_ls_c">
                                    <label class="form-check-label" for="cc_ls_c">Update</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="cc_ls_c">
                                    <label class="form-check-label" for="cc_ls_c">Delete</label>
                                </div>
                            </div>
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
