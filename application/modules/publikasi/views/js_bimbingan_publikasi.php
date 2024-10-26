<script>
    $(document).ready(function() {
        let idBimbinganForm;

        const today = new Date();
        const options = {
            timeZone: 'Asia/Jakarta',
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        };

        const formatter = new Intl.DateTimeFormat('id-ID', options);
        const formattedDate = formatter.format(today);

        const [day, month, year] = formattedDate.split('/');
        const formattedToday = `${year}-${month}-${day}`;

        function fetchDataPublikasiRiset() {
            $.ajax({
                url: '<?php echo base_url("publikasi/Bimbingan_publikasi/getDataPublikasiRiset"); ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (Array.isArray(response) && response.length > 0) {
                        // console.log(response[0]);
                        $('#namaMahasiswa').text(response[0].nama_mahasiswa);
                        $('#nimMahasiswa').text(response[0].nim);
                        $('#judulProposal').text(response[0].judul_tugas_akhir);
                        $('#jenispublikasi').text(response[0].jenis_tugas_akhir);
                        // $('#id_bimbingan_form').val(response[0].id);

                        idBimbinganForm = response[0].id;
                        $('#file').html('<a href="<?php echo base_url(); ?>' + response[0].dokumen_pendukung + '" class="btn btn-success" target="_blank">Download</a>');

                        $('#beritaacara').val('');
                    } else {
                        console.warn('No data');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                }
            });
        }
        $('#form-ba').on('submit', function(e) {
            e.preventDefault();

            const csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
            const csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

            // Ambil nilai dari field
            const tanggal = $('#tanggal').val();
            const sub_status = $('#sub_status').val();
            const keterangan = $('#keterangan').val();

            // Cek apakah field kosong
            if (!tanggal) {
                swal("Peringatan!", "Tanggal harus diisi.", "warning");
                return; // Menghentikan proses jika tanggal kosong
            }

            if (!sub_status) {
                swal("Peringatan!", "Status harus dipilih.", "warning");
                return; // Menghentikan proses jika sub_status kosong
            }

            // Cek apakah keterangan harus diisi
            if (!keterangan) {
                swal("Peringatan!", "Keterangan harus diisi", "warning");
                return;
            }

            const formData = {
                id_bimbingan_form: parseInt(idBimbinganForm),
                tanggal: tanggal,
                sub_status: sub_status,
                keterangan: keterangan,
                [csrfName]: csrfHash
            };

            // console.log('Form Data:', formData);

            $.ajax({
                url: '<?php echo base_url("publikasi/Bimbingan_publikasi/submit"); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        swal("Berhasil!", response.message, "success").then(() => {
                            location.reload();
                        });
                    } else {
                        swal("Gagal!", response.message, "error");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                    swal("Kesalahan!", "Terjadi kesalahan saat mengirim data.", "error");
                }
            });
        });


        fetchDataPublikasiRiset();

        $('#tanggal').val(formattedToday);

        function loadLogBimbingan() {
            $.ajax({
                url: '<?php echo base_url("publikasi/Bimbingan_publikasi/getLogBimbingan"); ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Kosongkan tabel sebelum mengisi data baru
                    $('#table-logbim tbody').empty();

                    // Loop melalui data yang diterima dan masukkan ke dalam tabel
                    response.forEach((item, index) => {
                        $('#table-logbim tbody').append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>Bimbingan ${index + 1}</td>
                            <td>${item.revisi}</td>
                            <td>${item.status}</td>
                            <td>${item.tanggal}</td>
                        </tr>
                    `);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                    alert('Terjadi kesalahan saat mengambil data log bimbingan.');
                }
            });
        }
        loadLogBimbingan();

    });
</script>