<div id="modal_pm" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form_pm" class="form_input_jadwal">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Tanggal Mulai</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ph-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control tgl_mulai" id="tgl_mulai" name="tgl_mulai"
                                        placeholder="Pick a date">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Tanggal Selesai</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ph-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control tgl_selesai" id="tgl_selesai"
                                        name="tgl_selesai" placeholder="Pick a date">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">Lokasi Cluster</label>
                                <select class="form-control lokasi" name="lokasi" id="lokasi" data-fouc>
                                    <option></option>
                                    @foreach ($cluster as $item)
                                        <option value="{{ $item->id }}"> {{ $item->nama_olt }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="error_lokasi" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
