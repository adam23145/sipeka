<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div id="image-profil" class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url();?>{imagedir}" alt="User profile picture">
          </div>
          <h3 class="profile-username text-center">{nama_kary}</h3>
          <p class="text-muted text-center">{group_m}</p>
          <button data-toggle="modal" data-target=".upload-foto" type="button" class="btn btn-primary btn-block"><b>Change picture</b></button>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Edit Profile</a></li>
          </ul>
        </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="profile">
              	<form class="form-horizontal" id="form-profil" method="POST">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <div class="form-group row">
                    <label for="inputuserID" class="col-sm-2 col-form-label">UserID</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputuserID" name="inputuserID" readonly="true" value="<?php echo $this->session->userdata['logged_in']['userid'] ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="inputName" value="{nama_kary}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="{email}" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger float-right">Submit</button>
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
<div id="modal-upload-foto" class="modal modal-bottom-left-corner fade upload-foto" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Unggah Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="zmdi zmdi-close"></span>
                </button>
            </div>
            <form id="form-upload-foto" method="POST">
                <div class="modal-body">
                    <div class="form-group p-t-15">
                        <div class="input-group">
                          <div class="custom-file">
                              <input type="file" class="custom-file-input" multiple="" name="pas_foto" id="pas_foto" required="">
                              <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                          </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <p><small><i>Note: Maksimal ukuran file 2 MB dengan format .jpg atau .jpeg</i></small></p>
                    </div>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>