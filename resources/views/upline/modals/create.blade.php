<div id="modal_upline" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Upline</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-upline" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" placeholder="Muhammad Alfi"
                                    class="form-control">
                                <span id="error_nama" class="text-danger"></span>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">Email</label>
                                <input type="text" id="email" name="email"
                                    placeholder="muhammad.ramadhan@iconpln.co.id" class="form-control">
                                <span id="error_email" class="text-danger"></span>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">No. Whatsapp</label>
                                <input type="text" id="hp" name="hp" placeholder="08116565xxx"
                                    class="form-control">
                                <span id="error_hp" class="text-danger"></span>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="save" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /vertical form modal -->
