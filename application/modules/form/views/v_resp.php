<div class="container-fluid">
	<div class="card card-default color-palette-box">
		<div class="card-header">
			<h3 class="card-title">
				<i class="fas fa-tag"></i>
				Detail Informasi
			</h3>
		</div>
		<div class="card-body">
			<blockquote>
				<div class="col-md-12">
					<dl class="row">
						<dt class="col-sm-4">Nim</dt>
						<dd class="col-sm-8">{nim}</dd>
						<dt class="col-sm-4">Nama</dt>
						<dd class="col-sm-8">{student_name}</dd>
						<dt class="col-sm-4">Jurusan</dt>
						<dd class="col-sm-8">{jurusan}</dd>
						<dt class="col-sm-4">Judul Skripsi</dt>
						<dd class="col-sm-8">{judul}</dd>
						<dt class="col-sm-4">Tanggal Pengajuan Judul</dt>
						<dd class="col-sm-8">{createddate}</dd>
						<dt class="col-sm-4">Rumusan Masalah</dt>
						<dd class="col-sm-8">{rumusan}</dd>
						<dt class="col-sm-4">Urgensi</dt>
						<dd class="col-sm-8">{urgensi}</dd>
						<dt class="col-sm-4">Status Pengajuan Judul</dt>
						<dd class="col-sm-8">{stts_skrip}</dd>
					</dl>
				</div>
			</blockquote>
			<hr>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-8">
						<div class="card card-primary card-outline">
							<div class="card-header">
								<h3 class="card-title">History</h3>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="table-submstatus" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>No</th>
												<th>Status</th>
												<th>Loker</th>
												<th>Keterangan</th>
												<th>Updater</th>
												<th>Last Update</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-primary card-outline">
							<div class="card-body">
								<form id="form-response" method="POST">
									<input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="form-group">
										<input type="hidden" class="form-control" id="sub_code" name="sub_code" value="{sub_code}" readonly="true">
										<input type="hidden" class="form-control" id="nama" name="nama" value="<?php echo $this->session->userdata['logged_in']['username'] ?>" readonly="true">
										<input type="hidden" class="form-control" id="lepel" name="lepel" value="<?php echo $this->session->userdata['logged_in']['userlevel'] ?>" readonly="true">
										<input type="hidden" class="form-control" id="loker" name="loker" value="{loker}" readonly="true">
										<input type="hidden" class="form-control" id="nim" name="nim" value="{nim}" readonly="true">
										<input type="hidden" class="form-control" id="majorname" name="majorname" value="{jurusan}" readonly="true">
										<input type="hidden" class="form-control" id="id_sub" name="id_sub" value="{id_sub}" readonly="true">
										<input type="hidden" class="form-control" id="judul" name="judul" value="{judul}" readonly="true">
										<input type="hidden" class="form-control" id="dsen" name="dsen" value="{dosbing}" readonly="true">
									</div>
									<div class="form-group">
										<label for="sub_status">Status</label>
										<select class="custom-select d-block w-100" id="sub_status" name="sub_status">
											<option value="">-- Pilih Status --</option>
											<option value="Terima">Terima</option>
											<option value="Tolak">Tolak</option>
										</select>
									</div>
									<input type="hidden" class="form-control" id="stats" name="stats" readonly="true">
									<input type="hidden" class="form-control" id="akstats" name="akstats" readonly="true">
									<div id="pilih_step" class="form-group">
										<label for="aksi_stat">Aksi</label>
										<select class="custom-select d-block w-100" id="aksi_stat" name="aksi_stat">
											<option value="">-- Pilih Aksi --</option>
											<option value="Revisi">Revisi</option>
											<option value="Tutup">Tutup</option>
										</select>
									</div>
									<div id="pilih_dsn" class="form-group">
										<label for="kd_dosen">Dosen Pembimbing</label>
										<select class="custom-select d-block w-100" name="kd_dosen" id="kd_dosen">
											<option value="">-- Pilih Dosen --</option>
											{data_dosen}
											<option value="{kode_dosen}">{nama}</option>
											{/data_dosen}
										</select>
									</div>
									<div id="next_loker" class="form-group">
										<label for="loker_grp">Teruskan Ke</label>
										<input type="text" class="form-control" id="loker_grp" name="loker_grp" readonly="true">
									</div>
									<div class="form-group">
										<label for="reason">Keterangan</label>
										<textarea class="form-control" rows="5" id="reason" name="reason"></textarea>
									</div>
									<button id="btn-submit" type="submit" class="btn btn-primary float-right">Simpan</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">Update Judul</h3>
					</div>
					<div class="card-body">
						<form id="updateTitleForm">
								<!-- <label for="submission_code">Submission Code</label> -->
								<input type="text" class="form-control" value="{sub_code}"  id="submission_code" name="submission_code" placeholder="Submission Code" required disabled hidden>
								<input type="text" class="form-control" value="{judul}"  id="judul2" name="judul2" placeholder="judul2" required disabled hidden>

							<div class="form-group">
								<label for="new_title">Judul Baru</label>
								<input type="text" class="form-control" id="new_title" name="new_title" placeholder="Judul Baru" required>
							</div>
							<button type="submit" id="btn-submit" class="btn btn-primary">Update Title</button>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>