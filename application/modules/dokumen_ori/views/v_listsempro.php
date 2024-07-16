<div class="container-fluid">
    <div class="row">
        <div id="tabel" class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-body table-responsive p-0">
                    <table id="table-sempro" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nim</th>
                                <th>Judul</th>
                                <th>Dosen penguji</th>
                                <th>Tanggal Sempro</th>
                                <th>File ba sempro</th>
                                <th>File proposal</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="modal fade text-left" id="modalhistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
    aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="myModalLabel35"> Edit Pengajuan Judul</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form id="form-submission" method="POST">
                            <input required type="text" readonly hidden name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="modal-body">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="submission_code">No Pengajuan Judul</label>
                                    <input type="text" class="form-control" name="submission_code" id="submission_code" name="" readonly="true">
                                </fieldset>
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="title">Judul</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Input Judul">
                                </fieldset>
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="rms_maslh">Rumusan Masalah</label>
                                    <textarea class="form-control" rows="7"  id="rms_maslh" name="rms_maslh"></textarea>
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