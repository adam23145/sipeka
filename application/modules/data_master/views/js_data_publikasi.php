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
            $.ajax({
                url: "<?php echo site_url('data_master/data_publikasi/update_status'); ?>",
                type: "POST",
                data: {
                    id: id,
                    status: status,
                    token: "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                success: function(data) {
                    table.ajax.reload();
                }
            });
        });
    });
</script>