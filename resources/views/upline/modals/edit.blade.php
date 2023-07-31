<div id="modal_edit_user" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            @csrf
            <div class="modal-body">
                @csrf
                <input type="hidden" id="id_edit_pengguna">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" id="edit_nama" name="edit_nama" placeholder="Muhammad Alfi"
                                class="form-control">
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="text" id="edit_email" name="edit_email" placeholder="alfi@cyberkey.id"
                                class="form-control">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Divisi</label>
                            <select class="form-control select" id="edit_divisi" name="edit_divisi"
                                data-minimum-results-for-search="Infinity">
                                <option value="opharset">Opharset</option>
                                <option value="aktivasi">Aktivasi</option>
                                <option value="pembangunan">Pembangunan</option>
                                <option value="retail">Retail</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Handphone</label>
                            <input type="text" id="edit_handphone" name="edit_handphone"
                                placeholder="+99-99-9999-9999" data-mask="+99-99-9999-9999" class="form-control">
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btn_edit_ubah">Simpan</button>
            </div>
        </div>
    </div>
</div>
