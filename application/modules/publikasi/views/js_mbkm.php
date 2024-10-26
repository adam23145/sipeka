<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#table-pengajuan').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('publikasi/mbkm/get_data'); ?>",
                "type": "POST",
                "data": function(d) {
                    d['<?= $this->security->get_csrf_token_name() ?>'] = '<?= $this->security->get_csrf_hash() ?>';
                    d['status'] = $('#filter-konfirmasi').val(); 
                }
            },
            "columns": [{
                    "data": null
                },
                {
                    "data": "nim"
                },
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
                    "data": "dokumen_pendukung"
                },
                {
                    "data": "action"
                }
            ],
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0,
                "render": function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }]
        });

        $('#filter-konfirmasi').on('change', function() {
            table.ajax.reload();
        });
    });
</script>
<script>
    function goToPage(id) {
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

        $.ajax({
            url: "<?php echo base_url('publikasi/Bimbingan_mbkm/setIdBimbinganMbkm'); ?>",
            type: "POST",
            data: {
                id: id,
                [csrfName]: csrfHash
            },
            success: function(response) {
                // console.log("ID bimbingan_mbkm berhasil disimpan di sesi");
                window.location.href = "<?php echo base_url('publikasi/Bimbingan_mbkm'); ?>";
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }
    
</script>
