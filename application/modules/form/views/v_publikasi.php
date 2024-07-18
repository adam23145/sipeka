<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Pengajuan Judul</h3>
                </div>
                <form id="form-submtitle" method="POST">
                    <input type="hidden" name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="card-body">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="subm_id" value="<?php echo $subm_id; ?>">
                        <div class="form-group">
                            <label>Jenis Tugas Akhir:</label>
                            <select class="form-control" name="jenis_tugas_akhir" required>
                                <option value="Publikasi Ilmiah">Publikasi Ilmiah</option>
                                <option value="MBKM Riset">MBKM Riset</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Judul Tugas Akhir:</label>
                            <input type="text" class="form-control" name="judul_tugas_akhir" required>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi Tugas Akhir:</label>
                            <textarea class="form-control" name="deskripsi_tugas_akhir" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Nama Mahasiswa:</label>
                            <input type="text" class="form-control" value="<?php echo $this->session->userdata['logged_in']['username'] ?>" name="nama_mahasiswa" readonly="true" required>
                        </div>

                        <div class="form-group">
                            <label>NIM:</label>
                            <input type="text" class="form-control" value="<?php echo substr($this->session->userdata['logged_in']['userid'], 0,12) ?>"  name="nim" readonly="true" required>
                        </div>

                        <div class="form-group">
                            <label>Dosen Pembimbing Utama:</label>
                            <input type="text" class="form-control" name="dosen_pembimbing_utama" required>
                        </div>

                        <div class="form-group">
                            <label>Dosen Pembimbing Kedua:</label>
                            <input type="text" class="form-control" name="dosen_pembimbing_kedua">
                        </div>

                        <div class="form-group">
                            <label>Tanggal Pengajuan:</label>
                            <input type="date" class="form-control" name="tanggal_pengajuan" required>
                        </div>

                        <div class="form-group">
                            <label>Dokumen Pendukung:</label>
                            <input type="text" class="form-control" name="dokumen_pendukung" required>
                        </div>

                        <div class="form-group">
                            <label>Kategori Riset:</label>
                            <input type="text" class="form-control" name="kategori_riset" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Mulai Riset:</label>
                            <input type="date" class="form-control" name="tanggal_mulai_riset" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Selesai Riset:</label>
                            <input type="date" class="form-control" name="tanggal_selesai_riset" required>
                        </div>

                        <div class="form-group">
                            <label>Institusi Kolaborator:</label>
                            <input type="text" class="form-control" name="institusi_kolaborator" required>
                        </div>

                        <div class="form-group">
                            <label>Nama Jurnal/Conference:</label>
                            <input type="text" class="form-control" name="nama_jurnal_conference" required>
                        </div>

                        <div class="form-group">
                            <label>Status Publikasi:</label>
                            <select class="form-control" name="status_publikasi" required>
                                <option value="Submitted">Submitted</option>
                                <option value="Under Review">Under Review</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Published">Published</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Link Publikasi:</label>
                            <input type="text" class="form-control" name="link_publikasi" required>
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
