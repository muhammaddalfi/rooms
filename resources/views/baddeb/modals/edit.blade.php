<div id="modal_edit_beddeb" class="modal fade">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pelanggan Bad Debt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-beddeb" enctype="multipart/form-data" action="#" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="form-label">Nama Pelanggan</label>
                                        <input type="text" class="form-control" required id="edit_nama"
                                            name="edit_nama">
                                        <span id="error_edit_nama" class="text-danger"></span>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">ID PLN</label>
                                        <input type="text" class="form-control" required id="edit_id_pln"
                                            name="edit_id_pln">
                                        <span id="error_edit_id_pln" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" required id="edit_telp"
                                            name="edit_telp">
                                        <span id="error_edit_telp" class="text-danger"></span>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">NIK</label>
                                        <input type="text" class="form-control" required id="edit_nik"
                                            name="edit_nik">
                                        <span id="error_edit_nik" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="form-label">Layanan</label>
                                        <select class="form-control edit_select_layanan" name="edit_select_layanan"
                                            id="edit_select_layanan" data-minimum-results-for-search="Infinity"
                                            data-fouc>
                                            <option value="10">10 Mbps</option>
                                            <option value="20">20 Mbps</option>
                                            <option value="35">35 Mbps</option>
                                            <option value="50">50 Mbps</option>
                                            <option value="100">100 Mbps</option>
                                        </select>
                                        <span id="error_edit_select_layanan" class="text-danger"></span>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Tagihan</label>
                                        <input type="text" class="form-control" required id="edit_tagihan"
                                            name="edit_tagihan">
                                        <span id="error_edit_tagihan" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="form-label">Alamat</label>
                                        <textarea rows="3" id="edit_alamat" name="edit_alamat" cols="3" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-img-actions mx-1 mt-1">
                                                <img class="card-img img-fluid" id="id_gambar_1" src=""
                                                    alt="">
                                                <div class="card-img-actions-overlay card-img">
                                                    <a id="id_gambar_1_link"
                                                        class="btn btn-outline-white btn-icon rounded-pill"
                                                        data-bs-popup="lightbox">
                                                        <i class="ph-plus"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div class="d-flex align-items-start flex-nowrap">
                                                    <div>
                                                        <div class="fw-semibold me-2">Bukti Bayar Pelanggan</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-img-actions mx-1 mt-1">
                                                <img class="card-img img-fluid" id="id_gambar_2" src=""
                                                    alt="">
                                                <div class="card-img-actions-overlay card-img">
                                                    <a href="" id="id_gambar_2_link"
                                                        class="btn btn-outline-white btn-icon rounded-pill"
                                                        data-bs-popup="" data-gallery="">
                                                        <i class="ph-plus"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div class="d-flex align-items-start flex-nowrap">
                                                    <div>
                                                        <div class="fw-semibold me-2" id="judul">Bukti Bayar iCrm
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <div class="row mb-3 ">
                                <div class="col-sm-6">
                                    <label class="form-label">Follow Up Via</label>
                                    <select class="form-control edit_fu" name="edit_fu" id="edit_fu"
                                        data-minimum-results-for-search="Infinity" data-fouc>
                                        <option value="chat">Chat WA</option>
                                        <option value="call">Outbound Call</option>
                                        <option value="visit">Site Visit</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label">Apakah Masih Berminat ?</label>
                                    <select class="form-control edit_is_minat" name="edit_is_minat"
                                        id="edit_is_minat" data-minimum-results-for-search="Infinity" data-fouc>
                                        <option value="ya">Ya</option>
                                        <option value="tidak">Tidak</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Bayar</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="ph-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control edit_tgl_bayar"
                                                id="edit_tgl_bayar" name="edit_tgl_bayar" placeholder="Pick a date">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label">Kategori Bad Debt</label>
                                    <select class="form-control edit_kategori_debt" name="edit_kategori_debt"
                                        id="edit_kategori_debt" data-minimum-results-for-search="Infinity" data-fouc>
                                        <option></option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}"> {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label">Issue Bayar</label>
                                    <select class="form-control edit_issue_bayar" name="edit_issue_bayar"
                                        id="edit_issue_bayar" data-minimum-results-for-search="Infinity" data-fouc>
                                        <option value="tidak">Tidak Ada</option>
                                        <option value="kliring">Kliring</option>
                                        <option value="error_flagging">Error Flagging</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label">Status Bayar</label>
                                    <select class="form-control edit_select_status_bayar"
                                        name="edit_select_status_bayar" id="edit_select_status_bayar"
                                        data-minimum-results-for-search="Infinity" data-fouc>
                                        <option value="close">Close</option>
                                        <option value="pending">Pending</option>
                                        <option value="lose">Lose</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label">Download MyIcon+</label>
                                    <select class="form-control edit_my_icon" name="edit_my_icon" id="edit_my_icon"
                                        data-minimum-results-for-search="Infinity" seledata-fouc>
                                        <option value="NULL"> Kosong</option>
                                        <option value="sudah">Sudah</option>
                                        <option value="belum">Belum</option>
                                    </select>
                                </div>

                            </div>

                            {{-- <div class="row">
                                <div class="col-sm-6" id="view-blob">
                                    <label class="form-label">Bukti Bayar</label>
                                    <input type="file" id="gambar_1" class="form-control" accept="image/*">
                                </div>
                                <div class="col-sm-6" id="view-blob">
                                    <label class="form-label">Bukti iCrm+ </label>
                                    <input type="file" id="gambar_2" class="form-control" accept="image/*">
                                </div>
                            </div> --}}
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
