<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();
        
        $('#form-submtitle').submit(function(e) {
            e.preventDefault(); // Mencegah form submit secara tradisional
            
            let fileInput = document.getElementById('dokumen_pendukung');
            let filePath = fileInput.value;
            let allowedExtensions = /(\.doc|docx|ppt|pptx|pdf)$/i;

            // Validasi file yang diunggah
            if (!allowedExtensions.exec(filePath)) {
                swal({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Pastikan Anda memilih file sesuai ketentuan',
                });
                return;
            }

            // Validasi agar program studi (majorname) tidak boleh kosong
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
            
            // Nonaktifkan tombol submit untuk mencegah double submit
            submitButton.prop('disabled', true);

            // Tampilkan SweetAlert loading saat proses pengiriman
            swal({
                title: 'Mengirim...',
                text: 'Silakan tunggu, data sedang diproses',
                icon: 'info',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false
            });

            $.ajax({
                url: "<?php echo site_url('form/form_mbkm/submit'); ?>",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    Swal.close(); // Tutup SweetAlert setelah berhasil
                    if (data.status) {
                        swal({
                            icon: 'success',
                            title: 'Sukses',
                            text: data.message,
                            allowOutsideClick: false,
                        }).then(() => {
                            window.location.href = "<?php echo site_url('history/mbkm'); ?>";
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
                    Swal.close(); // Tutup SweetAlert jika terjadi error
                    swal({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan data',
                        allowOutsideClick: false,
                    });
                },
                complete: function() {
                    submitButton.prop('disabled', false); // Aktifkan tombol submit kembali
                }
            });
        });
    });
</script>
