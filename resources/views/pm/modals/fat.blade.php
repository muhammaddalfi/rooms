<div id="modal_pm_fat" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Form FAT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form_pm_fat" class="form_input_fat" enctype="multipart/form-data" action="#" method="post">
                @csrf
                <input type="hidden" id="id_pm_fat">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Box FAT Tertutup Rapat</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="box_fat" id="box_fat_ya"
                                            value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="box_fat" id="box_fat_tidak"
                                            value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>


                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_box_fat"
                                        name="catatan_box_fat">
                                    <span id="error_lat" class="text-danger"></span>
                                </div>
                            </div>
                            <span id="error_box_fat" class="text-danger"></span>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Box FAT Keadaan Bersih ?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kebersihan_fat"
                                            id="kebersihan_fat_ya" value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kebersihan_fat"
                                            id="kebersihan_fat_tidak" value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_kebersihan_fat"
                                        name="catatan_kebersihan_fat">
                                </div>
                            </div>
                            <span id="error_kebersihan_fat" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Semua Port FAT Ada Redaman ?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="all_port_fat"
                                            id="all_port_fat_ya" value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="all_port_fat"
                                            id="all_port_fat_tidak" value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_all_port_fat"
                                        name="catatan_all_port_fat">
                                </div>
                            </div>
                            <span id="error_all_port_fat" class="text-danger"></span>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Ada Port FAT Redaman Tinggi ?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="port_fat_redaman"
                                            id="port_fat_redaman_ya" value="YA">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="port_fat_redaman"
                                            id="port_fat_redaman_tidak" value="TIDAK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_port_fat_redaman"
                                        name="catatan_port_fat_redaman">
                                </div>
                            </div>
                            <span id="error_port_fat_redaman" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12" id="view-blob">
                            <label class="form-label">Dokumentasi</label>
                            <input type="file" id="dokumentasi_fat" name="dokumentasi_fat" class="form-control"
                                accept="image/*">
                            <span id="error_dokumentasi_fat" class="text-danger"></span>
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
