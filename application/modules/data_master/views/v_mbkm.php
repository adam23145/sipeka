<div class="container mt-4">
    <h2 class="mb-4">Data MBKM</h2>

    <!-- Card Layout untuk Tabel Data MBKM -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tabel Data MBKM</h5>
        </div>
        <div class="card-body">
            <table id="dataMbkmTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Submission Code</th>
                        <th>Judul</th> <!-- Kolom Judul -->
                        <th>NIM</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Dosen Pembimbing</th>
                        <th>Posisi Berkas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal untuk Form Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data MBKM</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <!-- Hidden field untuk ID -->
                    <input type="hidden" name="id" id="id">

                    <!-- Field untuk Submission Code (readonly) -->
                    <div class="mb-3">
                        <label for="submission_code" class="form-label">Submission Code</label>
                        <input type="text" class="form-control" id="submission_code" name="submission_code" readonly>
                    </div>

                    <!-- Field untuk NIM (readonly) -->
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" readonly>
                    </div>

                    <!-- Field untuk Judul (editable) -->
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>