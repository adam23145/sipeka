<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();

        $('#form-submtitle').submit(function(e) {
            e.preventDefault(); // Prevent traditional form submission

            // File validation for dokumen_pendukung
            let fileInput1 = document.getElementById('dokumen_pendukung');
            let fileInput2 = document.getElementById('dokumen_pendukung2');
            let filePath1 = fileInput1.value;
            let filePath2 = fileInput2.value;
            let allowedExtensions = /(\.doc|docx|ppt|pptx|pdf)$/i;

            if (!allowedExtensions.exec(filePath1) || !allowedExtensions.exec(filePath2)) {
                swal({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Pastikan Anda memilih file sesuai ketentuan',
                });
                return;
            }

            // Validate that majorname is not empty
            let majorname = document.getElementById('majorname').value;
            if (majorname === '' || majorname == null) {
                swal({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Program Studi tidak boleh kosong',
                });
                return;
            }

            let formData = new FormData(this);
            let submitButton = $(this).find('button[type="submit"]');

            // Disable submit button to prevent double submission
            submitButton.prop('disabled', true);

            // Display SweetAlert loading during data submission
            swal({
                title: 'Mengirim...',
                text: 'Silakan tunggu, data sedang diproses',
                icon: 'info',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false
            });

            $.ajax({
                url: "<?php echo site_url('form/Form_mbkm/submit'); ?>",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    Swal.close();
                    if (data.status) {
                        swal({
                            icon: 'success',
                            title: 'Sukses',
                            text: data.message,
                            allowOutsideClick: false,
                        }).then(() => {
                            window.location.href = "<?php echo site_url('history/Sempro_mbkm'); ?>";
                        });
                    } else {
                        swal({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            allowOutsideClick: false,
                        });
                    }
                },
                error: function() {
                    Swal.close();
                    swal({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan data',
                        allowOutsideClick: false,
                    });
                },
                complete: function() {
                    submitButton.prop('disabled', false);
                }
            });
        });
    });
</script>
