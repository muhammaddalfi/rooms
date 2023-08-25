<div id="modal_edit_anggota" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            @csrf
            <div class="modal-body">
                @csrf
                <input type="hidden" id="id_anggota">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Marketer</label>
                            <input type="text" id="edit_nama_anggota" name="edit_nama_anggota" class="form-control">
                            <span id="error_edit_nama_anggota" class="text-danger"></span>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="text" id="edit_email_anggota" name="edit_email_anggota"
                                class="form-control">
                            <span id="error_edit_email_anggota" class="text-danger"></span>
                        </div>

                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-4">
                            <label class="form-label">No. Telp</label>
                            <input type="text" id="edit_handphone_anggota" name="edit_handphone_anggota"
                                class="form-control">
                            <span id="error_edit_handphone_anggota" class="text-danger"></span>
                        </div>

                        @can('admin read')
                            <div class="col-sm-4">
                                <label class="form-label">PIC Internal</label>
                                <select class="form-control edit_leader" name="edit_leader" id="edit_leader" data-fouc>
                                    <option value=""></option>
                                    @foreach ($leader as $item)
                                        <option value="{{ $item->id }}"> {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="error_perusahaan" class="text-danger"></span>
                            </div>
                        @endcan

                        <div class="col-sm-4">
                            <label class="form-label">Password</label>
                            <input type="password" id="edit_password_anggota" name="edit_password_anggota"
                                class="form-control">
                        </div>

                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success update_anggota">Simpan</button>
            </div>
        </div>
    </div>
</div>
