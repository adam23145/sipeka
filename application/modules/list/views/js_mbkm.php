<script type="text/javascript">
    $(document).ready(function() {
        // Inisialisasi DataTables dengan server-side processing
        var table = $('#table-pengajuan').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('list/Sempro_mbkm/get_data'); ?>",
                "type": "POST",
                "data": function(d) {
                    // Kirim CSRF Token
                    d['<?= $this->security->get_csrf_token_name() ?>'] = '<?= $this->security->get_csrf_hash() ?>';

                    // Kirim nilai dari dropdown filter status konfirmasi
                    d.konfirmasi_status = $('#filter-konfirmasi').val();
                }
            },
            "columns": [{
                    "data": null
                }, // Kolom No
                {
                    "data": "nim"
                }, // Kolom NIM
                {
                    "data": "nama_mahasiswa"
                },
                {
                    "data": "tanggal_pengajuan"
                },
                {
                    "data": "mbkm"
                },
                {
                    "data": "dosen"
                },
                {
                    "data": "dokumen_pendukung"
                },
                {
                    "data": "konfirmasi"
                }
            ],
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0,
                "render": function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // Menambahkan No urut
                }
            }]
        });

        // Event listener untuk Dropdown Filter
        $('#filter-konfirmasi').on('change', function() {
            table.ajax.reload(); // Reload tabel saat filter diubah
        });

        // Fetch Dosen data for Select2
        function initSelect2(selector) {
            $(selector).select2({
                placeholder: 'Pilih Dosen',
                ajax: {
                    url: "<?php echo site_url('list/Sempro_mbkm/fetch_dosen_select2'); ?>",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term // Send the search term to the server
                        };
                    },
                    processResults: function(data) {
                        console.log(data);
                        return {
                            results: data,
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

        if (status != "Ditolak" && !utama) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Dosen Pembimbing Utama harus diisi!'
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