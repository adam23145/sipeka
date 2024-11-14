<script type="text/javascript">
    $(document).ready(function() {
        $('#form-submtitle').submit(function(e) {
            e.preventDefault(); 
            var formData = new FormData(this);
            $.ajax({
                url: '<?php echo site_url("form/Form_mbkm/submit"); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: response.message,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Oke',
                            allowOutsideClick: false,
                        }).then((result) => {
                            window.location.href = '<?php echo site_url('form/form_mbkm'); ?>';
                        });
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Error',
                            text: response.message,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'Oke',
                            allowOutsideClick: false,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    Swal.fire({
                        type: 'error',
                        title: 'Terjadi Kesalahan!',
                        text: 'Terjadi kesalahan saat mengirim data!',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false,
                    });
                }
            });
        });
    });
</script>
