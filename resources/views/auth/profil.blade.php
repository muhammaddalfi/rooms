<div id="modal_profile" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>


            <div class="modal-body">
                @csrf
                <input type="hidden" id="id_user" value="{{ auth()->user()->id }}">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                            <span id="error_password" class="text-danger"></span>
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
