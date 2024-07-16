<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Master Data Ayat</h3>
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
				<div class="card-body">
                    <form id="form-search-report" method="POST">
                        <div class="callout callout-info">
                            <div class="info-box-content">

                                <div class="card-body">
                                    <br>
                                    <div class="row">
                                        <input id="jrsn" name="jrsn" class="form-control" type="hidden" readonly="true" value="0" >
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="text-align: right;" class="col-form-label col-md-2">Prodi</label>
                                                <div class="col-md-7">
                                                    <select class="custom-select d-block w-100" name="jurusan" id="jurusan" >
                                                        <option value="">-- Pilih Prodi --</option>
                                                        {data_prodi}
                                                        <option value="{major_code}">{major_name}</option>
                                                        {/data_prodi}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-light" style="text-align: center;">
                                    <button type="submit" class="btn btn-info" id="btn-search"><i class="la la-search" style="color: white;"></i>Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
				<div id="card-loading" class="col-md-12" style="text-align: center; display: none;">
					<div class="preloader pl-xl pls-primary">
						
					</div>
				</div>
				<div id="card-table-ayat" class="card card-primary card-outline">
                    <div class="card-body table-responsive p-0">
						<div id="disini" class="col-md-12"></div>
						<table id="tableAyat" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>id_prodi</th>
									<th>Id Ayat</th>
									<th>Prodi</th>
									<th>Ayat</th>
									<th>Tema</th>
									<th>id_status</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
                </div>
                <div class="form-group">
                            <div class="modal fade text-left" id="modalAyat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
                    aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="myModalLabel35"> Add Ayat</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <form id="form-editAyat" method="POST">
                                            <input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                            <div class="modal-body">
                                                <input type="hidden" class="form-control" id="id" name="id" value="0">
                                                <fieldset class="form-group floating-label-form-group">
                                                    <label for="email">Ayat</label>
                                                    <input type="text" class="form-control" name="ayat" id="ayat" name="" placeholder="Ayat" required="">
                                                </fieldset>
                                                <fieldset class="form-group floating-label-form-group">
                                                    <label for="email">Tema</label>
                                                    <input type="text" class="form-control" name="tema" id="tema" placeholder="Tema" required="">
                                                </fieldset>
                                                <fieldset class="form-group floating-label-form-group">
                                                    <label for="title">Program Studi</label>
                                                    <select class="custom-select d-block w-100" name="prodi" id="prodi" required="">
                                                        <option value="">-- Select Program Studi --</option>
                                                        {data_prodi}
                                                        <option value="{major_code}">{major_name}</option>
                                                        {/data_prodi}
                                                    </select>
                                                </fieldset>
												<fieldset class="form-group floating-label-form-group">
                                                    <label for="title">Status</label>
                                                    <select class="custom-select d-block w-100" id="status" name="status" required="">
                                                        <option value="" selected>-- Select Status --</option>
														{data_status}
                                                        <option value="{id}">{status}</option>
                                                        {/data_status}
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
				<div class="form-group">
					<div class="modal fade text-left" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
						aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
								  <h5 class="modal-title" id="myModalLabel35"> Upload Ayat</h5>
								  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
								</div>
								<form id="form-uploadAyat" method="POST" enctype="multipart/form-data">
									<div class="modal-body">
										<fieldset class="form-group floating-label-form-group">
											<label for="fileupload">File</label>
											<input id="fileupload" name="fileupload" type="file">
										</fieldset>
									</div>
									<div class="modal-footer justify-content-between">
										<div>
											<a href="../document/files/Template-Ayat.xlsx" target="_blank" style="float: right;" class="btn btn-tool bg-gradient-primary btn-sm" >
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
            </div>
        </div>
    </div>
</div>