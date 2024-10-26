<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();

        $('#form-submtitle').submit(function(e) {
            e.preventDefault(); // Mencegah form submit secara tradisional

            let submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true); // Nonaktifkan tombol submit

            let fileInput = document.getElementById('dokumen_pendukung');
            let filePath = fileInput.value;
            let allowedExtensions = /(\.doc|docx|ppt|pptx|pdf)$/i;

            if (!allowedExtensions.exec(filePath)) {
                swal({
                    type: 'warning',
                    title: 'Perhatian',
                    text: 'Pastikan Anda memilih file sesuai ketentuan',
                });
                submitButton.prop('disabled', false); // Aktifkan kembali tombol jika ada error
                return;
            }

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
                url: "<?php echo site_url('form/form_publikasi/submit'); ?>",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    Swal.close(); // Tutup SweetAlert loading

                    if (data.status) {
                        swal({
                            type: 'success',
                            title: 'Sukses',
                            text: data.message,
                            allowOutsideClick: false,
                        }).then((result) => {
                            window.location.href = "<?php echo site_url('history/publikasi'); ?>";
                        });
                    } else {
                        swal({
                            type: 'error',
                            title: 'Error',
                            text: data.message,
                            allowOutsideClick: false,
                        });
                    }

                    submitButton.prop('disabled', false); // Aktifkan tombol kembali setelah selesai
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Log error untuk debugging

                    Swal.close(); // Tutup SweetAlert loading jika ada error
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan data',
                        allowOutsideClick: false,
                    });

                    submitButton.prop('disabled', false); // Aktifkan tombol kembali jika error
                }
            });
        });

        // Fetch Dosen data for Select2
        // function initSelect2(selector) {
        //     $(selector).select2({
        //         placeholder: 'Pilih Dosen',
        //         ajax: {
        //             url: "<?php echo site_url('form/form_publikasi/fetch_dosen_select2'); ?>",
        //             dataType: 'json',
        //             delay: 250,
        //             processResults: function(data) {
        //                 return {
        //                     results: data
        //                 };
        //             },
        //             cache: true
        //         }
        //     });
        // }

        // initSelect2('#dosen_pembimbing_utama');
        // initSelect2('#dosen_pembimbing_kedua');
    });
</script>