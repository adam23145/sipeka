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
                  <!-- <li class="list-group-item">
                    <b>Dosen Pembimbing</b>
                    <div id="document-room" class="card-body">
                    	<div id="document-list">
	               	 		<button type="button" class="btn btn-info btn-block">.btn-block</button>
	               	 	</div>
	              	</div>
                  </li> -->
                </ul>
              </div>
            </div>
		</div>
		<div class="col-md-9">
			<div class="card card-primary card-outline">
				<div class="card-header p-2">
	                <ul class="nav nav-pills">
	                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Aktivitas</a></li>
	                </ul>
	             </div>
	             <div class="card-body">
	             	<input type="hidden" id="sub_code" name="sub_code" value="{sub_code}">
	             	<div class="tab-content">
	             		<div class="active tab-pane" id="activity">
		             		<div class="dataTables_wrapper dt-bootstrap4">
		             			<table id="table-submstatus" class="table table-bordered table-hover">
			                        <thead>
			                            <tr>
			                                <th>No</th>
			                                <th>Tanggal Bimbingan</th>
			                                <th>Status</th>
			                                <th>Catatan</th>
			                                <th>Updater</th>
			                            </tr>
			                        </thead>
			                        <tbody>
			                        </tbody>
			                    </table>
		             		</div>
	             		</div>
	             	</div>
	             </div>
			</div>
		</div>
	</div>
</div>

