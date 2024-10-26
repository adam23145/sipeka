<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4 class="card-title">Data Mbkm</h4>
                    <div class="card-tools">
                        <label for="filter-konfirmasi">Filter Status:</label>
                        <select id="filter-konfirmasi" class="form-control">
                            <option value="Diproses">Diproses</option>
                            <option value="Revisi">Revisi</option>
                            <option value="Acc">Acc</option>
                        </select>
                    </div>
                </div>
                <div class="card-body table-responsive p-4">
                    <table id="table-pengajuan" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th class="wrap-text">Nama Mahasiswa</th>
                                <th>Tanggal Pengajuan</th>
                                <th class="wrap-text">Mbkm</th>
                                <th>Dokumen</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>