<script type="text/javascript">
    $(document).ready(function() {
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

        var table = $('#table_pengajuan').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('history/skripsiriset/get_data'); ?>",
                "type": "POST",
                "data": function(d) {
                    d[csrfName] = csrfHash;
                }
            },
            "columns": [{
                    "data": "skripsi_riset"
                },
                {
                    "data": "nama_mahasiswa"
                },
                {
                    "data": "nim"
                },
                {
                    "data": "tanggal_pengajuan"
                },
                {
                    "data": "status_pengajuan"
                }
            ],
            "language": {
                "emptyTable": "Tidak ada data yang tersedia di tabel",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ total entri)",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "loadingRecords": "Memuat...",
                "processing": "Sedang diproses...",
                "search": "Cari:",
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                },
                "aria": {
                    "sortAscending": ": aktifkan untuk mengurutkan kolom secara ascending",
                    "sortDescending": ": aktifkan untuk mengurutkan kolom secara descending"
                }
            }
        });
    });
</script>