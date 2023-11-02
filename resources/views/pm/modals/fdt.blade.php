<div id="modal_pm_fdt" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Form FDT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form_pm_fdt" class="form_input_fdt" enctype="multipart/form-data" action="#" method="post">
                @csrf
                <input type="hidden" id="id_pm_fdt">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Box FDT Tertutup Rapat</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="box_fdt" id="box_fdt_ya"
                                            value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="box_fdt" id="box_fdt_tidak"
                                            value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>


                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_box_fdt"
                                        name="catatan_box_fdt">
                                    <span id="error_lat" class="text-danger"></span>
                                </div>
                            </div>
                            <span id="error_box_fdt" class="text-danger"></span>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Box FDT Keadaan Bersih ?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kebersihan_fdt"
                                            id="kebersihan_fdt_ya" value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kebersihan_fdt"
                                            id="kebersihan_fdt_tidak" value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_kebersihan_fdt"
                                        name="catatan_kebersihan_fdt">
                                </div>
                            </div>
                            <span id="error_kebersihan_fdt" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Semua Port FDT Ada Redaman ?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="all_port_fdt"
                                            id="all_port_fdt_ya" value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="all_port_fdt"
                                            id="all_port_fdt_tidak" value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_all_port_fdt"
                                        name="catatan_all_port_fdt">
                                </div>
                            </div>
                            <span id="error_all_port_fdt" class="text-danger"></span>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Ada Port FDT Redaman Tinggi ?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="port_fdt_redaman"
                                            id="port_fdt_redaman_ya" value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="port_fdt_redaman"
                                            id="port_fdt_redaman_tidak" value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_port_fdt_redaman"
                                        name="catatan_port_fdt_redaman">
                                </div>
                            </div>
                            <span id="error_port_fdt_redaman" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12" id="view-blob">
                            <label class="form-label">Dokumentasi</label>
                            <input type="file" id="dokumentasi_fdt" name="dokumentasi_fdt" class="form-control"
                                accept="image/*">
                            <span id="error_dokumentasi_fdt" class="text-danger"></span>
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
