<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.jqueryui.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

        var table = $('#table_sidang').DataTable({
            initComplete: function() {
                var api = this.api();
                $('#table_sidang_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode === 13) { // Enter key
                            api.search(this.value).draw();
                        }
                    });
                table.buttons().container()
                    .appendTo('#disini');
            },
            language: {
                processing: "Loading..."
            },
            processing: true,
            serverSide: true,
            paging: true,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true, // Aktifkan jika diperlukan
            ajax: {
                url: "<?php echo site_url('data_master/data_sidang/get_data'); ?>",
                type: "POST",
                data: function(d) {
                    d[csrfName] = csrfHash; // Include CSRF token in the request
                }
            },
            columns: [{
                    data: "nim"
                },
                {
                    data: "judul_sidang"
                },
                {
                    data: "nama_mahasiswa"
                },
                {
                    data: "status"
                },
                {
                    data: "tanggal_sidang"
                },
                {
                    data: "tempat_sidang"
                },
                {
                    data: "jam_mulai"
                },
                {
                    data: "jam_selesai"
                },
                {
                    data: "action"
                }
            ],
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel"></i> Export to Excel', // Menambahkan ikon dan teks
                className: 'btn btn-success mt-3 ml-3', // Kelas Bootstrap untuk styling
                title: 'Rekap Data Sidang', // Judul file Excel yang diunduh
                messageTop: 'List Skripsi',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            }]
        });

        $('#table_sidang').on('click', '.edit-btn', function() {
            var sidang_id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('data_master/data_sidang/get_sidang'); ?>",
                type: "POST",
                data: {
                    id: sidang_id,
                    [csrfName]: csrfHash
                },
                dataType: "json",
                success: function(response) {
                    var data = response.sidang;
                    var data_dosen = response.data_dosen;

                    // Mengisi form dengan data sidang
                    $('#sidang_id').val(data.id);
                    $('#edit_status').val(data.status).change();
                    $('#edit_tanggal_sidang').val(data.tanggal_sidang);
                    $('#edit_tempat_sidang').val(data.tempat_sidang);

                    // Kosongkan dan isi ulang dropdown pembimbing, penguji1, penguji2 dengan data dosen
                    var pembimbingOptions = '';
                    var penguji1Options = '';
                    var penguji2Options = '';

                    $.each(data_dosen, function(index, dosen) {
                        pembimbingOptions += '<option value="' + dosen.nama + '">' + dosen.nama + '</option>';
                        penguji1Options += '<option value="' + dosen.nama + '">' + dosen.nama + '</option>';
                        penguji2Options += '<option value="' + dosen.nama + '">' + dosen.nama + '</option>';
                    });

                    $('#edit_pembimbing').html(pembimbingOptions).trigger('change');
                    $('#edit_penguji1').html(penguji1Options).trigger('change');
                    $('#edit_penguji2').html(penguji2Options).trigger('change');

                    // Initialize Select2
                    $('.select2').select2();

                    // Fungsi untuk menonaktifkan opsi yang dipilih di dropdown lain
                    function disableDuplicateOptions() {
                        var selectedPembimbing = $('#edit_pembimbing').val();
                        var selectedPenguji1 = $('#edit_penguji1').val();
                        var selectedPenguji2 = $('#edit_penguji2').val();

                        // Nonaktifkan opsi yang sudah dipilih di dropdown lain
                        $('#edit_pembimbing option').prop('disabled', false);
                        $('#edit_penguji1 option').prop('disabled', false);
                        $('#edit_penguji2 option').prop('disabled', false);

                        if (selectedPembimbing) {
                            $('#edit_penguji1 option[value="' + selectedPembimbing + '"]').prop('disabled', true);
                            $('#edit_penguji2 option[value="' + selectedPembimbing + '"]').prop('disabled', true);
                        }
                        if (selectedPenguji1) {
                            $('#edit_pembimbing option[value="' + selectedPenguji1 + '"]').prop('disabled', true);
                            $('#edit_penguji2 option[value="' + selectedPenguji1 + '"]').prop('disabled', true);
                        }
                        if (selectedPenguji2) {
                            $('#edit_pembimbing option[value="' + selectedPenguji2 + '"]').prop('disabled', true);
                            $('#edit_penguji1 option[value="' + selectedPenguji2 + '"]').prop('disabled', true);
                        }
                    }

                    // Panggil fungsi disableDuplicateOptions saat dropdown berubah
                    $('#edit_pembimbing, #edit_penguji1, #edit_penguji2').on('change', disableDuplicateOptions);

                    // Menampilkan atau menyembunyikan field berdasarkan status
                    if (data.status == 2) { // Diterima
                        $('#tanggal_sidang_group').show();
                        $('#tempat_sidang_group').show();
                        $('#edit_pembimbing_group').show();
                        $('#edit_penguji1_group').show();
                        $('#edit_penguji2_group').show();
                    } else { // Menunggu or Ditolak
                        $('#tanggal_sidang_group').hide();
                        $('#tempat_sidang_group').hide();
                        $('#edit_pembimbing_group').hide();
                        $('#edit_penguji1_group').hide();
                        $('#edit_penguji2_group').hide();
                    }

                    // Tampilkan modal edit
                    $('#editModal').modal('show');

                    // Panggil fungsi disableDuplicateOptions setelah dropdown diisi
                    disableDuplicateOptions();
                }
            });
        });


        $('#edit_status').change(function() {
            if ($(this).val() == 2) { // Diterima
                $('#tanggal_sidang_group').show();
                $('#tempat_sidang_group').show();
                $('#edit_pembimbing_group').show();
                $('#edit_penguji1_group').show();
                $('#edit_penguji2_group').show();
                $('#jam_selesai_group').show();
                $('#jam_mulai_group').show();
            } else { // Menunggu or Ditolak
                $('#tanggal_sidang_group').hide();
                $('#tempat_sidang_group').hide();
                $('#edit_pembimbing_group').hide();
                $('#edit_penguji1_group').hide();
                $('#edit_penguji2_group').hide();
                $('#jam_selesai_group').hide();
                $('#jam_mulai_group').hide();
            }
        });

        $('#editForm').submit(function(e) {
            e.preventDefault();

            // Mengambil semua field form
            var formData = $(this).serializeArray();
            var isValid = true;
            var errorMessage = '';

            // Mengecek setiap field untuk memastikan tidak ada yang kosong
            formData.forEach(function(field) {
                if (!field.value) {
                    isValid = false;
                    errorMessage += 'Field ' + field.name + ' tidak boleh kosong.\n';
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: errorMessage,
                    confirmButtonText: 'OK'
                });
                return; // Hentikan proses jika ada field yang kosong
            }

            $.ajax({
                url: "<?php echo site_url('data_master/data_sidang/update'); ?>",
                type: "POST",
                data: $(this).serialize() + '&' + csrfName + '=' + csrfHash,
                success: function(response) {
                    // Menampilkan SweetAlert jika sukses
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data berhasil diperbarui.',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        $('#editModal').modal('hide');
                        table.ajax.reload();
                    });
                },
                error: function(xhr, status, error) {
                    // Menampilkan SweetAlert jika terjadi error
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat memperbarui data.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });


    });
</script>