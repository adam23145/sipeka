<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#table_pengajuan').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('publikasi/NewPublikasi/get_data'); ?>",
                "type": "POST",
                "data": function(d) {
                    d.token = "<?php echo $this->security->get_csrf_hash(); ?>";
                }
            }
        });

        // Filter the table when the status dropdown changes
        $('#statusFilter').on('change', function() {
            table.ajax.reload();
        });
    });
</script>

<script>
    function confirmAction(mhsId) {
        const status = $('.status-dropdown[data-id="' + mhsId + '"]').val();

        $.ajax({
            url: "<?= base_url('publikasi/NewPublikasi/update_status') ?>",
            type: "POST",
            data: {
                id: mhsId,
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