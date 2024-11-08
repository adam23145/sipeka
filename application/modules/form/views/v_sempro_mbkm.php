<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Sempro Mbkm</h3>
                </div>
                <form id="form-submtitle" method="POST">
                    <input type="hidden" name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="card-body">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="subm_id" value="<?php echo $subm_id; ?>">
                        <div class="form-group">
                            <label>Judul Mbkm:</label>
                            <input type="text" class="form-control" name="mbkm" required>
                        </div>

                        <div class="form-group">
                            <label>Nama Mahasiswa:</label>
                            <input type="text" class="form-control" value="<?php echo $this->session->userdata['logged_in']['username'] ?>" name="nama_mahasiswa" readonly="true" required>
                        </div>

                        <div class="form-group">
                            <label>NIM:</label>
                            <input type="text" class="form-control" value="<?php echo substr($this->session->userdata['logged_in']['userid'], 0, 12) ?>" name="nim" readonly="true" required>
                        </div>

                        <div class="form-group">
                            <label for="majorname">Program Studi</label>
                            <input type="text" class="form-control" id="majorname" name="majorname" value="{majorname}" readonly="true">
                        </div>
                        
                        <div class="form-group">
                            <label>Dokumen Pendukung :</label>
                            <div class="form-group p-t-15">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" multiple="" name="dokumen_pendukung" id="dokumen_pendukung" required="">
                                        <label class="custom-file-label" for="validatedCustomFile">Pilih file...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <button id="btn-submit" type="submit" class="btn btn-info float-right">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>