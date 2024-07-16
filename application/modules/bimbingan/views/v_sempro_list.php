<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-file"></i>
                      Search List Sempro
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
                                        <input id="nmmhs" name="nmmhs" class="form-control" type="hidden" readonly="true" value="0" >
                                        <input id="lpl" name="lpl" class="form-control" type="hidden" readonly="true" value="{lpl}" >
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label style="text-align: right;" class="col-form-label col-md-3">Nama Mahasiswa</label>
                                                <div class="col-md-7">
                                                    <select class="select2" multiple="multiple" id="nama_mhs" id="nama_mhs" data-placeholder="Pilih Nama Mahasiswa" style="width: 100%;">
                                                        {get_mahasiswa}
                                                            <option value="{nim}">{nama}</option>
                                                        {/get_mahasiswa}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
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
                    <div class="card-body">
                        <div id="disini" class="col-md-12"></div>
                        <div id="card-table-sempro" class="table-responsive">
                            <table id="table-sempro" class="table table-hover table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nim</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Prodi</th>
                                        <th>Judul</th>
                                        <th>URL</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Nama Dosen</th>
                                        <th>Awal Bimbingan Sempro</th>
                                        <th>Akhir Bimbingan Sempro</th>                                        
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