<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <h3 class="profile-username text-center"><b>{judul}</b></h3>
                <p class="text-muted text-center">oleh:  {student_name}</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Nim</b> <a class="float-right">{nim}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Prodi</b> <a class="float-right">{jurusan}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Status</b> <a class="float-right">{sub_status}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Dosen Pembimbing</b> <a class="float-right">{dos_pemb}</a>
                  </li>
                  <li class="list-group-item">
                    <b>URL</b>&nbsp;&nbsp;&nbsp;&nbsp;<span class="float-right">{dpturl}</span>
                  </li>
                  <li class="list-group-item">
                    <b>Dokumen</b>
                    <div id="document-room" class="card-body">
                    	<div id="document-list">
	               	 	</div>
	              	</div>
                  </li>

                  <li class="list-group-item">
                    <div class="card-body">
                    	<span>{sttsurl}</span>
	              	</div>
                  </li>
                </ul>
              </div>
            </div>
		</div>
		<div class="col-md-9">
			<div class="card card-primary card-tabs">
				<div class="card-header p-0 pt-1">
	                <ul style="font-weight: bold;font-family: arial;font-size: 19px;" class="nav nav-tabs">
	                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Aktivitas</a></li>
	                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Form Update</a></li>
	                </ul>
	             </div>
	             <div class="card-body">
	             	<div class="tab-content">
	             		<div class="active tab-pane" id="activity">
		             		<div class="dataTables_wrapper dt-bootstrap4">
		             			<table id="table-submstatus" class="table table-bordered table-hover">
			                        <thead>
			                            <tr>
			                                <th>No</th>
			                                <th>Status</th>
			                                <th>Loker</th>
			                                <th>Notes</th>
			                                <th>Urgensi</th>
			                                <th>Updater</th>
			                                <th>Last Update</th>
			                            </tr>
			                        </thead>
			                        <tbody>
			                        </tbody>
			                    </table>
		             		</div>
	             		</div>
	             		<div class="tab-pane" id="timeline">
	             			<form id="form-editTitle" method="POST">
	             				<input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
	             				<input required type="text" readonly hidden name="sub_status" id="sub_status" value="{sub_status}">
		             			<div class="form-group">
				                    <input type="hidden" class="form-control" id="sub_code" name="sub_code" value="{sub_code}" readonly="true">
				                    <input type="hidden" class="form-control" id="nama" name="nama" value="<?php echo $this->session->userdata['logged_in']['username'] ?>" readonly="true">
				                    <input type="hidden" class="form-control" id="lepel" name="lepel" value="<?php echo $this->session->userdata['logged_in']['userlevel'] ?>" readonly="true">
				                    <input type="hidden" class="form-control" id="loker" name="loker" value="{loker}" readonly="true">
				                    <input type="hidden" class="form-control" id="nim" name="nim" value="<?php echo substr($this->session->userdata['logged_in']['userid'], 0,12) ?>" readonly="true">
				                    <input type="hidden" class="form-control" id="majorname" name="majorname" value="{jurusan}" readonly="true">
				                </div>
				                <div class="form-group">
				                    <label for="judul">Judul</label>
				                    <input type="text" class="form-control" id="judul" name="judul" value="{judul}">
				                </div>
				                <div class="form-group">
				                    <label for="rumusah_masalah">Rumusan Masalah</label>
				                    <textarea class="form-control" rows="5"  id="rumusah_masalah" name="rumusah_masalah" >{rumusan}</textarea>
				                </div>
				                <div class="form-group">
				                    <label for="urgensi">Urgensi</label>
				                    <textarea class="form-control" rows="5"  id="urgensi" name="urgensi" >{urgensi}</textarea>
				                </div>
				                <button id="btn-submit" type="submit" class="btn btn-info float-right">Simpan</button>
				            </form>
	             		</div>
	             	</div>
	             </div>
			</div>
		</div>
		<div class="form-group">
            <div class="modal fade text-left" id="modalURL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
    aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="addmhs"> Input URL</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
						
                        <form id="form-tambahURL" method="POST">
                            <input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="modal-body">
                                <input type="hidden" class="form-control" name="nim" id="nim" value="{nim}">
                                <input type="hidden" class="form-control" name="submission_code" id="submission_code" value="{submission_code}">
                                <input type="hidden" class="form-control" name="loker" id="loker" value="{loker}">
                                <input type="hidden" class="form-control" name="sub_status" id="sub_status" value="{sub_status}">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="urlbimbingan">URL</label>
                                    <input type="text" class="form-control" name="urlbimbingan" id="urlbimbingan" placeholder="URL">
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

