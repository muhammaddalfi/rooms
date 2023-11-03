<div id="modal_beddeb" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-beddeb" enctype="multipart/form-data" action="#" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" required id="nama" name="nama">
                                <span id="error_nama" class="text-danger"></span>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">ID Pelanggan</label>
                                <input type="text" class="form-control" required id="id_pln" name="id_pln">
                                <span id="error_id_pln" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" required id="telp" name="telp">
                                <span id="error_telp" class="text-danger"></span>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">NIK</label>
                                <input type="text" class="form-control" required id="nik" name="nik">
                                <span id="error_nik" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Layanan</label>
                                <select class="form-control select_layanan" name="select_layanan" id="select_layanan"
                                    data-minimum-results-for-search="Infinity" data-fouc>
                                    <option></option>
                                    <option value="10">10 Mbps</option>
                                    <option value="20">20 Mbps</option>
                                    <option value="35">35 Mbps</option>
                                    <option value="50">50 Mbps</option>
                                    <option value="100">100 Mbps</option>
                                </select>
                                <span id="error_select_layanan" class="text-danger"></span>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Jumlah Tagihan</label>
                                <input type="text" class="form-control" required id="tagihan" name="tagihan">
                                <span id="error_tagihan" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">Alamat</label>
                                <textarea rows="3" id="alamat" name="alamat" cols="3" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="save">
                        Simpan
                    </button>
                </div>
        </div>
    </div>
</div>
