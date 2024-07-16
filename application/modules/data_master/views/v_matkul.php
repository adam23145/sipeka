<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Master Data Matkul</h3>
					<div style="float: right;">
						<button id="btnTambah" class="btn btn-block bg-gradient-primary btn-sm" >
                            <i style="color: white;" class="fa fa-plus"></i> Add Data
                        </button>
                    </div>
					<div style="float: right;">&nbsp;</div>
                    <div style="float: right;">
						<button id="btnUpload" class="btn btn-block bg-gradient-primary btn-sm" >
                            <i style="color: white;" class="far fa-file-excel"></i> Upload Data
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="tableMatkul" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>id</th>
                                <th>Kode</th>
                                <th>Mata Kuliah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <div class="modal fade text-left" id="modalMatkul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
            aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="addmatkul"> Add Matkul</h5>
                                  <h5 class="modal-title" id="edmatkul"> Edit Matkul</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
								
                                <form id="form-editMatkul" method="POST">
                                    <input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <div class="modal-body">
                                        <input type="hidden" class="form-control" id="id" name="id" value="0">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="kode_matkul">Kode Matkul</label>
                                            <input type="text" class="form-control" name="kode_matkul" id="kode_matkul" placeholder="kode matkul" >
                                        </fieldset>
										<fieldset class="form-group floating-label-form-group">
                                            <label for="nama_matkul">Mata Kuliah</label>
                                            <input type="text" class="form-control" name="nama_matkul" id="nama_matkul" placeholder="nama matkul" >
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
				<div class="form-group">
					<div class="modal fade text-left" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
						aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
								  <h5 class="modal-title" id="myModalLabel35"> Upload Data Matkul</h5>
								  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
								</div>
								<form id="form-uploadMatkul" method="POST" enctype="multipart/form-data">
									<div class="modal-body">
										<fieldset class="form-group floating-label-form-group">
											<label for="fileupload">File</label>
											<input id="fileupload" name="fileupload" type="file">
										</fieldset>
									</div>
									<div class="modal-footer justify-content-between">
										<div>
											<a href="../document/files/Template-Mahasiswa.xlsx" target="_blank" style="float: right;" class="btn btn-tool bg-gradient-primary btn-sm" >
												<i style="color: white;" class="far fa-file-excel"></i> Template
											</a>
										</div>
										<div>											
											<input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="close">
											<button id="btn-upload" type="submit" class="btn btn-outline-primary btn-lg">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
                <div class="form-group">
                    <div class="modal fade" id="modal-konfirmasi">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form class="form-horizontal" role="form" id="form-crot" name="form-crot">
                                <div class="modal-header">
                                  <h4 class="modal-title">Hapus</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <input type="hidden" class="form-control" name="id_matkul" id="id_matkul" >
                                <input type="hidden" class="form-control" name="major_name" id="major_name" >
                                <div class="modal-body">
                                  <p>Apakah anda yakin akan menghapus&hellip;</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                  <button type="submit" id="jadi_hapus" class="btn btn-primary">Ya</button>
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