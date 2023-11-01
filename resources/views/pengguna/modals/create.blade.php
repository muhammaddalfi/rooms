<div id="modal_marketer" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-marketer" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" placeholder="Muhammad Alfi"
                                    class="form-control">
                                <span id="error_name" class="text-danger"></span>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Email</label>
                                <input type="text" id="email" name="email"
                                    placeholder="muhammad.ramadhan@iconpln.co.id" class="form-control">
                                <span id="error_email" class="text-danger"></span>
                            </div>


                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">No. Whatsapp</label>
                                <input type="text" id="hp" name="hp" placeholder="08116565xxx"
                                    class="form-control">
                                <span id="error_hp" class="text-danger"></span>

                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Role</label>
                                <select multiple ="multiple" class="form-control role" name="role[]" id="role">
                                    <option></option>
                                    @foreach ($role as $item)
                                        <option value="{{ $item->id }}"> {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="error_role" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="save" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /vertical form modal -->
