<div id="modal_anggota_perusahaan" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Marketer Perusahaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-anggota-perusahaan" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <input type="hidden" id="id_perusahaan" name="id_perusahaan" class="form-control">
                            <input type="hidden" id="nama_perusahaan" name="nama_perusahaan" class="form-control">
                            <div class="col-sm-4">
                                <label class="form-label">Nama Marketer</label>
                                <input type="text" id="nama_anggota_perusahaan" name="nama_anggota_perusahaan"
                                    class="form-control">
                                <span id="error_name" class="text-danger"></span>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">Email</label>
                                <input type="text" id="email_anggota_perusahaan" name="email_anggota_perusahaan"
                                    class="form-control">
                                <span id="error_email" class="text-danger"></span>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">No. Telp</label>
                                <input type="text" id="hp_anggota_perusahaan" name="hp_anggota_perusahaan"
                                    class="form-control">
                                <span id="error_hp" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="save_anggota" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /vertical form modal -->
