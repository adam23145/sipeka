<div class="container-fluid">
    <div class="row">
        <div id="tabel" class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Data Pengajuan Sidang</h3>
                </div>
                <div class="card-body table-responsive p-3">
                    <table id="table_sidang" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Judul Sidang</th>
                                <th>Nama Mahasiswa</th>
                                <th>Status</th>
                                <th>Tanggal Sidang</th>
                                <th>Tempat Sidang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Sidang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="sidang_id" name="sidang_id">

                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <select class="form-control" id="edit_status" name="status">
                            <option value="2">Diterima</option>
                            <option value="0">Ditolak</option>
                        </select>
                    </div>

                    <div class="form-group" id="tanggal_sidang_group">
                        <label for="edit_tanggal_sidang">Tanggal Sidang</label>
                        <input type="date" class="form-control" id="edit_tanggal_sidang" name="tanggal_sidang">
                    </div>

                    <div class="form-group" id="tempat_sidang_group">
                        <label for="edit_tempat_sidang">Tempat Sidang</label>
                        <input type="text" class="form-control" id="edit_tempat_sidang" name="tempat_sidang">
                    </div>

                    <div class="form-group" id="edit_pembimbing_group">
                        <label for="edit_pembimbing">Dosen Pembimbing 2</label>
                        <select class="form-control select2" id="edit_pembimbing" name="pembimbing">
                        </select>
                    </div>

                    <div class="form-group" id="edit_penguji1_group">
                        <label for="edit_penguji1">Dosen Penguji 1</label>
                        <select class="form-control select2" id="edit_penguji1" name="penguji1">
                        </select>
                    </div>

                    <div class="form-group" id="edit_penguji2_group">
                        <label for="edit_penguji2">Dosen Penguji 2</label>
                        <select class="form-control select2" id="edit_penguji2" name="penguji2">
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>