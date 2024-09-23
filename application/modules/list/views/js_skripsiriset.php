<script type="text/javascript">
    $(document).ready(function() {
        // Inisialisasi DataTables dengan konfigurasi server-side
        var table = $('#table-pengajuan').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('list/skripsi_riset/fetch_pengajuan') ?>", // URL untuk memuat data
                "type": "POST",
                "data": function(d) {
                    d['<?= $this->security->get_csrf_token_name() ?>'] = '<?= $this->security->get_csrf_hash() ?>'; // CSRF token untuk keamanan
                }
            },
            "columns": [{
                    "data": 0,
                    "title": "Nama Mahasiswa"
                }, // Nama Mahasiswa
                {
                    "data": 1,
                    "title": "NIM"
                }, // NIM
                {
                    "data": 2,
                    "title": "Judul Skripsi/Riset"
                }, // Judul Skripsi
                {
                    "data": 3,
                    "title": "Status Pengajuan"
                }, // Status Pengajuan
                {
                    "data": 4,
                    "title": "Aksi",
                    "orderable": false
                }, // Aksi (Tombol ubah status)
                {
                    "data": 5,
                    "title": "Download Dokumen",
                    "orderable": false
                } // Kolom download dokumen
            ]
        });

        // Event handler untuk tombol update status
        $(document).on('click', '.update-status', function() {
            var id = $(this).data('id'); // Ambil ID dari data-id tombol
            var status = $('select[data-id="' + id + '"]').val(); // Ambil nilai status yang dipilih

            console.log('ID: ', id, 'Status: ', status);
            // Konfirmasi perubahan status menggunakan SweetAlert
            Swal.fire({
                title: 'Konfirmasi Perubahan',
                text: "Apakah kamu yakin ingin mengubah status?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                // console.log(result);
                if (result.value == true) {
                    // Jika dikonfirmasi, lakukan AJAX request untuk update status
                    $.ajax({
                        url: "<?= base_url('list/skripsi_riset/update_status_ajax') ?>",
                        type: "POST",
                        data: {
                            id: id,
                            status: status,
                            '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>' // CSRF token
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status) {
                                // Tampilkan pesan SweetAlert jika berhasil
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Status berhasil diperbarui!',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                table.ajax.reload(null, false); // Reload table tanpa reset pagination
                            } else {
                                // Tampilkan pesan SweetAlert jika ada kesalahan
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: response.message
                                });
                            }
                        },
                        error: function() {
                            // Tampilkan pesan error jika AJAX gagal
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan saat memperbarui status.'
                            });
                        }
                    });
                }
            });
        });
    });
</script>