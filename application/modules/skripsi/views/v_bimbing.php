<div class="container-fluid">
	<div class="card card-default color-palette-box">
		<div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-tag"></i>
               Form Bimbingan Skripsi
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
	              	<dt class="col-sm-4">Prodi</dt>
	              	<dd class="col-sm-8">{jurusan}</dd>
	              	<dt class="col-sm-4">Judul Skripsi</dt>
	              	<dd class="col-sm-8">{judul}</dd>
	              	<dt class="col-sm-4">Tanggal Awal Bimbingan Skripsi</dt>
	              	<dd class="col-sm-8">{createddate}</dd>
	              	<dt class="col-sm-4">Tanggal Terakhir Bimbingan Skripsi</dt>
	              	<dd class="col-sm-8">{tanggal2}</dd>
	              	<dt class="col-sm-4">Bimbingan Skripsi Ke</dt>
	              	<dd class="col-sm-8">{bimb_no}</dd>
	              	<dt class="col-sm-4">Rumusan Masalah</dt>
	              	<dd class="col-sm-8">{rumusan}</dd>
	              	<dt class="col-sm-4">Urgensi</dt>
	              	<dd class="col-sm-8">{urgensi}</dd>
	              	<dt class="col-sm-4">Status</dt>
	              	<dd class="col-sm-8">{sub_status}</dd>
	              	<dt class="col-sm-4">URL</dt>
	              	<dd class="col-sm-8">{url_judulbimbingan}</dd>
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
            				<div class="card-body table-responsive p-0">
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
	              	<div class="col-md-4">
	              		<div class="card card-primary card-outline">
	              			<div class="card-body">
			              		<form id="form-bimbinganSkripsi" method="POST">
			              			<input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
			             			<div class="form-group">
					                    <input type="hidden" class="form-control" id="sub_code" name="sub_code" value="{sub_code}" readonly="true">
					                    <input type="hidden" class="form-control" id="nobim" name="nobim" value="{bimb_no}" readonly="true">
					                    <input type="hidden" class="form-control" id="nim" name="nim" value="{nim}" readonly="true">
					                    <input type="hidden" class="form-control" id="judul" name="judul" value="{judul}" readonly="true">
					                    <input type="hidden" class="form-control" id="dosbing" name="dosbing" value="{dosbing}" readonly="true">
					                </div>
					                <div class="form-group">
					                    <label for="sub_status">Tanggal</label>
					                    <input class="form-control" type="text" id="tanggal" name="tanggal" placeholder="Pilih Tanggal" required>
					                </div>
					                <div class="form-group">
					                    <label for="sub_status">Status</label>
					                    <select class="custom-select d-block w-100" id="sub_status" name="sub_status" required>
					                    	<option value="">-- Pilih Status --</option>
					                    	{status_bimbingan}
					                    	<option value="{option_name}">{option_name}</option>
					                    	{/status_bimbingan}
					                    </select>
					                </div>
					                <input type="hidden" class="form-control" id="stats" name="stats" readonly="true">
					                <div class="form-group">
					                    <label for="beritaacara">Keterangan</label>
					                    <textarea class="form-control" rows="6"  id="beritaacara" name="beritaacara" required></textarea>
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