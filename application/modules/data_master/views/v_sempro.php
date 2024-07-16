<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Master Data Sempro</h3>
					
                </div>
                <div class="card-body table-responsive p-0">
                    <input type="hidden" class="form-control" name="res_prodi" id="res_prodi" name="" value="{res_prodi}" readonly="">
                    <table id="tableSempro" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pengajuan</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul Skripsi</th>
                                <th>URL Bimbingan</th>
                                <th>Status</th>
                                <th>Nip Pembimbing</th>
                                <th>Nama Pembimbing</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <div class="modal fade text-left" id="modalProdi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
                    aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="addprodi"> Add Prodi</h5>
                                  <h5 class="modal-title" id="edprodi"> Edit Sempro</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form id="form-editProdi" method="POST">
                                    <input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                    <div class="modal-body">
                                        <input type="hidden" class="form-control" id="id" name="id" >
                                        <input type="hidden" class="form-control" id="status_bimb" name="status_bimb" >
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="submission_code">Kode Pengajuan</label>
                                            <input type="text" class="form-control" name="submission_code" id="submission_code" name="" readonly="">
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="nim">NIM</label>
                                            <input type="text" class="form-control" name="nim" id="nim" readonly="">
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="student_name">Nama Mahasiswa</label>
                                            <input type="text" class="form-control" name="student_name" id="student_name" readonly="">
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="jdlskrip">Judul Skripsi</label>
                                            <textarea class="form-control" name="jdlskrip" id="jdlskrip"></textarea>
                                            <!-- <input type="text" class="form-control" name="jdlskrip" id="jdlskrip" > -->
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="namapembimbing">Dosen Pembimbing</label>
                                            <input type="text" class="form-control" name="namapembimbing" id="namapembimbing"  readonly="true">
                                        </fieldset>
                                        <input type="hidden" class="form-control" name="pembimbbar" id="pembimbbar" value="0"  readonly="true">
                                        <input type="hidden" class="form-control" name="nampembimbbar" id="nampembimbbar"   readonly="true">
                                        <input type="hidden" class="form-control" name="loker" id="loker"  readonly="true">
                                        <input type="hidden" class="form-control" name="submission_status" id="submission_status"  readonly="true">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="pembimbingbaru">Dosen Pembimbing </label>
                                                <select class="custom-select d-block w-100" name="pembimbingbaru" id="pembimbingbaru" >
                                                    <option value="">-- Pilih Pembimbing --</option>
                                                    {dpt_jur}
                                                    <option value="{kode_dosen}">{nama}</option>
                                                    {/dpt_jur}
                                                </select>
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="close">
                                        <button id="btn-submit" type="submit" class="btn btn-outline-primary btn-lg">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>