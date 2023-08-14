<div id="modal_edit_daily" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Ubah Dokumentasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editDaily" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id_daily">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Kategori Dinas</label>
                                <select class="form-control edit_kategori" name="edit_kategori" id="edit_kategori"
                                    data-minimum-results-for-search="Infinity" data-fouc>
                                    <option value="Ya">SPPD</option>
                                    <option value="Tidak">Tidak SPPD</option>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Nama OLT</label>
                                <select class="form-control edit_olt" name="edit_olt" id="edit_olt">
                                    <option value=""></option>
                                    @foreach ($olt as $item)
                                        <option value="{{ $item->id }}"> {{ $item->nama_olt }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Jenis Kegiatan</label>
                                <select class="form-control edit_kegiatan" name="edit_kegiatan" id="edit_kegiatan"
                                    data-fouc>
                                    <option value=""></option>
                                    @foreach ($kegiatan as $item)
                                        <option value="{{ $item->id }}"> {{ $item->jenis_kegiatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Gambar</label>
                                <input type="file" id="edit_gambar" name="edit_gambar" class="form-control"
                                    accept="image/*">
                                <span id="error_images" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Catatan</label>
                                <textarea rows="3" id="edit_catatan" name="edit_catatan" cols="3" class="form-control"></textarea>
                            </div>

                            <div class="col-sm-6">
                                <img class="card-img img-fluid" id="view_images" style="height: 150px; width: 300px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
        </div>
    </div>
</div>
