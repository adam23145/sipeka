<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Master Group Mapping</h3>
                    <div style="float: right;">
                        <button id="btnTambah" class="btn btn-block bg-gradient-primary btn-sm" >
                            <i style="color: white;" class="fa fa-plus"></i> Add Group Mapping
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="table-Mapping" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Userid</th>
                                <th>Fullname</th>
                                <th>Group Name</th>
                                <th>Group Level</th>
                                <th>Status</th>
                                <th>Upd</th>
                                <th>Last Update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <div class="modal fade text-left" id="modalMapping" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
            aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="myModalLabel35"> Add Mapping Group</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form id="form-editMappingG" method="POST">
                                    <input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <div class="modal-body">
                                        <input type="hidden" class="form-control" id="id" name="id" value="0">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="userid">Userid</label>
                                            <select class="custom-select d-block w-100" name="userid" id="userid" required="">
                                                <option value="">-- Select Userid --</option>
                                                {data_login}
                                                <option value="{userid}">{userid}</option>
                                                {/data_login}
                                            </select>
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="group">Group Name</label>
                                            <select class="custom-select d-block w-100" name="group" id="group" required="">
                                                <option value="">-- Select Group Name --</option>
                                                {data_group}
                                                <option value="{group}">{group}</option>
                                                {/data_group}
                                            </select>
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="g_level">Group Level</label>
                                            <select class="custom-select d-block w-100" name="g_level" id="g_level" required="">
                                                <option value="">-- Select Group Level --</option>
                                                {data_gl}
                                                <option value="{g_level}">{g_level}</option>
                                                {/data_gl}
                                            </select>
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="status">Status</label>
                                            <select class="custom-select d-block w-100" id="status" name="status">
                                                <option selected>-- Select Status --</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Non Active</option>
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
            </div>
        </div>
    </div>
</div>