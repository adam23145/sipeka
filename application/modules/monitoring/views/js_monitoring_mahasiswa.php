<script type="text/javascript">
    $(document).ready(function() {
        var csrfToken = "<?php echo $this->security->get_csrf_hash(); ?>";

        $('#guidanceTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('monitoring/monitoring_mahasiswa/get_guidance_count_data'); ?>",
                "type": "POST",
                "data": function(d) {
                    d.token = csrfToken; // Add CSRF token
                },
                "error": function(xhr, error, thrown) {
                    console.error("Ajax error: ", error, thrown);
                }
            }
        });
    });
</script>