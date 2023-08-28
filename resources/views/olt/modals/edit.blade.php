<div id="modal_edit_olt" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Nama OLT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>


            <div class="modal-body">
                @csrf
                <input type="hidden" id="id_olt">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Nama OLT</label>
                            <input type="text" class="form-control" required id="edit_nama_olt" name="edit_nama_olt">
                            <span id="error_name" class="text-danger"></span>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">PIC</label>
                            <select class="form-control edit_pic" name="edit_pic" id="edit_pic">
                                <option value=""></option>
                                @foreach ($pic as $item)
                                    <option value="{{ $item->id }}"> {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="error_pic" class="text-danger"></span>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Latitude</label>
                            <input type="text" class="form-control" required id="edit_lat" name="edit_lat">
                            <span id="error_lat" class="text-danger"></span>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Longitude</label>
                            <input type="text" class="form-control" required id="edit_lng" name="edit_lng">
                            <span id="error_lng" class="text-danger"></span>
                        </div>
                    </div>


                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success save">Simpan</button>
            </div>
        </div>
    </div>
</div>
