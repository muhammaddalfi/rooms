<div id="modal_import_olt" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import OLT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-import-olt" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="file" id="file" name="file" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="import_excel">
                        <img src='{{ asset('assets/spinner.gif') }}' id="spinner">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
