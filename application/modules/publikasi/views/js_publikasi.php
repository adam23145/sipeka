<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#table_pengajuan').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('publikasi/publikasi/get_data'); ?>",
                "type": "POST",
                "data": function(d) {
                    d.token = "<?php echo $this->security->get_csrf_hash(); ?>";
                    d['status'] = $('#filter-konfirmasi').val();
                }
            }
        });

        $('#filter-konfirmasi').on('change', function() {
            table.ajax.reload();
        });
    });
</script>
<script>
    function goToPage(id) {
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

        $.ajax({
            url: "<?php echo base_url('publikasi/Bimbingan_publikasi/setIdBimbinganPublikasi'); ?>",
            type: "POST",
            data: {
                id: id,
                [csrfName]: csrfHash
            },
            success: function(response) {
                // console.log("ID bimbingan_mbkm berhasil disimpan di sesi");
                window.location.href = "<?php echo base_url('publikasi/Bimbingan_publikasi'); ?>";
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }
    
</script>
