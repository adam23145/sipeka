<script>
$(document).ready(function() {
    // Ambil token CSRF dari meta tag
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Inisialisasi DataTable
    $('#submissionTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= site_url('dokumen_mbkm/List_dokumen/get_submissions'); ?>",
            method: "GET",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': csrfToken // Kirim token CSRF sebagai header
            },
            // Mengirimkan data CSRF saat melakukan request
            dataSrc: function (json) {
                return json.data; // Pastikan data yang diterima berformat JSON dengan key 'data'
            }
        },
        columns: [
            { 
                data: null, 
                render: function (data, type, row, meta) {
                    return meta.row + 1; // Menampilkan nomor urut
                }
            },
            { data: 'judul' }, // Kolom judul tugas akhir
            { data: 'dokumen' }, // Kolom dokumen
            { 
                data: 'aksi', 
                render: function(data, type, row) {
                    return '<a href="' + data + '" class="btn btn-primary btn-sm" target="_blank">Download</a>'; // Tombol Download
                }
            }
        ]
    });
});
</script>
