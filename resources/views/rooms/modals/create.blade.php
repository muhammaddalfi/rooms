<div id="modal_daily" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-daily" enctype="multipart/form-data" action="#" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Latitude</label>
                                <input type="text" readonly class="form-control" required id="latNow"
                                    name="latNow">
                                <span id="error_name" class="text-danger"></span>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Longitude</label>
                                <input type="text" readonly class="form-control" required id="lngNow"
                                    name="lngNow">
                                <span id="error_name" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Kategori Dinas</label>
                                <select class="form-control kategori" name="kategori" id="kategori"
                                    data-minimum-results-for-search="Infinity" data-fouc>
                                    <option value="Ya">SPPD</option>
                                    <option value="Tidak">Tidak SPPD</option>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Nama OLT</label>
                                <select class="form-control olt" name="olt" id="olt">
                                    <option value=""></option>
                                    @foreach ($olt as $item)
                                        <option value="{{ $item->nama_olt }}"> {{ $item->nama_olt }}
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
                                <select class="form-control kegiatan" name="kegiatan" id="kegiatan" data-fouc>
                                    <option value=""></option>
                                    @foreach ($kegiatan as $item)
                                        <option value="{{ $item->id }}"> {{ $item->jenis_kegiatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Upload Dokumentasi</label>
                                <input type="file" id="gambar" name="gambar" class="form-control"
                                    accept="image/*">
                                <span id="error_images" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-label">Catatan</label>
                                <textarea rows="3" id="catatan" name="catatan" cols="3" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="submit" id="save" class="btn btn-success">Save</button> --}}
                    <button type="submit" class="btn btn-primary" id="save">
                        <img src='{{ asset('assets/spinner.gif') }}' id="spinner">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
