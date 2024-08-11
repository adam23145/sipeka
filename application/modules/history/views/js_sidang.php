// JavaScript: js_sidang.php
<script type="text/javascript">
    $(document).ready(function() {
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

        var table = $('#table_pengajuan').DataTable({
            "processing": true,
            "serverSide": true,
            "searching" :false,
            "ajax": {
                "url": "<?php echo site_url('history/sidang/get_data'); ?>",
                "type": "POST",
                "data": function(d) {
                    d[csrfName] = csrfHash;
                },
                "dataSrc": function(json) {
                    // console.log(json); // Print data to console for debugging
                    return json.data;
                }
            },
            "columns": [
                { 
                    "data": null, 
                    "defaultContent": "", 
                    "orderable": false,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1; // Numbering starts from 1
                    }
                },
                { "data": "judul_sidang" },
                { "data": "nama_mahasiswa" },
                { "data": "nim" },
                { "data": "tanggal_sidang" },
                { "data": "tempat_sidang" },
                { "data": "status" }
            ]
        });
    });
</script>
