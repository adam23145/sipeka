<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();
        $('#form-submtitle').submit(function(e) {
            e.preventDefault(); // Mencegah form submit secara tradisional

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

            // Tampilkan SweetAlert Loading sebelum AJAX request
            swal({
                title: 'Mengirim...',
                text: 'Silakan tunggu sementara data sedang diproses',
                icon: 'info',
                buttons: false, // Hilangkan tombol
                closeOnClickOutside: false, // Jangan tutup ketika di luar klik
                closeOnEsc: false // Jangan tutup ketika ESC ditekan
            });

            $.ajax({
                url: "<?php echo site_url('form/Form_skripsiriset/submit'); ?>",
                method: "POST",
                data: formData, // Gunakan FormData untuk mengirim file
                contentType: false,
                processData: false,
                dataType: 'json', // Harapkan respon JSON dari server
                success: function(data) {
                    // Tutup SweetAlert loading ketika selesai
                    Swal.close();

                    if (data.status) {
                        // Tampilkan pesan sukses
                        swal({
                            type: 'success',
                            title: 'Sukses',
                            text: data.message, // Pesan dari server
                            allowOutsideClick: false,
                        }).then((result) => {
                            // Reset form setelah sukses
                            $('#form-submtitle')[0].reset();
                        });
                    } else {
                        // Tampilkan pesan error dari server
                        swal({
                            type: 'error',
                            title: 'Error',
                            text: data.message, // Pesan dari server
                            allowOutsideClick: false,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Log error untuk debugging

                    // Tutup SweetAlert loading ketika terjadi error
                    Swal.close();

                    // Tampilkan pesan error generik
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan data',
                        allowOutsideClick: false,
                    });
                }
            });
        });

        // Fetch Dosen data untuk Select2
        function initSelect2(selector) {
            $(selector).select2({
                placeholder: 'Pilih Dosen',
                ajax: {
                    url: "<?php echo site_url('form/Form_skripsiriset/fetch_dosen_select2'); ?>",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        }

        initSelect2('#dosen_pembimbing_utama');
        initSelect2('#dosen_pembimbing_kedua');
    });
</script>
