<script type="text/javascript">
    $(document).ready(function() {
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

        var table = $('#table_pengajuan').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('history/publikasi/get_data'); ?>",
                "type": "POST",
                "data": function(d) {
                    d[csrfName] = csrfHash;
                }
            },
            "columns": [{
                    "data": "jenis_tugas_akhir"
                },
                {
                    "data": "judul_tugas_akhir"
                },
                {
                    "data": "nama_mahasiswa"
                },
                {
                    "data": "nim"
                },
                {
                    "data": "tanggal_pengajuan"
                },
                {
                    "data": "dosen_pembimbing"
                },
                {
                    "data": "status_pengajuan"
                }
            ],
            "language": {
                "emptyTable": "Tidak ada data yang tersedia di tabel",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ total entri)",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "loadingRecords": "Memuat...",
                "processing": "Sedang diproses...",
                "search": "Cari:",
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                },
                "aria": {
                    "sortAscending": ": aktifkan untuk mengurutkan kolom secara ascending",
                    "sortDescending": ": aktifkan untuk mengurutkan kolom secara descending"
                }
            }
        });
    });
</script>
<script>
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

    $(document).on('click', '.btn-revisi', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "<?php echo site_url('history/Publikasi/get_revisi'); ?>",
            method: 'POST',
            data: {
                id: id,
                [csrfName]: csrfHash
            },
            success: function(response) {
                var data = JSON.parse(response);
                // console.log(data);

                if (data.status === 'success') {
                    var modalContent = `
                <div class="table-responsive mt-3">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Nama Mahasiswa</strong></td>
                            <td>:</td>
                            <td>${data.data.nama_mahasiswa || '-'}</td>
                        </tr>
                        <tr>
                            <td><strong>Dosen Pembimbing Utama</strong></td>
                            <td>:</td>
                            <td>${data.data.dosen_pembimbing_utama || '-'}</td>
                        </tr>
                    </table>
                </div>
                <div class="mt-3">
                    <strong>Keterangan Revisi</strong>
                    <div class="p-2 mt-1" style="background-color: red; color: white; word-wrap: break-word; word-break: break-word;">
                        ${data.data.revisi ? data.data.revisi : '-'}
                    </div>
                </div>
                <div class="mt-3">
                    <label for="judulRevisi">Update Judul Revisi:</label>
                    <input type="text" id="judulRevisi" class="form-control" value="${data.data.judul_tugas_akhir || ''}">
                </div>
                <div class="form-group mt-3">
                    <label>Revisi Dokumen :</label>
                    <div class="form-group p-t-15">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" multiple name="dokumen_pendukung" id="dokumen_pendukung" required>
                                <label class="custom-file-label" for="dokumen_pendukung">Pilih file...</label>
                            </div>
                        </div>
                    </div>
                </div>
                `;

                    $('#modalContent').html(modalContent);
                    $('#modalRevisi').modal('show');
                    $('#saveRevisi').data('id', data.data.id);

                    // Menangani perubahan file untuk menampilkan nama file yang dipilih
                    $('#dokumen_pendukung').on('change', function() {
                        var fileName = $(this).val().split('\\').pop();
                        $(this).next('.custom-file-label').html(fileName);
                    });

                } else {
                    swal("Error!", data.message, "error");
                }
            },
            error: function() {
                swal("Error!", "Terjadi kesalahan saat memuat data.", "error");
            }
        });
    });



    $(document).on('click', '#saveRevisi', function() {
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        var id = $(this).data('id');
        var judulRevisi = $('#judulRevisi').val();

        // Create FormData object
        var formData = new FormData();
        formData.append('id', id);
        formData.append('judulRevisi', judulRevisi);
        formData.append(csrfName, csrfHash);

        // Get the uploaded file
        var file = $('#dokumen_pendukung')[0].files[0]; // Get the first file only
        if (file) {
            formData.append('dokumen_pendukung', file); // Append the single file
        }

        $.ajax({
            url: "<?php echo site_url('history/Publikasi/update_revisi'); ?>",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // console.log(response);
                var data = JSON.parse(response);

                if (data.status === 'success') {
                    swal("Berhasil!", data.message, "success").then(() => {
                        $('#modalRevisi').modal('hide');
                        location.reload();
                    });
                } else {
                    swal("Error!", data.message, "error");
                }
            },
            error: function() {
                swal("Error!", "Terjadi kesalahan saat memperbarui data.", "error");
            }
        });
    });
</script>