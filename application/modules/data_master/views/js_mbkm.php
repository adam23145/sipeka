<script type="text/javascript">
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
    var table = $('#dataMbkmTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= site_url('data_master/data_mbkm/fetch_data') ?>",
            type: "POST",
            data: function(d) {
                d[csrfName] = csrfHash; // Sertakan CSRF token
            },
            dataSrc: function(json) {
                csrfHash = json.csrfHash; // Perbarui CSRF token dari respons
                return json.data;
            }
        },
        columns: [{
                data: 0
            }, // No
            {
                data: 1
            }, // Submission Code
            {
                data: 2
            }, // Judul
            {
                data: 3
            }, // NIM
            {
                data: 4
            }, // Tanggal Pengajuan
            {
                data: 5
            }, // Dosen Pembimbing
            {
                data: 6
            }, // Posisi Berkas
            {
                data: null, // Kolom Aksi
                render: function(data, type, row) {
                    return `
                    <button class="btn btn-sm btn-primary editBtn" data-id="${row[0]}">
                        Edit
                    </button>
                `;
                },
                orderable: false,
                searchable: false,
            },
        ],
        order: [
            [1, 'asc']
        ], // Urutkan berdasarkan Submission Code
    });

    // Event untuk tombol Edit
    $('#dataMbkmTable').on('click', '.editBtn', function() {
        var rowData = table.row($(this).parents('tr')).data();
        $('#editModal').modal('show');
        $('#id').val(rowData[0]); // ID
        $('#submission_code').val(rowData[1]); // Submission Code
        $('#nim').val(rowData[3]); // NIM
        $('#judul').val(rowData[2]); // Judul
    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize(); 
        $.ajax({
            url: "<?= site_url('data_master/data_mbkm/update_data') ?>", 
            type: "POST",
            data: formData,
            success: function(response) {
                $('#editModal').modal('hide');
                alert("Data berhasil diperbarui!");
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Terjadi kesalahan, coba lagi.");
            }
        });
    });
</script>