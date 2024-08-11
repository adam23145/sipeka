<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Pengajuan Sidang</h3>
                </div>
                <form id="form-pengajuan">
                    <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_token_hash; ?>" />
                    <input type="hidden" name="subm_id" value="<?php echo $subm_id; ?>" />
                    <div class="card-body">
                        <div class="form-group">
                            <label for="judul_sidang">Judul Sidang:</label>
                            <input type="text" name="judul_sidang" class="form-control" id="judul_sidang" />
                        </div>
                        <div class="form-group">
                            <label>Nama Mahasiswa:</label>
                            <input type="text" class="form-control" value="<?php echo $this->session->userdata['logged_in']['username'] ?>" name="nama_mahasiswa" readonly="true" required>
                        </div>

                        <div class="form-group">
                            <label>NIM:</label>
                            <input type="text" class="form-control" value="<?php echo substr($this->session->userdata['logged_in']['userid'], 0, 12) ?>" name="nim" readonly="true" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <button id="btn-submit" type="submit" class="btn btn-info float-right">Kirim</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="response-message"></div>
            </div>
        </div>
    </div>
</div>