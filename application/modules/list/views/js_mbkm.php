<script type="text/javascript">
    $(document).ready(function() {
        // Inisialisasi DataTables dengan server-side processing
        $('#table-pengajuan').DataTable({
            "processing": true, // Menampilkan loader
            "serverSide": true, // Server-side processing
            "ajax": {
                "url": "<?php echo site_url('list/mbkm/get_data'); ?>", // URL controller
                "type": "POST",
                "data": function(d) {
                    d['<?= $this->security->get_csrf_token_name() ?>'] = '<?= $this->security->get_csrf_hash() ?>'; // CSRF token untuk keamanan
                }
            },
            "columns": [{
                    "data": "nama_mahasiswa"
                }, // Kolom nama_mahasiswa
                {
                    "data": "tanggal_pengajuan"
                }, // Kolom tanggal_pengajuan
                {
                    "data": "mbkm"
                }, // Kolom skripsi_riset
                {
                    "data": "dokumen_pendukung",
                }, // Kolom skripsi_riset
                {
                    "data": "konfirmasi",
                }
            ]
        });
        // Fetch Dosen data for Select2
        function initSelect2(selector) {
            $(selector).select2({
                placeholder: 'Pilih Dosen',
                ajax: {
                    url: "<?php echo site_url('list/mbkm/fetch_dosen_select2'); ?>",
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

        // Show modal and initialize Select2
        $(document).on('show.bs.modal', '.modal', function() {
            const modalId = $(this).attr('id');
            initSelect2('#dosen_pembimbing_utama_' + modalId.replace('modalKonfirmasi', ''));
            initSelect2('#dosen_pembimbing_kedua_' + modalId.replace('modalKonfirmasi', ''));
        });


    });
</script>
<script>
    function confirmAction(mhsId) {
        const utama = $('#dosen_pembimbing_utama_' + mhsId).val();
        const kedua = $('#dosen_pembimbing_kedua_' + mhsId).val();
        const status = $('.status-dropdown[data-id="' + mhsId + '"]').val();

        if (!utama) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Dosen Pembimbing Utama harus diisi!'
            });
            return;
        }

        if (!status) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Status harus diisi!'
            });
            return;
        } else if (status == "Menunggu") {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Status harus diisi!'
            });
            return;
        }

        $.ajax({
            url: "<?= base_url('list/mbkm/update_status') ?>",
            type: "POST",
            data: {
                id: mhsId,
                dosen_pembimbing_utama: utama,
                dosen_pembimbing_kedua: kedua,
                status: status,
                '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
            },
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    // Tampilkan SweetAlert sukses
                    $('#modalKonfirmasi' + mhsId).modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Status berhasil diperbarui!',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    // Reload halaman
                    setTimeout(() => {
                        location.reload();
                    }, 1500); // Menggunakan timeout untuk menunggu SweetAlert ditampilkan
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat memperbarui status.'
                });
            }
        });
    }
</script>