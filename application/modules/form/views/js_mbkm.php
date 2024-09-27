<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();
        $('#form-submtitle').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting traditionally

            let fileInput = document.getElementById('dokumen_pendukung');
            let filePath = fileInput.value;
            let allowedExtensions = /(\.doc|docx|ppt|pptx|pdf)$/i;

            if (!allowedExtensions.exec(filePath)) {
                swal({
                    type: 'warning',
                    title: 'Perhatian',
                    text: 'Pastikan Anda memilih file sesuai ketentuan',
                });
                return;
            }

            let formData = new FormData(this);

            $.ajax({
                url: "<?php echo site_url('form/form_mbkm/submit'); ?>",
                method: "POST",
                data: formData, // Use FormData to send files
                contentType: false,
                processData: false,
                dataType: 'json', // Expect JSON response from server
                success: function(data) {
                    if (data.status) {
                        // Close any open SweetAlert modals
                        Swal.close();

                        // Show success message using SweetAlert
                        swal({
                            type: 'success',
                            title: 'Sukses',
                            text: 'Data berhasil disimpan',
                            allowOutsideClick: false,
                        }).then((result) => {
                            // Optionally redirect to a new page or perform other actions upon success
                            $('#form-submtitle')[0].reset();
                        });
                    } else {
                        // Show error message using SweetAlert
                        swal({
                            type: 'error',
                            title: 'Error',
                            text: 'Data gagal disimpan',
                            allowOutsideClick: false,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Log any errors to the console for debugging

                    // Show generic error message using SweetAlert
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan data',
                        allowOutsideClick: false,
                    });
                }
            });
        });

    });
</script>