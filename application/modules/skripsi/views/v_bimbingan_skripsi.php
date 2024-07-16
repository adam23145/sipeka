<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-file"></i>
                      Search Skripsi
                    </h3>
                </div>
                <div class="card-body">
                    <form id="form-search-report" method="POST">
                        <div class="callout callout-info">
                            <div class="info-box-content">

                                <div class="card-body">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="text-align: right;" class="col-form-label col-md-3">Date Range</label>
                                                <div class="col-md-4">
                                                    <input id="datepicker" name="datepicker" class="form-control" >
                                                </div>
                                                <label style="text-align: right;" class="col-form-label col-md-1">To</label>
                                                <div class="col-md-4">
                                                    <input id="datepicker2" name="datepicker2" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                        <input id="jrsn" name="jrsn" class="form-control" type="hidden" readonly="true" value="0" >
                                        <?php 
                                        $lepel = $this->session->userdata['logged_in']['userlevel'];
                                            if($lepel == 'Dosen'){

                                            }else{


                                        ?>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="text-align: right;" class="col-form-label col-md-3">Prodi</label>
                                                <div class="col-md-7">
                                                    <select class="custom-select d-block w-100" name="jurusan" id="jurusan" >
                                                        <option value="">-- Pilih Prodi --</option>
                                                        {jurusan}
                                                        <option value="{major_name}">{major_name}</option>
                                                        {/jurusan}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="card-footer bg-light" style="text-align: center;">
                                    <button type="submit" class="btn btn-info" id="btn-search"><i class="la la-search" style="color: white;"></i>Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-body table-responsive p-0">
                        <!-- <div id="card-loading" class="col-md-12" style="text-align: center; display: none;">
                            <div class="preloader pl-xl pls-primary">
                                <svg class="pl-circular" viewBox="25 25 50 50">
                                    <circle class="plc-path" cx="50" cy="50" r="20"></circle>
                                </svg>
                            </div>
                        </div> -->
                        <div id="disini" class="col-md-12"></div>
                       <!--  <div id="card-loading" class="col-md-12" style="text-align: center; display: none;">
                            <div class="preloader pl-xl pls-primary">
                                <svg class="pl-circular" viewBox="25 25 50 50">
                                    <circle class="plc-path" cx="50" cy="50" r="20"></circle>
                                </svg>
                            </div>
                        </div> -->
                        <div id="card-table-skripsi" class="table-responsive">
                            <table id="table-skripsi" class="table table-hover table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nim</th>
                                        <th>Mahasiswa</th>
                                        <th>Prodi</th>
                                        <th>Judul</th>
                                        <th>URL bimbingan</th>
                                        <th>Awal Bimbingan</th>
                                        <th>Akhir Bimbingan</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Nama Dosen</th>
                                        <th>Catatan</th>
                                        <th>Status</th>
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