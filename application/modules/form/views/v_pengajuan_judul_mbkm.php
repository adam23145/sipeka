<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-primary">
				<div class="card-header">
                	<h3 class="card-title">Form Pengajuan Judul Mbkm</h3>
              	</div>
              	<form id="form-submtitle" method="POST">
              		<input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
              		<div class="card-body">
              			<div class="form-group">
		                    <input type="hidden" class="form-control" id="sub_code" name="sub_code" value="{subm_id}" readonly="true">
		                </div>
              			<div class="form-group">
		                    <label for="nama">Nama</label>
		                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $this->session->userdata['logged_in']['username'] ?>" readonly="true">
		                </div>
		                <div class="form-group">
		                    <label for="nim">Nim</label>
		                    <input type="text" class="form-control" id="nim" name="nim" value="<?php echo substr($this->session->userdata['logged_in']['userid'], 0,12) ?>" readonly="true">
		                </div>
		                <div class="form-group">
		                    <label for="majorname">Program Studi</label>
		                    <input type="text" class="form-control" id="majorname" name="majorname" value="{majorname}" readonly="true">
		                </div>
		                <div class="form-group">
		                    <label for="judul">Judul</label>
		                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Input Judul" required="">
		                </div>
		                <div class="form-group">
		                    <label for="rumusah_masalah">Rumusan Masalah</label>
		                    <textarea class="form-control" rows="5" placeholder="Rumusan Masalah ..." id="rumusah_masalah" name="rumusah_masalah" required=""></textarea>
		                </div>
		                <div class="form-group">
		                    <label for="urgensi">Urgensi</label>
		                    <textarea class="form-control" rows="5" placeholder="Urgensi ..." id="urgensi" name="urgensi" required=""></textarea>
		                </div>
              		</div>
              		<div class="card-footer">
              			<div class="row">
              			<div class="col-md-9">
              				<label for=""></label>
              			</div>
              			<div class="col-md-3">
              				<!-- <button type="submit" style="margin-left: 30px;" class="btn btn-danger">Batalkan</button> -->
              				<button id="btn-submit" type="submit" class="btn btn-info float-right">Simpan</button>	                  		
              			</div>
              			</div>
	                </div>
              	</form>
			</div>
		</div>
	</div>
</div>

