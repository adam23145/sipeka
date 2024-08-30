<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#table_pengajuan').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('data_master/data_publikasi/get_data'); ?>",
                "type": "POST",
                "data": function(d) {
                    d.token = "<?php echo $this->security->get_csrf_hash(); ?>";
                    d.status = $('#statusFilter').val(); // Add status filter to the data
                }
            }
        });

        // Filter the table when the status dropdown changes
        $('#statusFilter').on('change', function() {
            table.ajax.reload();
        });

        $('#table_pengajuan').on('change', '.status-select', function() {
            var id = $(this).data('id');
            var status = $(this).val();
            var csrfToken = "<?php echo $this->security->get_csrf_hash(); ?>";

            $.ajax({
                url: "<?php echo site_url('data_master/data_publikasi/update_status'); ?>",
                type: "POST",
                data: {
                    id: id,
                    status: status,
                    token: csrfToken
                },
                success: function(response) {
                    // Menampilkan SweetAlert jika status berhasil diperbarui
                    Swal.fire({
                        icon: 'success',
                        title: 'Status Diperbarui',
                        text: 'Status berhasil diperbarui.',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        table.ajax.reload();
                    });
                },
                error: function(xhr, status, error) {
                    // Menampilkan SweetAlert jika terjadi error
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat memperbarui status.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

    });
</script>