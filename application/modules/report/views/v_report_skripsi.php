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
                                <br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="text-align: right;" class="col-form-label col-md-3">Tanggal</label>
                                                <div class="col-md-3">
                                                    <input id="datepicker" name="datepicker" class="form-control" >
                                                </div>
                                                <label style="text-align: center;" class="col-form-label col-md-1">s.d</label>
                                                <div class="col-md-3">
                                                    <input id="datepicker2" name="datepicker2" class="form-control" >
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="text-align: right;" class="col-form-label col-md-3">Jurusan</label>
                                                <div class="col-md-7">
                                                    <select class="custom-select d-block w-100" name="jurusan" id="jurusan" >
                                                        <option value="">-- Pilih Jurusan --</option>
                                                        {jurusan}
                                                        <option value="{major_name}">{major_name}</option>
                                                        {/jurusan}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input id="nmmhs" name="nmmhs" class="form-control" type="hidden" readonly="true" value="0" >
                                        <input id="jrsn" name="jrsn" class="form-control" type="hidden" readonly="true" value="0" >
                                    </div>
                                </div>
                                <div class="card-footer bg-light" style="text-align: center;">
                                    <button style="width: 117px" type="submit" class="btn btn-info" id="btn-search"><i class="la la-search" style="color: white;"></i>Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-body table-responsive p-0">
                        <div id="disini" class="col-md-12"></div>
                        <div id="card-table-skripsi" class="table-responsive">
                            <table id="table-skripsi" class="table table-hover table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nim</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Jurusan</th>
                                        <th>Judul</th>
                                        <th>Awal Bimbingan</th>
                                        <th>Akhir Bimbingan</th>
                                        <th>Dosen Pembimbing</th>
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