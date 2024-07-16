<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Kiraatul Qur`an</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="tableTransHafalan" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Mahasiswa</th>
                                <th>id</th>
                                <th>mapping_qq</th>
                                <th>tema</th>
                                <th>Kiraatul Qur`an</th>
                                <th>Link</th>
                                <th>Fashohah</th>
                                <th>Makhroj</th>
                                <th>Tajwid</th>
                                <th>Nilai</th>
								<th>Lulus / Tidak Lulus</th>
                                <th>Dosen Penguji</th>
                                <th>Tanggal Upload</th>
                                <th>Tanggal Penilaian</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
			
			<div class="form-group">
				<div class="modal fade text-left" id="modalInput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content">
							<div class="modal-header">
							  <h5 class="modal-title" id="myModalLabel35"> Kiraatul Qur`an </h5>
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
							<form id="form-inputLink" method="POST">
								<input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
								<div class="modal-body">
									<input type="hidden" class="form-control" id="id" name="id" value="0">
									<input type="hidden" class="form-control" id="mapping_qq" name="mapping_qq" value="0">
									<div class="row">
										<div class="col-lg-4">
											<div class="card card-primary card-outline">
												<div class="card-header">
													<h1 id="qq" name="qq" class="card-title">Kiraatul Qur`an</h1>
												</div>
												<div class="card-body">
													<h3 id="tema" name="tema">Kiraatul Qur`an</h3>
												</div>
											</div>
										</div>
										<div class="col-lg-8">
											<div class="card card-primary card-outline">
												<div class="card-header">
													<h3 class="card-title">Upload Kiraatul Qur`an</h3>
												</div>
												<div class="card-body">
													<fieldset class="form-group floating-label-form-group">
														<fieldset class="form-group floating-label-form-group">
															<label for="link">Link</label>
															<input type="text" class="form-control" name="link" id="link" placeholder="Link">
														</fieldset>
													</fieldset>
												</div>
											</div>
										</div>
									</div>
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
				<div class="modal fade text-left" id="modalNilai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
					<div class="modal-dialog modal-xl" role="document">
						<div class="modal-content">
							<div class="modal-header">
							  <h5 class="modal-title" id="myModalLabel35"> Kiraatul Qur`an </h5>
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
							<form id="form-inputNilai" method="POST">
								<div class="modal-body">
									<input type="hidden" class="form-control" id="idForDosen" name="idForDosen" value="0">
									<input type="hidden" class="form-control" id="mapping_qqForDosen" name="mapping_qqForDosen" value="0">
									<div class="row">
										<div class="col-lg-4">
											<div class="card card-primary card-outline">
												<div class="card-header">
													<h1 id="qqForDosen" name="qqForDosen" class="card-title">Penilaian Kiraatul Qur`an</h1>
												</div>
												<div class="card-body">
													<h3 id="temaForDosen" name="temaForDosen">Penilaian Kiraatul Qur`an</h3>
												</div>
											</div>
										</div>
										<div class="col-lg-8">
											<div class="card card-primary card-outline">
												<div class="card-header">
													<h3 class="card-title">Penilaian Kiraatul Qur`an</h3>
												</div>
												<div class="card-body">
													<fieldset class="form-group floating-label-form-group">
														<fieldset class="form-group input-group mb-3 floating-label-form-group">
															<label for="link">Link</label>
															<div class="input-group mb-3">
																<input type="text" readonly class="form-control rounded-0" name="link_dosen" id="link_dosen" placeholder="Link">
																<div class="input-group-append">
																	<button class="btn btn-success btn-sm btn-video"><i style="color: white;" class="fas fa-eye"></i></button>
																</div>
															</div>
														</fieldset>
													</fieldset>
													<fieldset class="form-group floating-label-form-group">
														<fieldset class="form-group floating-label-form-group">
															<label for="membaca">Fashohah</label>
															<input type="text" class="form-control" value="0" name="fashohah" id="fashohah" placeholder="0">
															<label for="memahami">Makhroj</label>
															<input type="text" class="form-control" value="0" name="makhroj" id="makhroj" placeholder="0">
															<label for="menganalisa">Tajwid</label>
															<input type="text" class="form-control" value="0" name="tajwid" id="tajwid" placeholder="0">
														</fieldset>
													</fieldset>
													<fieldset class="form-group floating-label-form-group">
														<fieldset class="form-group floating-label-form-group">
															<label for="nilai">Nilai</label>
															<input type="text" class="form-control" value="0" name="nilai" placeholder="0" id="nilai" jAutoCalc="({fashohah}*0.3) + ({makhroj}*0.35) + ({tajwid}*0.35)" readonly>
														</fieldset>
													</fieldset>
													<fieldset class="form-group floating-label-form-group">
														<label for="title">Lulus / Tidak Lulus</label>
														<select class="custom-select d-block w-100" id="status_lulus" name="status_lulus">
															<option value="" selected>-- Select Status --</option>
															{data_status}
															<option value="{id}">{status_lulus}</option>
															{/data_status}
														</select>
													</fieldset>
													<fieldset class="form-group floating-label-form-group">
														<fieldset class="form-group floating-label-form-group">
															<label for="ket">Keterangan</label>
															<input type="text" class="form-control" name="ket" id="ket" placeholder="Keterangan">
														</fieldset>
													</fieldset>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="close">
									<button id="btn-submitnilai" type="submit" class="btn btn-outline-primary btn-lg">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
        </div>
    </div>
</div>