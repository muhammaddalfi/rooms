<div id="modal_pm_olt" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Form OLT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form_pm_olt" class="form_input_olt" enctype="multipart/form-data" action="#" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="col-sm-6">
                        <input type="hidden" id="id_pm">
                        <input type="hidden" readonly class="form-control" id="latNow" name="latNow">
                        <span id="error_lat" class="text-danger"></span>
                    </div>

                    <div class="col-sm-6">
                        <input type="hidden" readonly class="form-control" id="lngNow" name="lngNow">
                        <span id="error_lng" class="text-danger"></span>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="col-sm-12">
                                <label class="form-label">Lokasi Cluster</label>
                                <select class="form-control olt" name="olt" id="olt">
                                    <option></option>

                                </select>
                                <span id="error_olt" class="text-danger"></span>
                            </div>
                        </div>

                    </div>


                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Kondisi modul OLT</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_modul_olt"
                                            id="kondisi_modul_olt_ok" value="ok">
                                        <label class="form-check-label" for="cr_l_i_s">OK</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_modul_olt"
                                            id="kondisi_modul_olt_nok" value="nok">
                                        <label class="form-check-label" for="cr_l_i_u">NOK</label>
                                    </div>


                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_modul_olt"
                                        name="catatan_modul_olt">
                                    <span id="error_lat" class="text-danger"></span>
                                </div>
                            </div>
                            <span id="error_kondisi_modul_olt" class="text-danger"></span>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Kondisi Port OLT</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_port_olt"
                                            id="kondisi_port_olt_ok" value="OK">
                                        <label class="form-check-label" for="cr_l_i_s">OK</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_port_olt"
                                            id="kondisi_port_olt_nok" value="NOK">
                                        <label class="form-check-label" for="cr_l_i_u">NOK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_port_olt"
                                        name="catatan_port_olt">
                                    <span id="error_lat" class="text-danger"></span>
                                </div>
                            </div>
                            <span id="error_kondisi_port_olt" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Kondisi All SFP OLT</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_sfp_olt"
                                            id="kondisi_sfp_olt_ok" value="OK">
                                        <label class="form-check-label" for="cr_l_i_s">OK</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_sfp_olt"
                                            id="kondisi_sfp_olt_nok" value="NOK">
                                        <label class="form-check-label" for="cr_l_i_u">NOK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_kondisi_sfp"
                                        name="catatan_kondisi_sfp">
                                    <span id="error_lat" class="text-danger"></span>
                                </div>
                            </div>
                            <span id="error_kondisi_sfp_olt" class="text-danger"></span>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Kondisi Power Supply</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_power_supply"
                                            id="kondisi_power_supply_ok" value="OK">
                                        <label class="form-check-label" for="cr_l_i_s">OK</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_power_supply"
                                            id="kondisi_power_supply_nok" value="NOK">
                                        <label class="form-check-label" for="cr_l_i_u">NOK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_kondisi_power_supply"
                                        name="catatan_kondisi_power_supply">
                                    <span id="error_lat" class="text-danger"></span>
                                </div>
                            </div>
                            <span id="error_kondisi_power_supply" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Kondisi Battery</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_battery"
                                            id="kondisi_battery_ok" value="OK">
                                        <label class="form-check-label" for="cr_l_i_s">OK</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_battery"
                                            id="kondisi_battery_nok" value="NOK">
                                        <label class="form-check-label" for="cr_l_i_u">NOK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_kondisi_battery"
                                        name="catatan_kondisi_battery">
                                    <span id="error_lat" class="text-danger"></span>
                                </div>
                            </div>
                            <span id="error_kondisi_battery" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Apakah Battery Terbackup ?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="battery_backup"
                                            id="battery_backup_ya" value="OK">
                                        <label class="form-check-label" for="cr_l_i_s">YA</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="battery_backup"
                                            id="battery_backup_tidak" value="NOK">
                                        <label class="form-check-label" for="cr_l_i_u">TIDAK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_battery_backup"
                                        name="catatan_battery_backup">
                                    <span id="error_lat" class="text-danger"></span>
                                </div>
                            </div>
                            <span id="error_battery_backup" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="border p-3 rounded">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-semibold">Kondisi Suhu Kabinet</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_suhu_kabinet"
                                            id="kondisi_suhu_kabinet_ok" value="OK">
                                        <label class="form-check-label" for="cr_l_i_s">OK</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="kondisi_suhu_kabinet"
                                            id="kondisi_suhu_kabinet_nok" value="NOK">
                                        <label class="form-check-label" for="cr_l_i_u">NOK</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan_suhu_kabinet"
                                        name="catatan_suhu_kabinet">
                                    <span id="error_lat" class="text-danger"></span>
                                </div>
                            </div>
                            <span id="error_kondisi_suhu_kabinet" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12" id="view_blob_olt">
                            <label class="form-label">Dokumentasi</label>
                            <input type="file" id="dokumentasi_olt" name="dokumentasi_olt" class="form-control"
                                accept="image/*">
                            <span id="error_dokumentasi_olt" class="text-danger"></span>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="simpan_olt">Simpan</button>
                </div>
        </div>
    </div>
</div>
