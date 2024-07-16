<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-file"></i>
                      Search Dosen
                    </h3>
                </div>
                <div class="card-body">
                    <form id="form-search-report" method="POST">
                        <div class="callout callout-info">
                            <div class="info-box-content">
                                <div class="card-body">
                                    <br>
                                    <div class="row">
                                        <input id="jrsn" name="jrsn" class="form-control" type="hidden" readonly="true" value="0" >
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="text-align: right;" class="col-form-label col-md-3">Jurusan</label>
                                                <div class="col-md-7">
                                                    <select class="custom-select d-block w-100" name="jurusan" id="jurusan" >
                                                        <option value="">-- Pilih Jurusan --</option>
                                                        {data_prodi}
                                                        <option value="{major_name}">{major_name}</option>
                                                        {/data_prodi}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-footer bg-light" style="float: left;">
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
                        <!-- <div id="card-loading" class="col-md-12" style="text-align: center; display: none;">
                            <div class="preloader pl-xl pls-primary">
                                <svg class="pl-circular" viewBox="25 25 50 50">
                                    <circle class="plc-path" cx="50" cy="50" r="20"></circle>
                                </svg>
                            </div>
                        </div> -->
                        <div id="card-table-skripsi" class="table-responsive">
                            <table id="tableSkripsi" class="table table-hover table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nip</th>
                                        <th>Nama Dosen</th>
                                        <th>Jumlah Mahasiswa Bimbingan</th>
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