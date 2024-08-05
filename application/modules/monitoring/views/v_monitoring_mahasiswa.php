<div class="container-fluid">
    <div class="row">
        <div id="tabel" class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Monitoring Mahasiswa</h3>
                    <div class="card-tools">
                        <div class="row">
                            <div class="col">
                                <select id="jurusanDropdown" class="form-control">
                                    <option value="">Select Jurusan</option>
                                    <!-- Options akan ditambahkan melalui AJAX -->
                                </select>
                            </div>
                            <div class="col">
                                <select id="yearDropdown" class="form-control">
                                    <!-- Options will be populated by AJAX -->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-3">
                    <table id="guidanceTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Name</th>
                                <th>Tahun Masuk</th>
                                <th>Jurusan</th>
                                <th>Judul</th>
                                <th>Berapa Kali Bimbingan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>