<div id="modal_pengguna" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-pengguna" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" placeholder="Muhammad Alfi"
                                    class="form-control">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Email</label>
                                <input type="text" id="email" name="email"
                                    placeholder="muhammad.ramadhan@iconpln.co.id" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">No. Whatsapp</label>
                                <input type="text" id="hp" name="hp" placeholder="08116565xxx"
                                    class="form-control">
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <p class="fw-semibold">Jenis Pengguna</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="jenis_pengguna"
                                            value="mpp" id="cr_l_i_s">
                                        <label class="form-check-label" for="cr_l_i_s">MPP</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="jenis_pengguna"
                                            value="mpi" id="cr_l_i_u">
                                        <label class="form-check-label" for="cr_l_i_u">MPI / Internal</label>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6 mpp_form">
                                <label class="form-label">Nama Perusahaan</label>
                                <select class="form-control mpp" id="nama_perusahaan" name="nama_perusahaan">
                                    <option value="">Pilih</option>
                                    @foreach ($mpp as $mpp)
                                        <option value="{{ $mpp->nama_perusahaan }}"> {{ $mpp->nama_perusahaan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6 mpi_form d-none">
                                <label class="form-label">Nama PIC / Upline</label>
                                <select class="form-control mpi" id="nama_upline" name="nama_upline">
                                    <option value=""></option>
                                    @foreach ($upline as $upline)
                                        <option value="{{ $upline->nama_upline }}"> {{ $upline->nama_upline }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Role</label>
                                <select class="form-control role" name="role" id="role"
                                    data-minimum-results-for-search="Infinity" data-fouc>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="save" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /vertical form modal -->
