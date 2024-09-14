<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-primary">
				<div class="card-header">
                	<h3 class="card-title">Form Seminar Proposal</h3>
              	</div>
              	<form id="form-submtitle" method="POST">
              		<input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
              		<input required type="text" readonly hidden name="sub_code" id="sub_code" value="{sub_code}">
              		<input required type="text" readonly hidden name="dosbing" id="dosbing" value="{dosbing}">
              		<div class="card-body">
              			<div class="row">
              				<div class="col-md-6">
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
				                    <input type="text" class="form-control" id="judul" name="judul" value="{judul}" >
				                </div>
              				</div>
              				<input type="hidden" class="form-control" id="dosbing" name="dosbing" value="{dosbing}" >
              				<div class="col-md-6">
				                <div class="form-group">
				                    <label for="rumusah_masalah">Tanggal Sempro</label>
				                    <div class="input-group">
					                    <div class="input-group-prepend">
					                      <span class="input-group-text">
					                        <i class="far fa-calendar-alt"></i>
					                      </span>
					                    </div>
					                    <input id="tanggal" name="tanggal" class="form-control" required="">
					                </div>
				                </div>
				                <div class="form-group">
				                  <label>Penguji</label>
				                  <select class="select2" multiple="multiple" id="penguji" id="penguji" data-placeholder="Pilih Penguji" style="width: 100%;" required="">
				                    {get_dosen}
                                    	<option value="{kode_dosen}">{nama}</option>
                                    {/get_dosen}
				                  </select>
				                </div>
				                <input id="dsnpenguji" name="dsnpenguji" class="form-control" type="hidden">
				                <div class="form-group">
				                  <label>Form Penilaian Sempro .PDF</label>
				                  <div class="form-group p-t-15">
                                        <div class="input-group">
                                          <div class="custom-file">
                                              <input type="file" class="custom-file-input" multiple="" name="file_ba" id="file_ba" required="">
                                              <label class="custom-file-label" for="validatedCustomFile">Pilih file...</label>
                                          </div>
                                        </div>
                                    </div>
				                </div>
				                <div class="form-group">
				                  <label>Proposal .PDF <p style="font-style: italic;">Maks 5Mb</p></label>
				                  <div class="form-group p-t-15">
                                        <div class="input-group">
                                          <div class="custom-file">
                                              <input type="file" class="custom-file-input" multiple="" name="file_prop" id="file_prop" required="">
                                              <label class="custom-file-label" for="validatedCustomFile">Pilih file...</label>
                                          </div>
                                        </div>
                                    </div>
				                </div>
              				</div>
              			</div>		                
              		</div>
              		<div class="card-footer">
              			<div class="row">
              			<div class="col-md-9">
              				<label for=""></label>
              			</div>
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

