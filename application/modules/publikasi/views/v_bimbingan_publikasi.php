<div class="container-fluid">
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-tag"></i>
                Form Bimbingan Publikasi
            </h3>
        </div>
        <div class="card-body">
            <blockquote>
                <div class="col-md-12" id="dataForm">
                    <dl class="row">
                        <dt class="col-sm-4">Nama</dt>
                        <dd class="col-sm-8" id="namaMahasiswa"></dd>
                        <dt class="col-sm-4">NIM</dt>
                        <dd class="col-sm-8" id="nimMahasiswa"></dd>
                        <dt class="col-sm-4">Judul Proposal</dt>
                        <dd class="col-sm-8" id="judulProposal"></dd>
                        <dt class="col-sm-4">Jenis Publikasi</dt>
                        <dd class="col-sm-8" id="jenispublikasi"></dd>
                        <dt class="col-sm-4">Link File</dt>
                        <dd class="col-sm-8" id="file"></dd>
                    </dl>
                </div>
            </blockquote>
            <hr>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Log</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table-logbim" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Bimbingan Ke</th>
                                                <th>Keterangan</th>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-id_bimbingan_form="">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <form id="form-ba" method="POST">
                                    <input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <input required type="hidden" name="id_bimbingan_form" id="id_bimbingan_form" value="">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input class="form-control" type="date" id="tanggal" name="tanggal" placeholder="Pilih Tanggal" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="sub_status">Status</label>
                                        <select class="custom-select d-block w-100" id="sub_status" name="sub_status" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="Revisi">Revisi</option>
                                            <option value="Acc">Acc</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="keteranganContainer">
                                        <label for="keterangan" id="label-keterangan">Keterangan</label>
                                        <textarea class="form-control" rows="6" id="keterangan" name="keterangan" ></textarea>
                                    </div>
                                    <button id="btn-submit" type="submit" class="btn btn-primary float-right">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>