<div id="modal_fu" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="followup" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id_pelanggan">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Nama Pelanggan</td>
                                                <td>:</td>
                                                <td class="nama_pelanggan"></td>
                                            </tr>

                                            <tr>
                                                <td>ID PLN</td>
                                                <td>:</td>
                                                <td class="id_pln"></td>
                                            </tr>

                                            <tr>
                                                <td>NIK</td>
                                                <td>:</td>
                                                <td class="nik"></td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Telp</td>
                                                <td>:</td>
                                                <td class="telp"></td>
                                            </tr>
                                            <tr>
                                                <td>Layanan</td>
                                                <td>:</td>
                                                <td class="layanan"></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td class="alamat"></td>
                                            </tr>

                                            <tr>
                                                <td>Jumlah Tagihan</td>
                                                <td>:</td>
                                                <td class="tagihan"></td>
                                            </tr>

                                            <tr>
                                                <td>Status Pembayaran</td>
                                                <td>:</td>
                                                <td class="status_bayar"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <p class="fw-semibold">Apakah Masih Berminat ?</p>
                                <div class="border p-3 rounded">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="is_minat" id="is_minat_ya"
                                            value="ya">
                                        <label class="form-check-label" for="cr_l_i_s">Ya</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="is_minat"
                                            id="is_minat_pending" value="bayar">
                                        <label class="form-check-label" for="cr_l_i_u">Sudah Bayar</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="is_minat"
                                            id="is_minat_tidak" value="tidak">
                                        <label class="form-check-label" for="cr_l_i_u">Tidak</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row kategori_minat d-none">
                                <div class="col-sm-6">
                                    <label class="form-label">Follow Up Via</label>
                                    <select class="form-control follow_up_ya" name="follow_up_ya" id="follow_up_ya"
                                        data-minimum-results-for-search="Infinity" data-fouc>
                                        <option></option>
                                        <option value="chat">Chat WA</option>
                                        <option value="call">Outbound Call</option>
                                        <option value="visit">Site Visit</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Bayar</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="ph-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control tgl_bayar_ya" id="tgl_bayar_ya"
                                                name="tgl_bayar_ya" placeholder="Pick a date">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Kategori Bad Debt</label>
                                        <select class="form-control kategori_debt_ya" name="kategori_debt_ya"
                                            id="kategori_debt_ya" data-minimum-results-for-search="Infinity" data-fouc>
                                            <option></option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}"> {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Issue Bayar</label>
                                        <select class="form-control issue_bayar_ya" name="issue_bayar_ya"
                                            id="issue_bayar_ya" data-minimum-results-for-search="Infinity" data-fouc>
                                            <option></option>
                                            <option value="tidak">Tidak Ada</option>
                                            <option value="kliring">Kliring</option>
                                            <option value="error_flagging">Error Flagging</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-sm-12">
                                    <label class="form-label">Keterangan</label>
                                    <textarea rows="3" id="keterangan_ya" name="keterangan_ya" cols="3" class="form-control"></textarea>
                                </div>

                            </div>

                            <div class="row kategori_bayar d-none">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="form-label">Follow Up Via</label>
                                        <select class="form-control follow_up_bayar" name="follow_up_bayar"
                                            id="follow_up_bayar" data-minimum-results-for-search="Infinity" data-fouc>
                                            <option></option>
                                            <option value="chat">Chat WA</option>
                                            <option value="call">Outbound Call</option>
                                            <option value="visit">Site Visit</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Bayar</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="ph-calendar"></i>
                                                </span>
                                                <input type="text" class="form-control tgl_bayar_bayar"
                                                    id="tgl_bayar_bayar" name="tgl_bayar_bayar"
                                                    placeholder="Pick a date">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6" id="view-blob">
                                        <label class="form-label">Bukti Bayar</label>
                                        <input type="file" id="gambar_1" class="form-control" accept="image/*">
                                    </div>
                                    <div class="col-sm-6" id="view-blob">
                                        <label class="form-label">Bukti iCrm+ </label>
                                        <input type="file" id="gambar_2" class="form-control" accept="image/*">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Kategori Bad Debt</label>
                                        <select class="form-control kategori_debt_bayar" name="kategori_debt_bayar"
                                            id="kategori_debt_bayar" data-minimum-results-for-search="Infinity"
                                            data-fouc>
                                            <option></option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}"> {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Issue Bayar</label>
                                        <select class="form-control issue_bayar_bayar" name="issue_bayar_bayar"
                                            id="issue_bayar_bayar" data-minimum-results-for-search="Infinity"
                                            data-fouc>
                                            <option></option>
                                            <option value="tidak">Tidak Ada</option>
                                            <option value="kliring">Kliring</option>
                                            <option value="error_flagging">Error Flagging</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row mb-3 ">
                                    <div class="col-sm-6">
                                        <label class="form-label">Download MyIcon+</label>
                                        <select class="form-control my_icon" name="my_icon" id="my_icon"
                                            data-minimum-results-for-search="Infinity" data-fouc>
                                            <option></option>
                                            <option value="sudah">Sudah</option>
                                            <option value="belum">Belum</option>
                                        </select>
                                    </div>

                                </div>

                            </div>

                            <div class="row kategori_tidak d-none">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Kategori Bad Debt</label>
                                        <select class="form-control kategori_debt_tidak" name="kategori_debt_tidak"
                                            id="kategori_debt_tidak" data-minimum-results-for-search="Infinity"
                                            data-fouc>
                                            <option></option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}"> {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Follow Up Via</label>
                                        <select class="form-control follow_up_tidak" name="follow_up_tidak"
                                            id="follow_up_tidak" data-minimum-results-for-search="Infinity" data-fouc>
                                            <option></option>
                                            <option value="chat">Chat WA</option>
                                            <option value="call">Outbound Call</option>
                                            <option value="visit">Site Visit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
