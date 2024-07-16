<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-file"></i>
                      Search Daftar Judul
                    </h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <form id="form-search-report" method="POST">
                        <div class="callout callout-info">
                            <div class="info-box-content">
                                <div class="card-body">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="text-align: right;" class="col-form-label col-md-3">Angkatan</label>
                                                <div class="col-md-4">
                                                    <input id="datepicker" name="datepicker" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-footer bg-light" style="text-align: center;">
                                                <button type="submit" class="btn btn-info" id="btn-search"><i class="la la-search" style="color: white;"></i>Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div id="card-loading" class="col-md-12" style="text-align: center; display: none;">
                            <div class="preloader pl-xl pls-primary">
                                <svg class="pl-circular" viewBox="25 25 50 50">
                                    <circle class="plc-path" cx="50" cy="50" r="20"></circle>
                                </svg>
                            </div>
                        </div>
                        <div id="disini" class="col-md-12"></div>
                        <div id="card-table-skripsi" class="table-responsive">
                            <table id="tableSkripsi" class="table table-hover table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nim</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Judul Skripsi</th>
                                        <th>NIP Dosen Pembimbing</th>
                                        <th>Nama Dosen Pembimbing</th>
                                        <th>Total Bimbingan</th>
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