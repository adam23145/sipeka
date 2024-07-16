<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Master Data Login</h3>
                    <div style="float: right;">
                        <button id="btnTambah" class="btn btn-block bg-gradient-primary btn-sm" >
                            <i style="color: white;" class="fa fa-plus"></i> Add Login
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
                    <table id="tableLogin" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Userid</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                            <div class="modal fade text-left" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
                    aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="addlogin"> Add Login</h5>
                                          <h5 class="modal-title" id="edlogin"> Edit Login</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <form id="form-editLogin" method="POST">
                                            <input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                            <div class="modal-body">
                                                <input type="hidden" class="form-control" id="id" name="id" value="0">
                                                <fieldset class="form-group floating-label-form-group">
                                                    <label for="email">Userid</label>
                                                    <input type="text" class="form-control" name="userid" id="userid" name="" placeholder="User ID">
                                                </fieldset>
                                                <fieldset class="form-group floating-label-form-group">
                                                    <label for="email">Name</label>
                                                    <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Nama">
                                                </fieldset>
                                                <fieldset class="form-group floating-label-form-group">
                                                    <label for="email">Email Address</label>
                                                    <input type="text" class="form-control" name="email" id="email" placeholder="Alamat Email">
                                                </fieldset>
                                                <fieldset class="form-group floating-label-form-group">
                                                    <label for="title">Level</label>
                                                    <select class="custom-select d-block w-100" name="level" id="level" required="">
                                                        <option value="">-- Select Level --</option>
                                                        {data_level}
                                                        <option value="{level}">{level}</option>
                                                        {/data_level}
                                                    </select>
                                                </fieldset>
                                                <fieldset class="form-group floating-label-form-group">
                                                    <label for="title">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                                </fieldset>
                                                <fieldset class="form-group floating-label-form-group">
                                                    <label for="title">Status</label>
                                                    <select class="custom-select d-block w-100" id="status" name="status">
                                                        <option selected>-- Select Status --</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Non Aktif</option>
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
                                  <h5 class="modal-title" id="myModalLabel35"> Upload Data Login</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form id="form-uploadLogin" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="fileupload">File</label>
                                            <input id="fileupload" name="fileupload" type="file">
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <div>
                                            <a href="../document/files/Template-Login.xlsx" target="_blank" style="float: right;" class="btn btn-tool bg-gradient-primary btn-sm" >
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
                                <input type="hidden" class="form-control" name="id_lgn" id="id_lgn" >
                                <input type="hidden" class="form-control" name="userid" id="userid" >
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