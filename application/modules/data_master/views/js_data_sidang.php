<script type="text/javascript">
    $(document).ready(function() {
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

        var table = $('#table_sidang').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('data_master/data_sidang/get_data'); ?>",
                "type": "POST",
                "data": function(d) {
                    d[csrfName] = csrfHash; // Include CSRF token in the request
                }
            },
            "columns": [{
                    "data": "nim"
                },
                {
                    "data": "judul_sidang"
                },
                {
                    "data": "nama_mahasiswa"
                },
                {
                    "data": "status"
                },
                {
                    "data": "tanggal_sidang"
                },
                {
                    "data": "tempat_sidang"
                },
                {
                    "data": "action"
                }
            ]
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
                success: function(data) {
                    $('#sidang_id').val(data.id);
                    $('#edit_status').val(data.status).change();
                    $('#edit_tanggal_sidang').val(data.tanggal_sidang);
                    $('#edit_tempat_sidang').val(data.tempat_sidang);

                    // Clear the current options in the dropdown
                    $('#edit_pembimbing').empty();

                    // Populate the dropdown with data from the server
                    $.each(data.data_dosen, function(index, dosen) {
                        $('#edit_pembimbing').append(new Option(dosen.name, dosen.id));
                    });

                    // Select the current pembimbing
                    $('#edit_pembimbing').val(data.pembimbing_id).change();

                    // Show/hide fields based on status
                    if (data.status == 2) { // Diterima
                        $('#tanggal_sidang_group').show();
                        $('#tempat_sidang_group').show();
                    } else { // Menunggu or Ditolak
                        $('#tanggal_sidang_group').hide();
                        $('#tempat_sidang_group').hide();
                    }

                    $('#editModal').modal('show');
                }

            });
        });

        $('#edit_status').change(function() {
            if ($(this).val() == 2) { // Diterima
                $('#tanggal_sidang_group').show();
                $('#tempat_sidang_group').show();
            } else { // Menunggu or Ditolak
                $('#tanggal_sidang_group').hide();
                $('#tempat_sidang_group').hide();
            }
        });

        $('#editForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url('data_master/data_sidang/update'); ?>",
                type: "POST",
                data: $(this).serialize() + '&' + csrfName + '=' + csrfHash,
                success: function(response) {
                    $('#editModal').modal('hide');
                    table.ajax.reload();
                }
            });
        });
    });
</script>