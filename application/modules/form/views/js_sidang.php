<script type="text/javascript">
    $(document).ready(function() {
        $('#form-pengajuan').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: '<?php echo site_url('form/form_sidang/submit'); ?>',
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        swal({
                            type: 'success',
                            title: 'Success',
                            text: response.message,
                            allowOutsideClick: false,
                        });
                    } else {
                        swal({
                            type: 'error',
                            title: 'Error',
                            text: response.message,
                            allowOutsideClick: false,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan: ' + error,
                        allowOutsideClick: false,
                    });
                }
            });
        });
    });
</script>
