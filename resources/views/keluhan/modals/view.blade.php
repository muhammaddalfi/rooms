<div id="modal_view" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Keluhan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <input type="hidden" id="id_keluhan">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>:</td>
                                            <td id="view_tanggal"></td>
                                        </tr>

                                        <tr>
                                            <td>Nama Pelaksana</td>
                                            <td>:</td>
                                            <td id="view_nama"></td>
                                        </tr>

                                        <tr>
                                            <td>Nama OLT</td>
                                            <td>:</td>
                                            <td id="view_nama_olt"></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Keluhan</td>
                                            <td>:</td>
                                            <td id="view_jenis_keluhan"></td>
                                        </tr>
                                        <tr>
                                            <td>Ketagori Dinas</td>
                                            <td>:</td>
                                            <td id="view_kategori_dinas"></td>
                                        </tr>
                                        <tr>
                                            <td>Catatan</td>
                                            <td>:</td>
                                            <td id="view_catatan"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-img-actions mx-1 mt-1">
                                <img class="card-img img-fluid" id="gambar_bukti" src="" alt="">
                                <div class="card-img-actions-overlay card-img">
                                    <a href="" id="gambar_bukti_link"
                                        class="btn btn-outline-white btn-icon rounded-pill" data-bs-popup=""
                                        data-gallery="">
                                        <i class="ph-plus"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex align-items-start flex-nowrap">
                                    <div>
                                        <div class="fw-semibold me-2" id="judul">Bukti Keluhan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
