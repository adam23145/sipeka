<script type="text/javascript">
    $(document).ready(function() {
        var csrfToken = "<?php echo $this->security->get_csrf_hash(); ?>";
        var yearFilter = '';
        var jurusanFilter = ''; // Initialize variable for jurusan filter

        // Populate year dropdown
        $.ajax({
            url: "<?php echo site_url('monitoring/monitoring_mahasiswa/get_years'); ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                var yearDropdown = $('#yearDropdown');
                yearDropdown.append('<option value="">Select Year</option>');
                $.each(data, function(index, year) {
                    yearDropdown.append('<option value="' + year.tahun_masuk + '">' + year.tahun_masuk + '</option>');
                });
            }
        });

        // Populate jurusan dropdown
        $.ajax({
            url: "<?php echo site_url('monitoring/monitoring_mahasiswa/get_jurusan'); ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                var jurusanDropdown = $('#jurusanDropdown');
                jurusanDropdown.append('<option value="">Select Jurusan</option>');
                $.each(data, function(index, jurusan) {
                    jurusanDropdown.append('<option value="' + jurusan.jurusan + '">' + jurusan.jurusan + '</option>');
                });
            }
        });

        $('#guidanceTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('monitoring/monitoring_mahasiswa/get_guidance_count_data'); ?>",
                "type": "POST",
                "data": function(d) {
                    d.token = csrfToken; // Add CSRF token
                    d.year = yearFilter; // Add year filter
                    d.jurusan = jurusanFilter; // Add jurusan filter
                },
                "error": function(xhr, error, thrown) {
                    console.error("Ajax error: ", error, thrown);
                }
            }
        });

        // Event listener for year dropdown
        $('#yearDropdown').change(function() {
            yearFilter = $(this).val(); // Update year filter
            $('#guidanceTable').DataTable().ajax.reload(); // Reload data
        });

        // Event listener for jurusan dropdown
        $('#jurusanDropdown').change(function() {
            jurusanFilter = $(this).val(); // Update jurusan filter
            $('#guidanceTable').DataTable().ajax.reload(); // Reload data
        });
    });
</script>