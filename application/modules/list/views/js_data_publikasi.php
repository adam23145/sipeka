<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#table_pengajuan').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('list/publikasi/get_data'); ?>",
                "type": "POST",
                "data": function(d) {
                    d.token = "<?php echo $this->security->get_csrf_hash(); ?>";
                    d.status = $('#statusFilter').val(); // Add status filter to the data
                }
            }
        });

        // Filter the table when the status dropdown changes
        $('#statusFilter').on('change', function() {
            table.ajax.reload();
        });

        function initSelect2(selector) {
            $(selector).select2({
                placeholder: 'Pilih Dosen',
                ajax: {
                    url: "<?php echo site_url('list/mbkm/fetch_dosen_select2'); ?>",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term // Send the search term to the server
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data,
                        };
                    },
                    cache: true
                }
            });
        }

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

        if (status != "Ditolak" && !utama) {
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
            url: "<?= base_url('list/publikasi/update_status') ?>",
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