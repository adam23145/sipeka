<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4>Sempro Mbkm</h4>
                </div>
                <div class="card-body table-responsive p-4">
                    <table id="table_pengajuan" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Judul Mbkm</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Dosen Pembimbing</th>
                                <th>Status Pengajuan</th>
                                <th>Dokumen</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalRevisi" tabindex="-1" role="dialog" aria-labelledby="modalRevisiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRevisiLabel">Detail Revisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalContent"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="saveRevisi">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
