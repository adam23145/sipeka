<script type="text/javascript">
    $(document).ready(function() {
        $('#form-pengajuan').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Perform client-side validation
            var isValid = true;
            var errorMessage = '';

            // Check if 'judul_sidang' is empty
            if ($('#judul_sidang').val().trim() === '') {
                isValid = false;
                errorMessage += 'Judul Sidang tidak boleh kosong.\n';
            }

            // Check if 'nama_mahasiswa' is empty
            if ($('input[name="nama_mahasiswa"]').val().trim() === '') {
                isValid = false;
                errorMessage += 'Nama Mahasiswa tidak boleh kosong.\n';
            }

            // Check if 'nim' is empty
            if ($('input[name="nim"]').val().trim() === '') {
                isValid = false;
                errorMessage += 'NIM tidak boleh kosong.\n';
            }

            if (!isValid) {
                swal({
                    type: 'error',
                    title: 'Validation Error',
                    text: errorMessage,
                    allowOutsideClick: false,
                });
                return; // Stop the form submission
            }

            // Proceed with AJAX form submission if validation passes
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
