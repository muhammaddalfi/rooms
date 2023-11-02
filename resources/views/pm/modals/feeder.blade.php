<div id="modal_pm_feeder" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Form Feeder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form_pm_feeder" class="form_input_feeder" enctype="multipart/form-data" action="#"
                method="post">
                @csrf
                <input type="hidden" id="id_pm_feeder">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Apakah Ada Kabel Jatuh ?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kabel_jatuh"
                                            id="kabel_jatuh_ya" value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kabel_jatuh"
                                            id="kabel_jatuh_tidak" value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>


                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_kabel_jatuh"
                                        name="catatan_kabel_jatuh">
                                    <span id="error_lat" class="text-danger"></span>
                                </div>
                            </div>
                            <span id="error_kabel_jatuh" class="text-danger"></span>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Ada Andongan ?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kabel_andongan"
                                            id="kabel_andongan_ya" value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kabel_andongan"
                                            id="kabel_andongan_tidak" value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_kabel_andongan"
                                        name="catatan_kabel_andongan">
                                </div>
                            </div>
                            <span id="error_kabel_andongan" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Ada Kabel Putus ?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kabel_putus"
                                            id="kabel_putus_ya" value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kabel_putus"
                                            id="kabel_putus_tidak" value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_kabel_putus"
                                        name="catatan_kabel_putus">
                                </div>
                            </div>
                            <span id="error_kabel_putus" class="text-danger"></span>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Kondisi Kabel Bagus ?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kabel_bagus"
                                            id="kabel_bagus_ya" value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kabel_bagus"
                                            id="kabel_bagus_tidak" value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_kabel_bagus"
                                        name="catatan_kabel_bagus">
                                </div>
                            </div>
                            <span id="error_kabel_bagus" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Accessoris Terpasang Semua ?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="accessoris"
                                            id="accessoris_ya" value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="accessoris"
                                            id="accessoris_tidak" value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_accessoris"
                                        name="catatan_accessoris">
                                </div>
                            </div>
                            <span id="error_accessoris" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Kondisi Accessoris</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_accessoris"
                                            id="kondisi_accessoris_ya" value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_accessoris"
                                            id="kondisi_accessoris_tidak" value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_kondisi_accessoris"
                                        name="catatan_kondisi_accessoris">
                                </div>
                            </div>
                            <span id="error_kondisi_accessoris" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Apakah Ada JB ?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="jb" id="jb_ya"
                                            value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="jb" id="jb_tidak"
                                            value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_jb" name="catatan_jb">
                                </div>
                            </div>
                            <span id="error_jb" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Kondisi JB</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_jb"
                                            id="kondisi_jb_ok" value="OK">
                                        <label class="form-check-label" for="cr_l_i_s">OK</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_jb"
                                            id="kondisi_jb_nok" value="NOK">
                                        <label class="form-check-label" for="cr_l_i_u">NOK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_kondisi_jb"
                                        name="catatan_kondisi_jb">
                                </div>
                            </div>
                            <span id="error_kondisi_jb" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Semua Core Tersambung</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="core" id="core_ya"
                                            value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="core"
                                            id="core_tidak" value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_core"
                                        name="catatan_core">
                                </div>
                            </div>
                            <span id="error_core" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Posisi JB Terpasang Rapi ?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="posisi_jb"
                                            id="posisi_jb_ya" value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="posisi_jb"
                                            id="posisi_jb_tidak" value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_posisi_jb"
                                        name="catatan_posisi_jb">
                                </div>
                            </div>
                            <span id="error_posisi_jb" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12" id="view-blob-feeder">
                            <label class="form-label">Dokumentasi</label>
                            <input type="file" id="dokumentasi_feeder" name="dokumentasi_feeder"
                                class="form-control" accept="image/*">
                            <span id="error_dokumentasi_feeder" class="text-danger"></span>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit1" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
